<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoriesResource\Pages;
use App\Filament\Resources\CategoriesResource\RelationManagers;
use App\Models\Categories;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Set;
use Illuminate\Support\Str;

class CategoriesResource extends Resource
{
    protected static ?string $model = Categories::class;


    protected static ?string $navigationGroup = 'Quản lý dữ liệu';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function getModelLabel(): string
    {
        return __('danh mục');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Tên danh mục')
                    ->required()
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                        if (($get('slug') ?? '') !== Str::slug($old)) {
                            return;
                        }

                        $set('slug', Str::slug($state));
                    })
                    ->live(onBlur: true),
                Forms\Components\TextInput::make('slug')
                    ->disabled()
                    ->dehydrated(),
                Forms\Components\FileUpload::make('image')
                    ->label('Hình ảnh')
                    ->required()
                    ->columnSpanFull()
                    ->directory('categories'),
                Forms\Components\MarkdownEditor::make('description')
                    ->label('Mô tả')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Hình ảnh'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Tên danh mục')
                    ->searchable(),

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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategories::route('/create'),
            'view' => Pages\ViewCategories::route('/{record}'),
            'edit' => Pages\EditCategories::route('/{record}/edit'),
        ];
    }
}
