<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Orders;
use App\Models\OrdersDetail;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Http\Request;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckOut extends Component
{

    public $id;

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

        $user = Auth::user();
        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
    }


    public function save()
    {

        $this->validate();
        $couponPercent = session()->get('coupon');
        if ($couponPercent) {
            $total = Cart::subtotal() - Cart::subtotal() * ($couponPercent->percent / 100);
        } else {
            $total = Cart::subtotal();
        }

        if($this->payment == 'delivery') {
            $carts = Cart::content();
            User::where('id', $this->id)->update($this->only('name', 'email', 'phone', 'city', 'district', 'full_address'));
            

            $user_id = $this->id;
            $date_order = Carbon::now();


            $order = Orders::create([
                'user_id' => $user_id,
                'date_order' => $date_order,
                'total_price' => $total,
                'payment' => $this->payment,
                'note' => $this->note

            ]);

            foreach($carts as $item) {
                OrdersDetail::create([
                    'order_id'=> $order->id,
                    'book_id' => $item->id,
                    'quantity' => $item->qty,
                    'price' => $item->price - $item->price * ($item->options->discount_price / 100)
                ]);
            }

            Cart::destroy();

            session()->flash('success', 'Đặt hàng thành công');

            return redirect('/');
        }

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
