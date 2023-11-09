<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Books;
use App\Models\Orders;
use Filament\Forms\Form;
use App\Enums\BooksStatus;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\OrdersResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OrdersResource\RelationManagers;

class OrdersResource extends Resource
{
    protected static ?string $model = Orders::class;

    protected static ?string $navigationGroup = 'Đơn hàng';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('users.name')
                    ->label('Tên tài khoản')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_order')
                    ->label('Ngày đặt hàng')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_price')
                    ->label('Tổng tiền')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment')
                    ->label('Phương thức thanh toán')
                    ->state(function(Model $record) {
                        if($record->payment == 'delivery') return 'Trả tiền khi nhận hàng';
                        if ($record->payment == 'bank') return 'Chuyển khoản';
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->state(function (Model $record) {
                        if ($record->status == 1) return 'Đã đặt hàng';
                        if ($record->status == 2) return 'Đã xác nhận';
                        if ($record->status == 3) return 'Đang giao hàng';
                        if ($record->status == 4) return 'Giao hàng thành công';
                        if ($record->status == 0) return 'Đã hủy';
                    })
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make()
                    ->label('Xem chi tiết đơn hàng'),
                    Action::make('updateOrder')
                    ->label('Cập nhật đơn hàng')
                    ->icon('heroicon-o-arrow-up-on-square')
                    ->action(function(Model $record) { 
                        if ($record->status == 1) {
                            $record->status = 2;
                        }elseif ($record->status == 2) {
                            $record->status = 3;
                        }elseif ($record->status == 3) {
                            $record->status = 4;
                        }

                        $record->save(); 
                    }),

                    Action::make('deleteOrder')
                    ->label('Hủy đơn hàng')
                    ->icon('heroicon-o-trash')
                    ->action(function (Model $record) {
                        $record->status = 0;
                        $record->save();
                    }),
                ]),
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
            'index' => Pages\ListOrders::route('/'),
            'edit' => Pages\EditOrders::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('quản lý đơn hàng');
    }
}
