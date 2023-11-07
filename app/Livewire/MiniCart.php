<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class MiniCart extends Component
{
    public function render()
    {
        $carts = Cart::content();
        return view('livewire.mini-cart',[
            'carts' => $carts
        ]);
    }
}
