<?php

namespace App\Livewire;

use App\Models\Books;
use App\Models\Coupons;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartBooks extends Component
{

    public $coupon;

    public function increment($qty, $rowId) {
        Cart::update($rowId, ['qty' => ++$qty]);   
    }
    
    public function decrement($qty, $rowId)
    {
        Cart::update($rowId, ['qty' => --$qty]);
    }

    public function remove($rowId) {
        if($rowId) {
            Cart::remove($rowId);
        }
    } 
    public function destroy() {
        Cart::destroy();
    }

    public function addCoupon(Request $request) {
        if($this->coupon) {
            $coupon = Coupons::where('code', $this->coupon)->first();
            if($coupon) {
                $request->session()->put('coupon', $coupon);
            }
        }
    }
    
    #[Layout('components.layouts.layout-client')] 
    public function render()
    {
        $carts = Cart::content();
        $couponPercent = session()->get('coupon');
        // dd($coupon->percent);
        // dd($carts);
        return view('livewire.cart-books', [
            'carts' => $carts,
            'couponPercent' => $couponPercent
        ]);
    }
}
