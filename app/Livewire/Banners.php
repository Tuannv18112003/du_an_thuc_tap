<?php

namespace App\Livewire;

use App\Models\Banners as ModelBanners;
use Livewire\Component;

class Banners extends Component
{
    public $banners;

    public function mount() {
        $this->banners = ModelBanners::orderBy('created_at', 'desc')->limit(4)->get();
    }


    public function render()
    {
        return view('livewire.banners');
    }
}
