<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Home extends Component
{
    #[Layout('components.layouts.layout-client')] 
    public function render()
    {
        return view('livewire.home');
    }
}
