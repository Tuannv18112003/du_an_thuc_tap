<?php

namespace App\Livewire;

use App\Models\Orders;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

class AccountPage extends Component
{
    public $carts;

    public function mount() {
        $this->carts = Orders::where('user_id', '=', Auth::user()->id)->get();
    }


    #[Layout('components.layouts.layout-client')]
    public function render()
    {
        return view('livewire.account-page');
    }
}
