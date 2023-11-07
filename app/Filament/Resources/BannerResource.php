<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Banners;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BannerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BannerResource\RelationManagers;

class BannerResource extends Resource
{
    protected static ?string $model = Banners::class;


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
                    ->maxLength(100)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('banner_url', Str::slug($state))),

                Forms\Components\TextInput::make('banner_url')
                    ->label('Đường dẫn')
                    ->disabled()
                    ->dehydrated(),
                Forms\Components\FileUpload::make('banner_image')
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
                Tables\Columns\ImageColumn::make('banner_image')
                    ->label('Hình ảnh'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->since(),
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
            'index' => Pages\ManageBanners::route('/'),
        ];
    }
}
