<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_panel_requires_login(): void
    {
        $this->get('/admin/clients')->assertRedirect('/admin/login');
    }

    public function test_admin_clients_and_invoices_pages_render(): void
    {
        // Panel admin hanya mengizinkan akses non-FilamentUser ketika APP_ENV=local.
        config(['app.env' => 'local']);

        $user = User::factory()->create();
        $client = Client::factory()->create();

        $invoice = Invoice::create([
            'client_id' => $client->id,
            'description' => 'Project.',
            'amount' => 1000000,
            'payment_status' => 'unpaid',
            'invoice_date' => now()->toDateString(),
        ]);

        $this->actingAs($user);

        // Clients: list & edit — tanpa create / view (view kini popup modal di tabel).
        $this->get('/admin/clients')->assertOk()->assertDontSee('Create Client');
        $this->get("/admin/clients/{$client->id}")->assertNotFound();
        $this->get("/admin/clients/{$client->id}/edit")->assertOk();
        $this->get('/admin/clients/create')->assertNotFound();

        // Invoices: list, create — tanpa halaman view (popup modal).
        $this->get('/admin/invoices')->assertOk();
        $this->get('/admin/invoices/create')->assertOk();
        $this->get("/admin/invoices/{$invoice->id}")->assertNotFound();
    }
}
