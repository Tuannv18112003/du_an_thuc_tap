<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsersResource\Pages;
use App\Filament\Resources\UsersResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\ListRecords\Tab;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UsersResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'Quản lý tài khoản';

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                static::getNameFormField(),
                static::getPasswordFormField(),
                static::getNameEmailField()
            ]);
    }

    public static function getNameFormField(): Forms\Components\TextInput
    {
        return TextInput::make('name')
        ->required()
        ->live();
    }

    public static function getPasswordFormField(): Forms\Components\TextInput
    {
        return TextInput::make('password')
        ->required()
        ->live();
    }

    public static function getNameEmailField(): Forms\Components\TextInput
    {
        return TextInput::make('email')
        ->required()
        ->live();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Tên tài khoản'),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Hình ảnh'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUsers::route('/create'),
            'view' => Pages\ViewUsers::route('/{record}'),
            'edit' => Pages\EditUsers::route('/{record}/edit'),
        ];
    } 
    
    public static function getModelLabel(): string
    {
        return __('tài khoản');
    }
}
