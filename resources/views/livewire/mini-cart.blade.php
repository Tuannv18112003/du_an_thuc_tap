<div>
    <div class="header-action-icon-2">
        <a class="mini-cart-icon" href="/gio-hang">
            <img alt="Nest" src="{{ asset('front-end/assets/imgs/theme/icons/icon-cart.svg') }}" />
            <span class="pro-count blue">{{$carts->count()}}</span>
        </a>
        <a href="/gio-hang"><span class="lable">Giỏ hàng</span></a>
        <div class="cart-dropdown-wrap cart-dropdown-hm2">
            <ul>
                @foreach ($carts as $item)
                    <li>
                        <div class="shopping-cart-img">
                            <a href=""><img alt="Nest"
                                    src="{{ asset('/storage/'. $item->options->image) }}" /></a>
                        </div>
                        <div class="shopping-cart-title">
                            <h4><a href="">{{$item->name}}</a></h4>
                            @php
                                $discount_price = $item->price - $item->price * ($item->options->discount_price / 100);
                            @endphp
                            <h4><span>{{$item->qty}} × </span>{{number_format($item->discount_price, 0, '', ',')}}</h4>
                        </div>
                        <div class="shopping-cart-delete">
                            <a href="#"><i class="fi-rs-cross-small"></i></a>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="shopping-cart-footer">
                <div class="shopping-cart-total">
                    <h4>Total <span>$4000.00</span></h4>
                </div>
                <div class="shopping-cart-button">
                    <a href="shop-cart.html" class="outline">View cart</a>
                    <a href="shop-checkout.html">Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
