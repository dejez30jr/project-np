<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PesanResource\Pages;
use App\Filament\Resources\PesanResource\RelationManagers;
use App\Models\Pesan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PesanResource extends Resource
{
    protected static ?string $model = Pesan::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('is_read', false)->count();

        // Jika jumlah pesan 0, return null
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        // Warnanya Danger (Merah RAWR).
        return 'danger';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nama Pengirim')
                ->readonly(),
            Forms\Components\TextInput::make('email')
                ->label('Email')
                ->readonly(),
            Forms\Components\Textarea::make('message')
                ->label('Isi Pesan')
                ->columnSpanFull()
                ->readonly(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->recordClasses(fn (Pesan $record) => $record->is_read ? null : 'font-bold bg-gray-100/50')
            ->columns([
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('email')
                ->icon('heroicon-m-envelope')
                ->copyable()
                ->copyMessage('Email berhasil disalin')
                ->tooltip('Klik untuk menyalin email'),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime('d M Y, H:i')
                ->label('Diterima'),
            
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                ->mutateRecordDataUsing(function (array $data, Pesan $record): array {
                    // Logic: Jika belum dibaca, update jadi true
                    if (!$record->is_read) {
                        $record->update(['is_read' => true]);
                    }
                    
                    return $data;
                }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),

                    Tables\Actions\BulkAction::make('markAsRead')
                    ->label('Tandai Sudah Dibaca')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(function (\Illuminate\Database\Eloquent\Collection $records) {
                        $records->each->update(['is_read' => true]);
                    })
                    ->deselectRecordsAfterCompletion(),
                ])
                ->label('Menu Pilihan')
                ->icon('heroicon-m-ellipsis-vertical')
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
            'index' => Pages\ListPesans::route('/'),
            'create' => Pages\CreatePesan::route('/create'),
            'edit' => Pages\EditPesan::route('/{record}/edit'),
        ];
    }
}
