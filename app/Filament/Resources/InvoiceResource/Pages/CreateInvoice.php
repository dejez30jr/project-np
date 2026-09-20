<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use Filament\Resources\Pages\CreateRecord;

class CreateInvoice extends CreateRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    /**
     * Jika dibuka dari halaman detail Client ("Create Invoice"),
     * client otomatis terisi sehingga admin tidak perlu mencari client lagi.
     */
    public function mount(): void
    {
        parent::mount();

        if ($clientId = request()->query('client_id')) {
            $this->form->fill(['client_id' => $clientId]);
        }
    }
}
