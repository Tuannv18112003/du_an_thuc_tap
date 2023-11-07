<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
                    <span></span> Giỏ hàng
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-lg-12 mb-40 ">
                    <h1 class="heading-2 mb-10">Giỏ hàng của bạn</h1>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-body">Đây là <span class="text-brand">{{$carts->count()}}</span> sản phẩm trong giỏ hàng của bạn
                        </h6>
                        <h6 class="text-body"><a href="#" wire:click.prevent="destroy" class="text-muted"><i class="fi-rs-trash mr-5" ></i>Xóa
                                giỏ hàng</a></h6>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive shopping-summery">
                        <table class="table table-wishlist">
                            <thead>
                                <tr class="main-heading">
                                    <th scope="col" colspan="2">Sản phẩm</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Tổng tiền</th>
                                    <th scope="col" class="end">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $item)
                                    <tr class="pt-30" wire:key="{{$item->rowId}}">
                                        <td class="image product-thumbnail pt-40"><img
                                                src="{{ asset('/storage/' . $item->options->image) }}" alt="#">
                                        </td>
                                        <td class="product-des product-name">
                                            <h6 class="mb-5"><a class="product-name mb-10 text-heading"
                                                    href="">{{ $item->name }}</a></h6>
                                        </td>
                                        <td class="price" data-title="Price">
                                            @php
                                                $discount_price = $item->price - $item->price * ($item->options->discount_price / 100);
                                            @endphp
                                            <h4 class="text-body">{{ number_format($discount_price, 0, '', ',') }} VNĐ
                                            </h4>
                                        </td>
                                        <td class="text-center detail-info" data-title="Stock">
                                            <div class="detail-extralink mr-15">
                                                <div class="detail-qty border radius" x-data="{quantity: {{$item->qty}}}">
                                                    <a class="qty-down" x-on:click="$wire.decrement({{$item->qty}}, '{{$item->rowId}}')"><i
                                                            class="fi-rs-angle-small-down"></i></a>
                                                    <input type="text"class="qty-val" value="{{$item->qty}}"
                                                        min="1">
                                                    <a class="qty-up" x-on:click="$wire.increment({{$item->qty}}, '{{$item->rowId}}')"><i
                                                            class="fi-rs-angle-small-up"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="price" data-title="Price">
                                            <h4 class="text-brand"> {{ number_format($discount_price * $item->qty, 0, '', ',') }} VNĐ </h4>
                                        </td>
                                        <td class="action text-center" data-title="Remove"><a href="#"
                                                class="text-body" wire:click.prevent="remove('{{$item->rowId}}')"><i class="fi-rs-trash"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>



                    <div class="row mt-50">

                        <div class="col-lg-5">
                            <div class="p-40">
                                <h4 class="mb-10">Thêm mã giảm giá</h4>
                                <p class="mb-30"><span class="font-lg text-muted">Sử dụng mã khuyến mãi ?</p>
                                <form action="" method="POST" wire:submit="addCoupon">
                                    <div class="d-flex justify-content-between">
                                        <input class="font-medium mr-15 coupon" name="Coupon"
                                            placeholder="Enter Your Coupon" wire:model="coupon">
                                        <button class="submit"><i class="fi-rs-label mr-10"></i>Thêm</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="col-lg-7">
                            <div class="divider-2 mb-30"></div>



                            <div class="border p-md-4 cart-totals ml-30">
                                <div class="table-responsive">
                                    <table class="table no-border">
                                        <tbody>
                                            @php
                                                $subtotal = \Cart::subtotal();
                                            @endphp
                                            <tr>
                                                <td class="cart_total_label">
                                                    <h6 class="text-muted">Tổng tiền</h6>
                                                </td>
                                                <td class="cart_total_amount">
                                                    <h4 class="text-brand text-end">{{number_format($subtotal, 0, '', ',')}} VNĐ</h4>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="col" colspan="2">
                                                    <div class="divider-2 mt-10 mb-10"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="cart_total_label">
                                                    <h6 class="text-muted">Giảm giá</h6>
                                                </td>
                                                <td class="cart_total_amount" >
                                                    <h5 class="text-heading text-end">{{ $couponPercent ? $couponPercent->percent : 0 }} %</h4>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="col" colspan="2">
                                                    <div class="divider-2 mt-10 mb-10"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="cart_total_label">
                                                    <h6 class="text-muted">Tổng tiền cần thanh toán</h6>
                                                </td>
                                                <td class="cart_total_amount">
                                                    @php
                                                        if($couponPercent) {
                                                            $total = \Cart::subtotal() - (\Cart::subtotal() * ($couponPercent->percent / 100));
                                                        }else {
                                                            $total = \Cart::subtotal();
                                                        }
                                                    @endphp
                                                    <h4 class="text-brand text-end">{{number_format($total, 0, '', ',')}} VNĐ</h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <a href="/thanh-toan" class="btn mb-20 w-100">Tiến hành đặt hàng<i
                                        class="fi-rs-sign-out ml-15"></i></a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </main>
</div>
