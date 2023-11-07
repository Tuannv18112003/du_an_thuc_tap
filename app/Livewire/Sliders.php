<?php

namespace App\Livewire;

use App\Models\Sliders as SlidersModel;
use Livewire\Component;

class Sliders extends Component
{

    public $sliders;

    private function getSliders() {
        $this->sliders = SlidersModel::all(); 
        return $this->sliders;
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div>
            <!-- Loading spinner... -->
            <svg>...</svg>
        </div>
        HTML;
    }

    public function render()
    {
        $sliders = $this->getSliders();
        return view('livewire.sliders', compact('sliders'));
    }
}
