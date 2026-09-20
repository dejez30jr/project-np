<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_invoice_belongs_to_client(): void
    {
        $client = Client::create([
            'name' => 'Budi Santoso',
            'nik' => '3171010204050001',
            'whatsapp' => '081234567890',
            'address' => 'Jl. Merdeka No. 10, Jakarta',
            'project_name' => 'Website Company Profile',
            'project_description' => 'Company profile online.',
            'status' => 'new',
            'agreement_accepted' => true,
            'agreement_accepted_at' => now(),
        ]);

        $invoice = Invoice::create([
            'client_id' => $client->id,
            'description' => 'Pembuatan website company profile.',
            'amount' => 2500000,
            'payment_status' => 'unpaid',
            'invoice_date' => now()->toDateString(),
            'deadline' => now()->addDays(14)->toDateString(),
        ]);

        $this->assertSame($client->id, $invoice->client_id);
        $this->assertSame($client->invoices->first()->id, $invoice->id);

        // Nomor invoice otomatis terisi & unik
        $this->assertNotNull($invoice->invoice_number);
        $this->assertStringStartsWith('INV-', $invoice->invoice_number);
        $this->assertNotSame(
            $invoice->invoice_number,
            Invoice::create([
                'client_id' => $client->id,
                'description' => 'Project kedua.',
                'amount' => 1000000,
                'payment_status' => 'unpaid',
                'invoice_date' => now()->toDateString(),
            ])->invoice_number
        );
    }

    public function test_deadline_can_be_null(): void
    {
        $client = Client::factory()->create();

        $invoice = Invoice::create([
            'client_id' => $client->id,
            'description' => 'Project tanpa deadline.',
            'amount' => 500000,
            'payment_status' => 'unpaid',
            'invoice_date' => now()->toDateString(),
        ]);

        $this->assertNull($invoice->deadline);
    }
}
