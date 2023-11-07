<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SlidersResource\Pages;
use App\Filament\Resources\SlidersResource\RelationManagers;
use App\Models\Sliders;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SlidersResource extends Resource
{
    protected static ?string $model = Sliders::class;


    protected static ?string $navigationGroup = 'Quản lý giao diện';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Tiêu đề')
                    ->required()
                    ->live(onBlur: true)
                    ->maxLength(100),

                Forms\Components\TextInput::make('short_title')
                    ->label('Tiêu đề phụ')
                    ->required()
                    ->maxLength(100),

                Forms\Components\FileUpload::make('image')
                    ->label('Hình ảnh')
                    ->required()
                    ->directory('banners')
                    ->image()
                    ->imageEditor()
                    ->imageResizeTargetWidth('1920')
                    ->imageResizeTargetHeight('1080')
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Hình ảnh'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->since(),
            ])
            ->filters([
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
            'index' => Pages\ManageSliders::route('/'),
        ];
    }
}
