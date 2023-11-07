<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
                    <span></span> Thanh toán
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-lg-8 mb-40">
                    <h3 class="heading-2 mb-10">Thanh toán</h3>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-body">Đây là những sản phẩm của bạn trong giỏ hàng</h6>
                    </div>
                </div>
            </div>
            <form method="" wire:submit="save">
                <div class="row">
                    <div class="col-lg-7">

                        <div class="row" x-data="{user: {{$user}} }">
                            <h4 class="mb-30">Chi tiết hóa đơn</h4>



                            <div class="row shipping_calculator">
                                <div class="form-group col-lg-6">
                                    <input type="text" name="fname"  x-bind:value="user.name" wire:model="name"
                                        placeholder="Họ tên *">
                                    <div style="color:red;">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <input type="email" name="lname"  x-bind:value="user.email" wire:model="email"
                                        placeholder="Email *">
                                    <div style="color:red;">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row shipping_calculator">

                                <div class="form-group col-lg-6">
                                    <div class=" " style="">
                                        <select class="" style="height: 64px;border: 1px solid #ececec;border-radius: 10px;padding: 0 12px;" 
                                            x-bind:value="user.city" wire:model.live="city">
                                            <option selected>Lựa chọn tỉnh, thành phố...</option>
                                            @foreach (\Kjmtrue\VietnamZone\Models\Province::all() as $item)
                                                <option wire:key="{{ $item->id }}" value="{{ $item->id }}">
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <div style="color:red;">
                                            @error('city')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <input type="text" x-bind:value="user.phone" wire:model="phone" 
                                        placeholder="Phone*">
                                    <div style="color:red;">
                                        @error('phone')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row shipping_calculator">

                                <div class="form-group col-lg-6">
                                    <div class="">
                                        <select class="" style="height: 64px;border: 1px solid #ececec;border-radius: 10px;padding: 0 12px;"  
                                            x-bind:value="user.district" wire:model="district">
                                            <option value="" selected>Lựa chọn quận, huyện...
                                            </option>
                                            @foreach (\Kjmtrue\VietnamZone\Models\District::whereProvinceId($this->city)->get() as $item)
                                                <option wire:key="{{ $item->id }}" value="{{ $item->id }}">
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <div style="color:red;">
                                            @error('district')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <input type="text" name="full_address" 
                                        x-bind:value="user.full_address" wire:model="full_address" placeholder="Địa chỉ cụ thể *">
                                    <div style="color:red;">
                                        @error('full_address')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="form-group mb-30">
                                <textarea rows="5" placeholder="Ghi chú" wire:model="note"></textarea>
                            </div>

                        </div>
                    </div>


                    <div class="col-lg-5">
                        <div class="border p-40 cart-totals ml-30 mb-50">
                            <div class="d-flex align-items-end justify-content-between mb-30">
                                <h4>Sản phẩm</h4>
                                <h6 class="text-muted">Tổng tiền</h6>
                            </div>
                            <div class="divider-2 mb-30"></div>
                            <div class="table-responsive order_table checkout">
                                <table class="table no-border">
                                    <tbody>
                                        @foreach ($carts as $item)
                                            <tr>
                                                <td class="image product-thumbnail"><img
                                                        src="{{ asset('/storage/' . $item->options->image) }}"
                                                        alt="#"></td>
                                                <td>
                                                    <h6 class="w-160 mb-5"><a href=""
                                                            class="text-heading">{{ $item->name }}</a></h6></span>
                                                    <div class="product-rate-cover">


                                                    </div>
                                                </td>
                                                <td>
                                                    <h6 class="text-muted pl-20 pr-20">x {{ $item->qty }}</h6>
                                                </td>
                                                <td>
                                                    @php
                                                        $discount_price = $item->price - $item->price * ($item->options->discount_price / 100);
                                                    @endphp
                                                    <h4 class="text-brand">
                                                        {{ number_format($discount_price * $item->qty, 0, '', ',') }}
                                                        VNĐ</h4>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>




                                <table class="table no-border">
                                    <tbody>
                                        <tr>
                                            <td class="cart_total_label">
                                                <h6 class="text-muted">Tổng tiền</h6>
                                            </td>
                                            <td class="cart_total_amount">
                                                <h4 class="text-brand text-end">
                                                    {{ number_format(\Cart::subtotal(), 0, '', ',') }} VNĐ</h4>
                                            </td>
                                        </tr>

                                        @if ($couponPercent)
                                            <tr>
                                                <td class="cart_total_label">
                                                    <h6 class="text-muted">Tên mã giảm giá</h6>
                                                </td>

                                                <td class="cart_total_amount">
                                                    <h6 class="text-brand text-end">{{ $couponPercent->name }}</h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="cart_total_label">
                                                    <h6 class="text-muted">Giảm giá</h6>
                                                </td>
                                                <td class="cart_total_amount">
                                                    <h4 class="text-brand text-end">{{ $couponPercent->percent }} %
                                                    </h4>
                                                </td>
                                            </tr>
                                        @endif


                                        @php
                                            if ($couponPercent) {
                                                $total = \Cart::subtotal() - \Cart::subtotal() * ($couponPercent->percent / 100);
                                            } else {
                                                $total = \Cart::subtotal();
                                            }
                                        @endphp
                                        <tr>
                                            <td class="cart_total_label">
                                                <h6 class="text-muted">Tổng tiền cần thanh toán</h6>
                                            </td>
                                            <td class="cart_total_amount">
                                                <h4 class="text-brand text-end">{{ number_format($total, 0, '', ',') }}
                                                    VNĐ</h4>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="payment ml-30">
                            <h4 class="mb-30">Phương thức thanh toán</h4>
                            <div class="payment_option">
                                <div class="custome-radio">
                                    <input class="form-check-input" type="radio" value="back"
                                        id="exampleRadios3" checked="" wire:model="payment">
                                    <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse"
                                        data-target="#bankTranfer" aria-controls="bankTranfer">Chuyển khoản ngân
                                        hàng</label>
                                </div>
                                <div class="custome-radio">
                                    <input class="form-check-input" type="radio" id="exampleRadios4"
                                        checked="" value="delivery" wire:model="payment">
                                    <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse"
                                        data-target="#checkPayment" aria-controls="checkPayment">Thanh toán khi nhận
                                        hàng</label>
                                </div>
                                <div style="color:red;">
                                    @error('payment')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="payment-logo d-flex">
                                <img class="mr-15"
                                    src="{{ asset('front-end/assets/imgs/theme/icons/payment-paypal.svg') }}"
                                    alt="">
                                <img class="mr-15"
                                    src="{{ asset('front-end/assets/imgs/theme/icons/payment-visa.svg') }}"
                                    alt="">
                                <img src="{{ asset('front-end/assets/imgs/theme/icons/payment-zapper.svg') }}"
                                    alt="">
                            </div>
                            <button type="submit" class="btn btn-fill-out btn-block mt-30">Tiến hành thanh toán<i
                                    class="fi-rs-sign-out ml-15"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
</div>
