<?php

namespace App\Livewire;

use App\Models\Books;
use Livewire\Component;
use App\Models\Categories;
use Livewire\WithPagination;

class ProductTabs extends Component
{
    use WithPagination;
    public $title, $type;

    public $categories;


    private $query = '';

    public function mount() {
        $this->categories = Categories::all();

    }



    public function boot() {
        $this->query = Books::orderBy('created_at', 'desc')->get();
    }
    
    public function filterCategory($id = null) {
        if($id) {
            return $this->query = Books::orderBy('created_at', 'desc')->limit(8)->where('category_id', $id)->get();
        }
        
    }


    public function render()
    {

        $books = $this->query;

        return view('livewire.product-tabs', [
            'books' => $books,
        ]);
    }
}
