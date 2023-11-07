<?php

namespace App\Livewire;

use App\Models\Books;
use App\Models\Categories;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class ShopBooks extends Component
{
    use WithPagination;

    // protected $paginationTheme = 'bootstrap';

    public $query = '', $title= null, $minPrice, $maxPrice;
    public $queryMin, $queryMax, $slug;


    public function mount($slug = null) {
        $this->slug = $slug;

        $this->maxPrice = Books::max('selling_price');
        $this->minPrice = Books::min('selling_price');

    }

    public function filterCategories($id = null) {
        $this->query = $id;

    }

    public function updated() {
        $this->filterCategories($id=null);
        $this->filterPrices($max=null,$min=null);
    }

    #[On('filterPrices')]
    public function filterPrices($max, $min) {
        $this->queryMin = $min;
        $this->queryMax = $max;
    }


    #[Layout('components.layouts.layout-client')] 
    public function render()
    {
        $books = Books::query();
        $categories = Categories::with('books')->get();
        // $max_price = 
        if(!empty($this->query)) {
            $books = $books->where('category_id', $this->query);
        }

        if (!empty($this->slug)) {
            $this->title = Categories::where('slug', $this->slug)->pluck('name')->all();
            $id = Categories::where('slug', $this->slug)->pluck('id')->all();

            $books = Books::where('category_id', $id[0]);
        }

        if(!empty($this->queryMin) || !empty($this->queryMax)) {
            $books = $books->where('selling_price', '>=' , $this->queryMin)
                    ->where('selling_price', '<=', $this->queryMax);
        }

        return view('livewire.shop-books', [
            'categories' => $categories,
            'books' => $books->paginate(4),
        ]);
    }
}
