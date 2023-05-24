<?php

namespace App\Filament\Resources;

use App\Enum\TransactionStatusEnum;
use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice_number')
                    ->label('Invoice')
                    ->color('warning'),
                TextColumn::make('customer_email')
                    ->label('Pelanggan'),
                TextColumn::make('amount')
                    ->label('Jumlah')
                    ->money('idr'),
                TextColumn::make('total')
                    ->label('Total')
                    ->money('idr'),
                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'danger',
                        'secondary' => static fn ($state): bool => $state === 'PENDING',
                        'warning' => static fn ($state): bool => $state === 'CANCEL',
                        'success' => static fn ($state): bool => $state === 'SUCCESS',
                    ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
