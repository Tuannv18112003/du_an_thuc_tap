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
                    <h4>Tổng tiền <span>{{number_format(\Cart::subtotal(), 0, '', ',')}} VNĐ</span></h4>
                </div>
                <div class="shopping-cart-button">
                    <a href="/gio-hang" class="outline">Xem giỏ hàng</a>
                    @if (count($carts) == 0)
                        <a href="/thanh-toan">Thanh toán</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
