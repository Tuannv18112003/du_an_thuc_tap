<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckOut extends Component
{

    #[Rule('required|min:3')]
    public $name;

    #[Rule('required|min:3|email')]
    public $email;

    #[Rule('required')]
    public $city;

    #[Rule('required')]
    public $district;


    #[Rule('required|min:10|max:10')]
    public $phone;

    #[Rule('required')]
    public $full_address;

    public $note;

    #[Rule('required')]
    public $payment;

    public function mount() {
        if (!Auth::check()) {
            return redirect(route('login'));
        }
    }

    public function save()
    {
        $this->validate();
        dd($this->all());
        
    }


    #[Layout('components.layouts.layout-client')]
    public function render()
    {   
        $carts = Cart::content();
        $user = Auth::user();
        $couponPercent = session()->get('coupon');

        // dd($user);
        return view('livewire.check-out', [
            'carts' => $carts,
            'couponPercent' => $couponPercent,
            'user' => $user
        ]);
    }
}
