<?php

namespace App\Livewire;

use App\Models\Books;
use Livewire\Component;

class ProductSales extends Component
{
    public $booksSale;

    public function mount() {
        $this->booksSale = Books::where('discount_price', '>', 0)->get();
    }


    public function render()
    {
        return view('livewire.product-sales');
    }
}
