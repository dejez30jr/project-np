<?php

namespace Tests\Feature;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientRegistrationTest extends TestCase
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

    public function test_register_page_can_be_rendered(): void
    {
        $response = $this->get(route('client.register'));

        $response->assertOk();
        $response->assertSee('Client Registration');
        $response->assertSee('Data Client');
        $response->assertSee('Detail Project');
        $response->assertSee('Persetujuan');
        // Form harus punya field persetujuan
        $response->assertSee('agreement_accepted');
        // Deadline TIDAK boleh muncul di form client
        $response->assertDontSee('deadline');
    }

    public function test_client_can_register_successfully(): void
    {
        $response = $this->post(route('client.register.store'), $this->validPayload());

        $response->assertRedirect(route('client.register'));
        $response->assertSessionHas('success');

        $client = Client::first();
        $this->assertNotNull($client);
        $this->assertSame('Budi Santoso', $client->name);
        $this->assertSame('3171010204050001', $client->nik);
        $this->assertSame('new', $client->status);
        $this->assertTrue($client->agreement_accepted);
        $this->assertNotNull($client->agreement_accepted_at);
    }

    public function test_nik_must_be_exactly_16_digits(): void
    {
        $response = $this->post(route('client.register.store'), $this->validPayload([
            'nik' => '317101020405000',
        ]));

        $response->assertSessionHasErrors('nik');
        $this->assertDatabaseCount('clients', 0);
    }

    public function test_agreement_must_be_accepted(): void
    {
        $response = $this->post(route('client.register.store'), $this->validPayload([
            'agreement_accepted' => null,
        ]));

        $response->assertSessionHasErrors('agreement_accepted');
        $this->assertDatabaseCount('clients', 0);
    }

    public function test_required_fields_are_validated(): void
    {
        $response = $this->post(route('client.register.store'), []);

        $response->assertSessionHasErrors([
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

    public function test_honeypot_blocks_bot_submission(): void
    {
        $response = $this->post(route('client.register.store'), $this->validPayload([
            'website' => 'http://spam.example.com',
        ]));

        $response->assertForbidden();
        $this->assertDatabaseCount('clients', 0);
    }
}
