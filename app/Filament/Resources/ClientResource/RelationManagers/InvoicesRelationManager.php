<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use App\Filament\Resources\InvoiceResource;
use App\Support\PaymentStatuses;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class InvoicesRelationManager extends RelationManager
{
    protected static string $relationship = 'invoices';

    protected static ?string $recordTitleAttribute = 'invoice_number';

    public function form(Form $form): Form
    {
        return $form->schema(InvoiceResource::formSchema(false));
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('invoice_number')
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number')
                    ->label('Nomor Invoice')
                    ->copyable()
                    ->copyMessage('Nomor invoice disalin'),

                Tables\Columns\TextColumn::make('client.project_name')
                    ->label('Project')
                    ->limit(35),

                Tables\Columns\TextColumn::make('amount')
                    ->label('Amount')
                    ->formatStateUsing(fn ($state): string => 'Rp '.number_format((float) $state, 0, ',', '.')),

                Tables\Columns\TextColumn::make('payment_status')
                    ->label('Payment Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => PaymentStatuses::label($state))
                    ->color(fn (string $state): string => PaymentStatuses::color($state)),

                Tables\Columns\TextColumn::make('invoice_date')
                    ->label('Invoice Date')
                    ->date('d M Y'),

                Tables\Columns\TextColumn::make('deadline')
                    ->label('Deadline')
                    ->date('d M Y')
                    ->placeholder('â€”'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Create Invoice')
                    ->icon('heroicon-o-document-plus'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->modalHeading('Detail Invoice')
                    ->modalWidth('5xl')
                    ->infolist(fn (): array => InvoiceResource::infolistSchema()),
                Tables\Actions\Action::make('pdf')
                    ->label('PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->action(function (App\Models\Invoice $record) {
                        return response()->streamDownload(
                            fn () => \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.invoice', ['invoice' => $record->load('client')])->output(),
                            'invoice-'.($record->invoice_number ?? $record->id).'.pdf',
                            ['Content-Type' => 'application/pdf'],
                        );
                    }),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
