<?php

namespace Tests\Feature;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * Security audit untuk fitur Register Client (form publik + endpoint).
 */
class ClientRegisterSecurityTest extends TestCase
{
    use RefreshDatabase;

    private function validPayload(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Budi Santoso',
            'nik' => '3171010204050001',
            'whatsapp' => '081234567890',
            'address' => 'Jl. Merdeka No. 10, Jakarta',
            'project_name' => 'Website Company Profile',
            'project_description' => 'Perlu website company profile untuk bisnis keluarga.',
            'agreement_accepted' => '1',
        ], $overrides);
    }

    /*
    |--------------------------------------------------------------------------
    | 1. CSRF
    |--------------------------------------------------------------------------
    */

    public function test_register_form_contains_csrf_token(): void
    {
        $this->get('/client/register')
            ->assertOk()
            ->assertSee('"_token"', false)
            ->assertSee('name="_token"', false);
    }

    /**
     * VerifyCsrfToken melewati pengecekan saat unit test (env 'testing').
     * Untuk mengetes jalur CSRF sungguhan kita paksa env ke 'production'
     * lewat binding container 'env', lalu kembalikan lagi.
     */
    private function withProductionEnv(callable $callback): void
    {
        $original = $this->app->bound('env') ? $this->app->make('env') : null;
        $this->app->instance('env', 'production');

        try {
            $callback();
        } finally {
            $original === null ? $this->app->offsetUnset('env') : $this->app->instance('env', $original);
        }
    }

    public function test_post_without_csrf_token_is_rejected(): void
    {
        $this->withProductionEnv(function () {
            $token = Str::random(40);

            $this->withSession(['_token' => $token])
                ->post('/client/register', $this->validPayload())
                ->assertStatus(419);

            $this->assertDatabaseCount('clients', 0);
        });
    }

    public function test_post_with_valid_csrf_token_is_accepted(): void
    {
        $this->withProductionEnv(function () {
            $token = Str::random(40);

            $this->withSession(['_token' => $token])
                ->post('/client/register', $this->validPayload() + ['_token' => $token])
                ->assertStatus(302);

            $this->assertDatabaseCount('clients', 1);
        });
    }

    public function test_only_registered_post_routes_exist_for_client_register(): void
    {
        // Tidak boleh ada public DELETE/PUT untuk client.
        $this->put('/client/register', $this->validPayload())->assertStatus(405);
        $this->delete('/client/register')->assertStatus(405);
    }

    /*
    |--------------------------------------------------------------------------
    | 2. Server-side validation
    |--------------------------------------------------------------------------
    */

    public function test_empty_fields_are_rejected(): void
    {
        $this->post('/client/register', [])
            ->assertSessionHasErrors([
                'name',
                'nik',
                'whatsapp',
                'address',
                'project_name',
                'project_description',
                'agreement_accepted',
            ]);

        $this->assertDatabaseCount('clients', 0);
    }

    public function test_too_long_fields_are_rejected(): void
    {
        $this->post('/client/register', $this->validPayload([
            'name' => str_repeat('A', 101),
            'whatsapp' => str_repeat('1', 21),
            'address' => str_repeat('a', 501),
            'project_name' => str_repeat('p', 151),
            'project_description' => str_repeat('d', 2001),
        ]))->assertSessionHasErrors(['name', 'whatsapp', 'address', 'project_name', 'project_description']);

        $this->assertDatabaseCount('clients', 0);
    }

    public function test_special_characters_in_name_are_rejected(): void
    {
        $this->post('/client/register', $this->validPayload([
            'name' => '<script>alert(1)</script>',
        ]))->assertSessionHasErrors('name');

        $this->assertDatabaseCount('clients', 0);
    }

    public function test_unicode_name_with_space_hyphen_apostrophe_is_accepted(): void
    {
        $this->post('/client/register', $this->validPayload([
            'name' => "Siti Nurhaliza D'Costa-Santos",
        ]))->assertStatus(302);

        $this->assertSame("Siti Nurhaliza D'Costa-Santos", Client::first()->name);
    }

    /*
    |--------------------------------------------------------------------------
    | 3. NIK
    |--------------------------------------------------------------------------
    */

    public function test_nik_rejects_letters(): void
    {
        $this->post('/client/register', $this->validPayload(['nik' => '317101020405000a']))
            ->assertSessionHasErrors('nik');
    }

    public function test_nik_rejects_special_characters(): void
    {
        $this->post('/client/register', $this->validPayload(['nik' => '31710102040500!!']))
            ->assertSessionHasErrors('nik');
    }

    public function test_nik_rejects_less_than_16_digits(): void
    {
        $this->post('/client/register', $this->validPayload(['nik' => '317101020405000']))
            ->assertSessionHasErrors('nik');
    }

    public function test_nik_rejects_more_than_16_digits(): void
    {
        $this->post('/client/register', $this->validPayload(['nik' => '31710102040500012']))
            ->assertSessionHasErrors('nik');
    }

    public function test_nik_duplicate_is_rejected(): void
    {
        $this->post('/client/register', $this->validPayload())->assertStatus(302);
        $this->assertDatabaseCount('clients', 1);

        $this->post('/client/register', $this->validPayload())->assertSessionHasErrors('nik');

        $this->assertDatabaseCount('clients', 1);
    }

    /*
    |--------------------------------------------------------------------------
    | 4. WhatsApp
    |--------------------------------------------------------------------------
    */

    public function test_whatsapp_rejects_letters(): void
    {
        $this->post('/client/register', $this->validPayload(['whatsapp' => '08123456abc']))
            ->assertSessionHasErrors('whatsapp');
    }

    public function test_whatsapp_rejects_special_characters(): void
    {
        $this->post('/client/register', $this->validPayload(['whatsapp' => '0812@@##!!']))
            ->assertSessionHasErrors('whatsapp');
    }

    public function test_whatsapp_rejects_too_short(): void
    {
        $this->post('/client/register', $this->validPayload(['whatsapp' => '0812']))
            ->assertSessionHasErrors('whatsapp');
    }

    public function test_whatsapp_rejects_too_long(): void
    {
        $this->post('/client/register', $this->validPayload(['whatsapp' => '08123456789012345678901234567890']))
            ->assertSessionHasErrors('whatsapp');
    }

    public function test_whatsapp_accepts_valid_local_number(): void
    {
        $this->post('/client/register', $this->validPayload(['whatsapp' => '081234567890']))
            ->assertStatus(302);

        $this->assertSame('081234567890', Client::first()->whatsapp);
    }

    public function test_whatsapp_accepts_international_plus_and_separators(): void
    {
        $this->post('/client/register', $this->validPayload(['whatsapp' => '+62 812-3456-7890']))
            ->assertStatus(302);

        $this->assertSame('+62 812-3456-7890', Client::first()->whatsapp);
    }

    /*
    |--------------------------------------------------------------------------
    | 5. Text input : XSS / HTML injection / SQL injection pattern
    |--------------------------------------------------------------------------
    */

    public function test_html_and_xss_payloads_are_sanitized_before_stored(): void
    {
        $this->post('/client/register', $this->validPayload([
            'address' => '<script>alert(1)</script> Selamat datang',
            'project_description' => '<img src=x onerror=alert(2)> Deskripsi project <b>tebal</b>',
            'project_name' => 'Website <script>steal()</script>',
        ]))->assertStatus(302);

        $client = Client::first();

        $this->assertStringContainsString('Selamat datang', $client->address);
        $this->assertStringNotContainsString('<script', $client->address);

        $this->assertStringContainsString('Deskripsi project tebal', $client->project_description);
        $this->assertStringNotContainsString('onerror', $client->project_description);
        $this->assertStringNotContainsString('<img', $client->project_description);

        $this->assertStringContainsString('Website', $client->project_name);
        $this->assertStringNotContainsString('<script', $client->project_name);
    }

    public function test_sql_injection_pattern_is_stored_as_literal_text(): void
    {
        $this->post('/client/register', $this->validPayload([
            'address' => "' OR 1=1 --",
            'project_description' => "Desc'; DROP TABLE clients; --",
        ]))->assertStatus(302);

        // Tabel clients harus tetap utuh (query memakai parameter binding Eloquent).
        $this->assertDatabaseCount('clients', 1);
        $this->assertSame("' OR 1=1 --", Client::first()->address);
        $this->assertSame("Desc'; DROP TABLE clients; --", Client::first()->project_description);
    }

    public function test_stored_value_is_escaped_when_echoed_back_in_form(): void
    {
        // Kirim payload sah + satu field invalid agar redirect balik dengan old().
        $this->from('/client/register')
            ->post('/client/register', $this->validPayload([
                'project_name' => '',
                'address' => '<script>alert(1)</script>',
            ]))
            ->assertSessionHasErrors('project_name');

        $this->get('/client/register')
            ->assertOk()
            ->assertDontSee('<script>alert(1)</script>', false)
            ->assertSee('&lt;script&gt;', false);
    }

    /*
    |--------------------------------------------------------------------------
    | 6. SQL Injection
    |--------------------------------------------------------------------------
    */

    public function test_all_client_queries_use_eloquent_or_parameter_binding(): void
    {
        // Tidak ada raw SQL string concatenation yang dipakai di controller.
        $controller = new \ReflectionClass(\App\Http\Controllers\ClientRegisterController::class);
        $source = file_get_contents($controller->getFileName());

        $this->assertStringNotContainsString('->selectRaw', $source);
        $this->assertStringNotContainsString('->whereRaw', $source);
        $this->assertStringNotContainsString('DB::statement', $source);
        $this->assertStringContainsString('Client::create', $source);
    }

    /*
    |--------------------------------------------------------------------------
    | 7 & 8 & 9 & 10. Mass assignment, Agreement, Deadline, Status
    |--------------------------------------------------------------------------
    */

    public function test_sensitive_fields_sent_by_client_are_ignored(): void
    {
        $this->post('/client/register', $this->validPayload([
            'status' => 'active',
            'role' => 'admin',
            'deadline' => '2025-01-01',
            'payment_status' => 'paid',
            'agreement_accepted_at' => '2020-01-01 00:00:00',
            'created_at' => '2020-01-01 00:00:00',
            'updated_at' => '2020-01-01 00:00:00',
        ]))->assertStatus(302);

        $client = Client::first();

        // Status harus tetap ditentukan server (new), bukan 'active'.
        $this->assertSame('new', $client->status);

        // Agreement harus true (server) + timestamp server, bukan dari request.
        $this->assertTrue($client->agreement_accepted);
        $this->assertNotNull($client->agreement_accepted_at);
        $this->assertGreaterThan(now()->subMinutes(5), $client->agreement_accepted_at);
        $this->assertLessThanOrEqual(now(), $client->agreement_accepted_at);

        // created_at harus datang dari server, bukan 2020.
        $this->assertGreaterThan(now()->subMinutes(5), $client->created_at);

        // Tidak ada kolom deadline/payment_status di tabel clients.
        $columns = \Illuminate\Support\Facades\Schema::getColumnListing('clients');
        $this->assertNotContains('deadline', $columns);
        $this->assertNotContains('payment_status', $columns);
    }

    public function test_client_cannot_send_agreement_without_accepting(): void
    {
        $this->post('/client/register', $this->validPayload([
            'agreement_accepted' => '0',
        ]))->assertSessionHasErrors('agreement_accepted');

        $this->assertDatabaseCount('clients', 0);
    }

    public function test_client_model_does_not_mass_assign_agreement_fields(): void
    {
        $client = Client::create([
            'name' => 'Test User',
            'nik' => '8171010204050001',
            'whatsapp' => '081111222333',
            'address' => 'Alamat test',
            'project_name' => 'Proyek test',
            'project_description' => 'Deskripsi test',
            'status' => 'active',
            'agreement_accepted' => true,
            'agreement_accepted_at' => '2020-01-01 00:00:00',
        ]);

        // status tetap bisa di-set (dipakai admin Filament).
        $this->assertSame('active', $client->status);

        // agreement TIDAK boleh ikut ter-set lewat mass assignment sembarangan.
        $this->assertNotTrue($client->agreement_accepted);
        $this->assertNull($client->agreement_accepted_at);
    }

    /*
    |--------------------------------------------------------------------------
    | 11. Rate limiting / spam
    |--------------------------------------------------------------------------
    */

    public function test_rate_limiting_blocks_spam_registrations(): void
    {
        // Limit: 5 request per jam per IP.
        for ($i = 0; $i < 5; $i++) {
            $this->post('/client/register', $this->validPayload([
                // NIK beda setiap iterasi agar tidak diblokir aturan unique saat
                // menguji throttle murni.
                'nik' => '317101020405'.str_pad((string) $i, 4, '0', STR_PAD_LEFT),
            ]));
        }

        $this->assertDatabaseCount('clients', 5);

        $this->post('/client/register', $this->validPayload([
            'nik' => '3171010204050099',
        ]))->assertSessionHas('error');

        $this->assertDatabaseCount('clients', 5);
    }

    public function test_honeypot_blocks_bot_submission(): void
    {
        $this->post('/client/register', $this->validPayload([
            'website' => 'http://spam.example.com',
        ]))->assertForbidden();

        $this->assertDatabaseCount('clients', 0);
    }

    /*
    |--------------------------------------------------------------------------
    | 12 & 13. Authentication / authorization / IDOR
    |--------------------------------------------------------------------------
    */

    public function test_admin_routes_require_login(): void
    {
        $this->get('/admin/clients')->assertRedirect('/admin/login');
        $this->get('/admin/invoices')->assertRedirect('/admin/login');
    }

    public function test_public_cannot_access_client_or_invoice_by_id(): void
    {
        $this->get('/clients/1')->assertNotFound();
        $this->get('/clients/999')->assertNotFound();
        $this->get('/invoices/1')->assertNotFound();
        $this->get('/invoices/999')->assertNotFound();
    }

    public function test_public_register_page_is_accessible(): void
    {
        $this->get('/client/register')->assertOk();
    }

    /*
    |--------------------------------------------------------------------------
    | 14. Error handling
    |--------------------------------------------------------------------------
    */

    public function test_validation_errors_do_not_leak_sensitive_details(): void
    {
        $response = $this->from('/client/register')->post('/client/register', []);

        $response->assertSessionHasErrors();

        $this->get('/client/register')
            ->assertOk()
            ->assertDontSee('SQLSTATE')
            ->assertDontSee('Stack trace')
            ->assertDontSee('APP_KEY')
            ->assertDontSee('DB_PASSWORD');
    }

    /*
    |--------------------------------------------------------------------------
    | 16. Privacy : NIK & alamat tidak tampil di halaman publik
    |--------------------------------------------------------------------------
    */

    public function test_nik_and_address_are_not_exposed_on_public_pages(): void
    {
        $nik = '3171010204050001';
        $address = 'Jl. Merdeka No. 10, Jakarta';

        $this->post('/client/register', $this->validPayload())->assertStatus(302);

        $this->get('/')->assertOk()->assertDontSee($nik)->assertDontSee($address);
        $this->get('/client/register')->assertOk()->assertDontSee($nik);
    }
}