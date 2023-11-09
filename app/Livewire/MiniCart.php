<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Gloudemans\Shoppingcart\Facades\Cart;

class MiniCart extends Component
{
    #[On('update-mini-cart')]
    public function render()
    {
        $carts = Cart::content();
        return view('livewire.mini-cart',[
            'carts' => $carts
        ]);
    }
}
