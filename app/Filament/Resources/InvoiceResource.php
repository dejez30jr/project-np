<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Models\Client;
use App\Models\Invoice;
use App\Support\PaymentStatuses;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Invoices';

    protected static ?string $modelLabel = 'Invoice';

    protected static ?string $pluralModelLabel = 'Invoices';

    /**
     * Skema form invoice. Dipakai oleh InvoiceResource & InvoicesRelationManager.
     */
    public static function formSchema(bool $withClient = true): array
    {
        $schema = [];

        if ($withClient) {
            $schema[] = Forms\Components\Select::make('client_id')
                ->label('Client')
                ->relationship('client', 'name')
                ->searchable()
                ->preload()
                ->required()
                ->live();

            $schema[] = Forms\Components\Placeholder::make('preview_project')
                ->label('Project')
                ->content(fn (Get $get): ?string => optional(Client::find($get('client_id')))->project_name);
        }

        return [
            ...$schema,

            Forms\Components\TextInput::make('invoice_number')
                ->label('Nomor Invoice')
                ->maxLength(64)
                ->helperText('Kosongkan untuk generate otomatis.')
                ->required(fn (string $operation): bool => $operation === 'edit'),

            Forms\Components\Textarea::make('description')
                ->label('Deskripsi')
                ->rows(4)
                ->required()
                ->columnSpanFull(),

            Forms\Components\TextInput::make('amount')
                ->label('Amount')
                ->numeric()
                ->minValue(0)
                ->prefix('Rp')
                ->required(),

            Forms\Components\Select::make('payment_status')
                ->label('Status Pembayaran')
                ->options(PaymentStatuses::all())
                ->default('unpaid')
                ->required(),

            Forms\Components\DatePicker::make('invoice_date')
                ->label('Tanggal Invoice')
                ->default(now())
                ->required(),

            Forms\Components\DatePicker::make('deadline')
                ->label('Deadline')
                ->nullable()
                ->helperText('Deadline diisi admin setelah kesepakatan pengerjaan.'),

            Forms\Components\Textarea::make('notes')
                ->label('Catatan')
                ->rows(3)
                ->nullable()
                ->columnSpanFull(),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form->schema(static::formSchema());
    }

    /**
     * Skema infolist detail invoice.
     * Dipakai di modal ViewAction (popup) di tabel Invoices & relation manager.
     */
    public static function infolistSchema(): array
    {
        return [
            Section::make('Invoice')
                ->columns(2)
                ->schema([
                    TextEntry::make('invoice_number')->label('Nomor Invoice'),
                    TextEntry::make('client.name')->label('Client'),
                    TextEntry::make('client.project_name')->label('Project'),
                    TextEntry::make('description')->label('Deskripsi')->columnSpanFull(),
                    TextEntry::make('amount')
                        ->label('Amount')
                        ->formatStateUsing(fn ($state): string => 'Rp '.number_format((float) $state, 0, ',', '.')),
                    TextEntry::make('payment_status')
                        ->label('Status Pembayaran')
                        ->badge()
                        ->formatStateUsing(fn (string $state): string => PaymentStatuses::label($state))
                        ->color(fn (string $state): string => PaymentStatuses::color($state)),
                    TextEntry::make('invoice_date')->label('Tanggal Invoice')->date('d M Y'),
                    TextEntry::make('deadline')->label('Deadline')->date('d M Y')->placeholder('—'),
                    TextEntry::make('notes')->label('Catatan')->placeholder('—')->columnSpanFull(),
                    TextEntry::make('created_at')->label('Created At')->dateTime('d M Y, H:i'),
                    TextEntry::make('updated_at')->label('Updated At')->dateTime('d M Y, H:i'),
                ]),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema(static::infolistSchema());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number')
                    ->label('Nomor Invoice')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Nomor invoice disalin'),

                Tables\Columns\TextColumn::make('client.name')
                    ->label('Client')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('client.project_name')
                    ->label('Project')
                    ->limit(35),

                Tables\Columns\TextColumn::make('amount')
                    ->label('Amount')
                    ->formatStateUsing(fn ($state): string => 'Rp '.number_format((float) $state, 0, ',', '.'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment_status')
                    ->label('Payment Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => PaymentStatuses::label($state))
                    ->color(fn (string $state): string => PaymentStatuses::color($state))
                    ->sortable(),

                Tables\Columns\TextColumn::make('invoice_date')
                    ->label('Invoice Date')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('deadline')
                    ->label('Deadline')
                    ->date('d M Y')
                    ->sortable()
                    ->placeholder('—'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('payment_status')
                    ->label('Status Pembayaran')
                    ->options(PaymentStatuses::all()),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->modalHeading('Detail Invoice')
                    ->modalWidth('5xl')
                    ->infolist(fn (): array => static::infolistSchema()),
                Tables\Actions\Action::make('pdf')
                    ->label('Download PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->action(function (Invoice $record) {
                        return response()->streamDownload(
                            fn () => \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.invoice', ['invoice' => $record->load('client')])->stream(),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
