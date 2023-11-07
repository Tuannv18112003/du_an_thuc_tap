<?php

namespace App\Livewire;

use App\Models\Books;
use Livewire\Component;
use App\Models\Categories;
use Illuminate\Http\Request;
use Livewire\Attributes\Layout;

class Details extends Component
{
    public $slug;

    public $bookDetail;

    public $categories;


    public function mount(Request $request) {
        $this->slug = $request->slug;

        $this->categories = Categories::all();
        $this->bookDetail = Books::with('categories')->where('slug', $this->slug)->first();

    }

    #[Layout('components.layouts.layout-client')] 
    public function render()
    {
        $title = 'Chi tiết sản phẩm';
        return view('livewire.details', compact('title'));
    }
}
