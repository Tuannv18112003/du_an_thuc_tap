<?php

namespace App\Livewire;

use App\Models\Books;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Livewire\CartBooks;
use Livewire\Attributes\Js;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class ViewBookTabs extends Component
{
    public $type;

    public $item;

    public $carts;

    public function  addToCart($id = null)
    {
        if ($id) {
            $book = Books::find($id);
            Cart::add([
                'id' => $id,
                'name' => $book->name,
                'price' => $book->selling_price,
                'qty' => 1,
                'options' => [
                    'discount_price' => $book->discount_price,
                    'image' => $book->image
                ]
            ]);

            $this->dispatch('add-to-cart');

            return $this->js(<<<JAVASCRIPT
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        idth: 600, 
                        title: 'Thêm vào giỏ hàng thành công',
                        showConfirmButton: false,
                        timer: 3000
                    })
                JAVASCRIPT);
        }
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div class="spinner-border text-success justify-center" role="status" style="margin-right: auto;margin-left: auto;display: block;">
            <span class="sr-only">Loading...</span>
        </div>
        HTML;
    }

    public function render()
    {

        return view('livewire.view-book-tabs');
    }
}
