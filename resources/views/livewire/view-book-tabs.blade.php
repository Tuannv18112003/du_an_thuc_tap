<div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
    <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
        <div class="product-img-action-wrap">
            <div class="product-img product-img-zoom">
                <a href="shop-product-right.html">
                    <img class="default-img" src="{{ asset('/storage/' . $item->image) }}" alt="" />
                    <img class="hover-img" src="{{ asset('/storage/' . $item->image) }}" alt="" />
                </a>
            </div>
            <div class="product-action-1">
                <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i
                        class="fi-rs-heart"></i></a>
                <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                        class="fi-rs-eye"></i></a>
            </div>
            <div class="product-badges product-badges-position product-badges-mrg">
                <span class="hot">{{ $type ?? '' }}</span>
            </div>
        </div>
        <div class="product-content-wrap">
            <div class="product-category">
                <a href="/chi-tiet-san-pham/{{ $item->slug }}">{{ $item->categories->name }}</a>
            </div>
            <h2><a href="/chi-tiet-san-pham/{{ $item->slug }}">{{ $item->name }}</a>
            </h2>
            <div class="product-rate-cover">
                <div class="product-rate d-inline-block">
                    <div class="product-rating" style="width: 90%"></div>
                </div>
                <span class="font-small ml-5 text-muted"> (4.0)</span>
            </div>

            <div class="product-card-bottom">
                <div class="product-price">
                    @php
                        $disount_price = $item->selling_price - $item->selling_price * ($item->discount_price / 100);
                    @endphp
                    <span>{{ number_format($disount_price, 0, '', ',') }} VNĐ</span>

                    @if ($item->discount_price > 0)
                        <span class="old-price ">{{ number_format($item->selling_price, 0, '', ',') }}
                            VNĐ</span>
                    @endif
                </div>
                <div class="add-cart">
                    <a class="add" href="" wire:click.prevent="addToCart({{ $item->id }})"><i
                            class="fi-rs-shopping-cart mr-5"></i>Thêm</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('add-to-cart', (event) => {
                @this.dispatch('notify', { message: 'New post added.' });
            });
        });
    </script>
</div>
