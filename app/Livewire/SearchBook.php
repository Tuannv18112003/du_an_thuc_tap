<?php

namespace App\Livewire;

use App\Models\Books;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class SearchBook extends Component
{

    public $search = "";

    public function render()
    {
        $result = [];

        if(strlen($this->search) > 0) {
            $result = Books::where('name', 'like', '%'.$this->search.'%')->limit(6)->get();
        }

        return view('livewire.search-book', [
            'books' => $result
        ]);
    }
}
