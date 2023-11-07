<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Books;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use App\Infolists\Components\VideoEntry;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\TrashedFilter;
use App\Filament\Resources\BooksResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BooksResource\RelationManagers;
use IbrahimBougaoua\FilamentRatingStar\Actions\RatingStar;
use IbrahimBougaoua\FilamentRatingStar\Columns\RatingStarColumn;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class BooksResource extends Resource
{
    protected static ?string $model = Books::class;

    protected static ?string $navigationGroup = 'Quản lý dữ liệu';

    protected static ?string $navigationIcon = 'heroicon-o-book-open';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Tên sách')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->maxLength(100)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                                Forms\Components\TextInput::make('slug')
                                    ->disabled()
                                    ->dehydrated(),
                                Forms\Components\TextInput::make('selling_price')
                                    ->label('Giá sách')
                                    ->required()
                                    ->numeric(),
                                Forms\Components\TextInput::make('discount_price')
                                    ->label('Giảm giá')
                                    ->numeric()
                                    ->default(0),

                                Forms\Components\TextInput::make('short_title')
                                    ->label('Tiêu đề')
                                    ->required()
                                    ->maxLength(255),

                                RatingStar::make('rating')
                                    ->label('Rating'),

                                Forms\Components\Select::make('category_id')
                                    ->label('Thể loại sách')
                                    ->required()
                                    ->relationship(name: 'categories', titleAttribute: 'name')
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('name')
                                            ->label('Tên danh mục')
                                            ->required()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                                        Forms\Components\TextInput::make('slug')
                                            ->disabled()
                                            ->dehydrated(),
                                        Forms\Components\FileUpload::make('image')
                                            ->label('Hình ảnh')
                                            ->required()
                                            ->directory('categories')
                                            ->imageEditor()
                                    ])
                                    ->columnSpan([
                                        'default' => 'full',
                                        'xl' => 2,
                                        '2xl' => 2
                                    ]),



                                TinyEditor::make('description')
                                    ->label('Mô tả')
                                    ->required()
                                    ->maxLength(65535)
                                    ->columnSpan('full'),
                            ])
                            ->columns([
                                'default' => 1,
                                'xl' => 2,
                                '2xl' => 2,
                            ])

                            ->columnSpan([
                                'default' => 1,
                                'xl' => 4,
                                '2xl' => 5,
                            ]),

                        Section::make()
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->label('Hình ảnh')
                                    ->image()
                                    ->required()
                                    ->imageEditor()
                                    ->imageEditorMode(2)
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('1:1')
                                    ->imageResizeTargetWidth('800')
                                    ->imageResizeTargetHeight('1200')
                                    
                                    ->directory('images/books'),

                                Section::make()
                                    ->schema([
                                        Forms\Components\FileUpload::make('multi_image')
                                            ->label('Ảnh phụ')
                                            ->directory('images/multi_images')
                                            ->multiple()
                                            ->imageEditor()
                                            ->minFiles(2)
                                            ->required()


                                    ])
                            ])->columnSpan([
                                'default' => 1,
                                'xl' => 2,
                                '2xl' => 3,
                            ]),
                    ])->columns([
                        'default' => 1,
                        'xl' => 6,
                        '2xl' => 8,
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Tên sách')
                    ->searchable(),
                Tables\Columns\TextColumn::make('selling_price')
                    ->label('Giá sách')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('discount_price')
                    ->label('Giảm giá( % )')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Hình ảnh'),
                Tables\Columns\TextColumn::make('categories.name')
                    ->label('Thể loại')
                    ->sortable(),
                // RatingStarColumn::make('rating')
                //     ->label('Đánh giá'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime()
                    ->sortable(),

            ])
            ->filters([
                TrashedFilter::make()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBooks::route('/create'),
            'view' => Pages\ViewBooks::route('/{record}'),
            'edit' => Pages\EditBooks::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('sách');
    }
}
