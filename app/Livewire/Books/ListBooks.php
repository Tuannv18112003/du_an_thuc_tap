<?php

namespace App\Livewire\Books;

use App\Livewire\Forms\BookRequest;
use App\Models\Books;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Rule;

class ListBooks extends Component
{
    // use InteractsWithForms;
    // use InteractsWithTable;

    // public function table(Table $table): Table
    // {
    //     return $table
    //         ->query(Books::query())
    //         ->columns([
    //             Tables\Columns\TextColumn::make('name')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('selling_price')
    //                 ->numeric()
    //                 ->sortable(),
    //             Tables\Columns\TextColumn::make('discount_price')
    //                 ->numeric()
    //                 ->sortable(),
    //             Tables\Columns\ImageColumn::make('image'),
    //             Tables\Columns\TextColumn::make('short_title')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('categories.name')
    //                 ->numeric()
    //                 ->sortable(),
    //             Tables\Columns\TextColumn::make('created_at')
    //                 ->dateTime()
    //                 ->sortable()
    //                 ->toggleable(isToggledHiddenByDefault: true)
    //         ])
    //         ->filters([
    //             //
    //         ])
    //         ->actions([
    //             //
    //         ])
    //         ->bulkActions([
    //             Tables\Actions\BulkActionGroup::make([
    //                 //
    //             ]),
    //         ]);
    // }

    // #[Rule('required|min:3')]
    // public $title = '';

    // #[Rule('required|min:3')]
    // public $content = '';

    // public $data = [
    //     'title' => '',
    //     'content' => ''
    // ];

    // public function rules()
    // {
    //     return [
    //         'data.title' => 'required|min:3',
    //         'data.content' => 'required|min:5',
    //     ];
    // }

    public BookRequest $data;


    public function save()
    {
        // dd($this->form->all());
        Books::create(
            $this->data->validate()
        );
        // Post::create([
        //     'title' => $this->title,
        //     'content' => $this->content,
        // ]);

        return redirect()->to('/posts');
    }

    public function render(): View
    {
        return view('livewire.books.list-books');
    }
}
