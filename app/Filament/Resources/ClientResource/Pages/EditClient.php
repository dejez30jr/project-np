<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use App\Filament\Resources\InvoiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClient extends EditRecord
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('createInvoice')
                ->label('Create Invoice')
                ->icon('heroicon-o-document-plus')
                ->color('success')
                ->url(fn (): string => InvoiceResource::getUrl('create', ['client_id' => $this->getRecord()->getKey()])),
            Actions\DeleteAction::make(),
        ];
    }
}
