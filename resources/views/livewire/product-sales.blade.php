<div>
    <section class="section-padding pb-5">
        <div class="container">
            <div class="section-title wow animate__animated animate__fadeIn">
                <h3 class=""> Sản phẩm giảm giá </h3>

            </div>
            <div class="row">
                <div class="col-lg-3 d-none d-lg-flex wow animate__animated animate__fadeIn">
                    <div class="banner-img style-2">
                        <div class="banner-text">
                            <h2 class="mb-100">SALE nhân ngày nhà giáo Việt Nam</h2>
                            <a href="/san-pham" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                    <div class="tab-content" id="myTabContent-1">
                        <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel"
                            aria-labelledby="tab-one-1">
                            <div class="carausel-4-columns-cover arrow-center position-relative">
                                <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow"
                                    id="carausel-4-columns-arrows"></div>
                                <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">
                                    @foreach ($booksSale as $item)
                                        <div class="product-cart-wrap" wire:key="{{ $item->id }}">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="shop-product-right.html">
                                                        <img class="default-img"
                                                            src="{{ asset('/storage/' . $item->image) }}"
                                                            alt="" />
                                                        <img class="hover-img"
                                                            src="{{ asset('/storage/' . $item->image) }}"
                                                            alt="" />
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn small hover-up"
                                                        data-bs-toggle="modal" data-bs-target="#quickViewModal"> <i
                                                            class="fi-rs-eye"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up"
                                                        href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn small hover-up"
                                                        href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot">{{ $item->discount_price }} %</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a href="">{{ $item->categories->name }}</a>
                                                </div>
                                                <h2><a
                                                        href="/chi-tiet-san-pham/{{ $item->slug }}">{{ $item->name }}</a>
                                                </h2>
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 80%"></div>
                                                </div>
                                                <div class="product-price mt-10">
                                                    @php
                                                        $disount_price = $item->selling_price - $item->selling_price * ($item->discount_price / 100);
                                                    @endphp
                                                    <span>{{ number_format($disount_price, 0, '', ',') }} VNĐ</span>

                                                    @if ($item->discount_price > 0)
                                                        <span
                                                            class="old-price ">{{ number_format($item->selling_price, 0, '', ',') }}
                                                            VNĐ</span>
                                                    @endif
                                                </div>
                                                <a wire:click.prevent="$dispatch('add-to-cart', { id: {{$item->id}} })"class="btn w-100 hover-up"><i
                                                        class="fi-rs-shopping-cart mr-5" ></i>Thêm vào giỏ hàng</a>
                                            </div>
                                        </div>
                                        <!--End product Wrap-->
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!--End tab-pane-->


                    </div>
                    <!--End tab-content-->
                </div>
                <!--End Col-lg-9-->
            </div>
        </div>
    </section>
</div>
