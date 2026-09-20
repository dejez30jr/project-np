<?php

namespace Tests\Feature;

use App\Filament\Resources\InvoiceResource\Pages\ListInvoices;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
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

    public function test_invoice_pdf_download_produces_valid_pdf(): void
    {
        config(['app.env' => 'local']);

        $user = User::factory()->create();
        $client = Client::factory()->create([
            'name' => 'Budi Santoso',
            'project_name' => 'Website Company Profile',
        ]);

        $invoice = Invoice::create([
            'client_id' => $client->id,
            'description' => 'Pembuatan website company profile.',
            'amount' => 2500000,
            'payment_status' => 'unpaid',
            'invoice_date' => now()->toDateString(),
            'deadline' => now()->addDays(14)->toDateString(),
        ]);

        $this->actingAs($user);

        $test = Livewire::test(ListInvoices::class)
            ->callTableAction('pdf', $invoice);

        $download = data_get($test->effects, 'download');

        $this->assertNotNull($download, 'Aksi Download PDF tidak menghasilkan efek download.');
        $this->assertSame('invoice-'.$invoice->invoice_number.'.pdf', $download['name']);
        $this->assertSame('application/pdf', $download['contentType']);

        $content = base64_decode($download['content']);

        $this->assertNotSame('', $content, 'Konten PDF tidak boleh kosong.');
        $this->assertStringStartsWith('%PDF', $content, 'Konten download harus diawali penanda PDF.');
        $this->assertStringContainsString('%%EOF', substr($content, -256), 'Konten download harus diakhiri penanda EOF PDF.');
    }
}
