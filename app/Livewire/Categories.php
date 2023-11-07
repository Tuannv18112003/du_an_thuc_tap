<?php

namespace App\Livewire;

use App\Models\Books;
use App\Models\Categories as ModelsCategories;
use Livewire\Component;

class Categories extends Component
{
    public $categories;

    public $title;

    public $books;

    public function mount() {
        $this->title = 'Danh mục';
        
        $this->categories = ModelsCategories::all();

        $this->books = Books::all();
    }

    public function render()
    {
        return view('livewire.categories');
    }
}
