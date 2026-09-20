<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use App\Support\ClientStatuses;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Clients';

    protected static ?string $modelLabel = 'Client';

    protected static ?string $pluralModelLabel = 'Clients';

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('status', 'new')->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'info';
    }

    /**
     * Client TIDAK boleh dibuat dari admin.
     * Client hanya dibuat melalui form Blade (/client/register).
     */
    public static function canCreate(): bool
    {
        return false;
    }

    /**
     * Skema infolist detail client.
     * Dipakai di modal ViewAction (popup) di tabel Clients.
     */
    public static function infolistSchema(): array
    {
        return [
            Section::make('Data Client')
                ->columns(2)
                ->schema([
                    TextEntry::make('name')->label('Nama Lengkap'),
                    TextEntry::make('nik')->label('NIK'),
                    TextEntry::make('whatsapp')->label('Nomor WhatsApp'),
                    TextEntry::make('address')->label('Alamat Lengkap')->columnSpanFull(),
                ]),

            Section::make('Project')
                ->schema([
                    TextEntry::make('project_name')->label('Nama Project'),
                    TextEntry::make('project_description')->label('Deskripsi Project')->columnSpanFull(),
                ]),

            Section::make('Agreement')
                ->columns(2)
                ->schema([
                    TextEntry::make('agreement_accepted')
                        ->label('Status Persetujuan')
                        ->state(fn (Client $record): string => $record->agreement_accepted ? 'Accepted' : 'Not Accepted')
                        ->badge()
                        ->color(fn (Client $record): string => $record->agreement_accepted ? 'success' : 'danger'),
                    TextEntry::make('agreement_accepted_at')
                        ->label('Waktu Persetujuan')
                        ->dateTime('d M Y, H:i'),
                ]),

            Section::make('System')
                ->columns(2)
                ->schema([
                    TextEntry::make('created_at')->label('Created At')->dateTime('d M Y, H:i'),
                    TextEntry::make('updated_at')->label('Updated At')->dateTime('d M Y, H:i'),
                ]),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema(static::infolistSchema());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(100)
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('nik')
                    ->label('NIK')
                    ->numeric()
                    ->length(16)
                    ->required(),

                Forms\Components\TextInput::make('whatsapp')
                    ->label('Nomor WhatsApp')
                    ->maxLength(20)
                    ->required(),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options(ClientStatuses::all())
                    ->default('new')
                    ->required(),

                Forms\Components\Textarea::make('address')
                    ->label('Alamat Lengkap')
                    ->rows(3)
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('project_name')
                    ->label('Nama Project')
                    ->required()
                    ->maxLength(150)
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('project_description')
                    ->label('Deskripsi Project')
                    ->rows(4)
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\Toggle::make('agreement_accepted')
                    ->label('Persetujuan Diterima')
                    ->disabled()
                    ->dehydrated(false)
                    ->helperText('Nilai persetujuan ditentukan saat client mengirim form registrasi.'),

                Forms\Components\DateTimePicker::make('agreement_accepted_at')
                    ->label('Waktu Persetujuan')
                    ->disabled()
                    ->dehydrated(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable(),

                Tables\Columns\TextColumn::make('whatsapp')
                    ->label('WhatsApp')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Nomor WhatsApp disalin'),

                Tables\Columns\TextColumn::make('project_name')
                    ->label('Nama Project')
                    ->searchable()
                    ->limit(35),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => ClientStatuses::label($state))
                    ->color(fn (string $state): string => ClientStatuses::color($state))
                    ->sortable(),

                Tables\Columns\TextColumn::make('agreement_accepted')
                    ->label('Agreement')
                    ->badge()
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Accepted' : 'Not Accepted')
                    ->color(fn (bool $state): string => $state ? 'success' : 'danger'),

                Tables\Columns\TextColumn::make('agreement_accepted_at')
                    ->label('Agreement Accepted At')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->placeholder('—'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options(ClientStatuses::all()),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->modalHeading('Detail Client')
                    ->modalWidth('5xl')
                    ->infolist(fn (): array => static::infolistSchema()),
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
            RelationManagers\InvoicesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
