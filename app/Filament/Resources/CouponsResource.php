<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Coupons;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Form\Components\DatePicker;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CouponsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CouponsResource\RelationManagers;
use Filament\Forms\Components\DateTimePicker;

class CouponsResource extends Resource
{
    protected static ?string $model = Coupons::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Tên mã giảm giá')
                    ->required(),

                Forms\Components\TextInput::make('code')
                    ->label('Nhập mã code')
                    ->required(),

                Forms\Components\TextInput::make('percent')
                    ->label('Phần trăm')
                    ->required()
                    ->numeric(),
                DateTimePicker::make('expiry_date')
                    ->label('Ngày hết hạn')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->columns([
                
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCoupons::route('/'),
        ];
    }
}
