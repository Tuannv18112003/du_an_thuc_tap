<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        $carts = Cart::content();
        $count = Cart::count();

        return view('livewire.cart-books', compact('carts', 'count'));
    }
}
