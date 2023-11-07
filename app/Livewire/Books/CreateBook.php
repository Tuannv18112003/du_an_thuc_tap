<?php

namespace App\Livewire\Books;

use App\Models\Books;
use App\Models\Categories;
use Filament\Forms;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Rule;


class CreateBook extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    #[Rule('required', message: 'Please fill out your date of birth.')]
    public $name = '';

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                // ->rules(['string', 'required'])
                ->label('Tên sản phẩm'),
                TextInput::make('selling_price')
                // ->rules(['required', 'integer'])
                ->label('Giá sản phẩm'),
                TextInput::make('discount_price')
                // ->rules(['required', 'integer'])
                ->label('Giảm giá'),
                TextInput::make('short_title')
                // ->rules(['required', 'string'])
                ->label('Mô tả ngắn'),
                FileUpload::make('image')
                // ->rules(['required', 'string'])
                ->label('Hình ảnh'),
                Select::make('category_id')
                ->relationship(name: 'categories', titleAttribute: 'name')
                ->label('Thể loại')
                // ->rules(['required'])
                ->placeholder('Chọn thể loại'),
                RichEditor::make('description')
                ->label('Mô tả')
                // ->rules(['required'])

            ])
            ->statePath('data')
            ->model(Books::class);
    }

    protected function onValidationError(ValidationException $exception): void
    {
        Notification::make()
            ->title($exception->getMessage())
            ->danger()
            ->send();
    }

    public function create(): void
    {
        $this->form->validate();
        $data = $this->form->getState();

        $record = Books::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.books.create-book');
    }
}