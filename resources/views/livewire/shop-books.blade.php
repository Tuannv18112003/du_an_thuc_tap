<div>
    <main class="main">
        <div class="page-header mt-30 mb-50">
            <div class="container">
                <div class="archive-header">
                    <div class="row align-items-center">
                        <div class="col-xl-3">
                            @if ($title)
                                <h1 class="mb-15">{{ implode('', $title) }}</h1>
                            @else
                                <h1 class="mb-15">Cửa hàng</h1>
                            @endif
                            <div class="breadcrumb">
                                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
                                <span></span> Cửa hàng <span></span> {{ $title ? implode('', $title) : '' }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-30">
            <div class="row flex-row-reverse">
                <div class="col-lg-4-5">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p>Chúng tôi tìm thấy <strong
                                    class="text-brand">{{ $books->count() ?? $categoires->books->count() }}</strong> Sản
                                phẩm cho bạn!</p>
                        </div>
                        <div class="sort-by-product-area">
                            <div class="sort-by-cover mr-10">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps"></i>Show:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">50</a></li>
                                        <li><a href="#">100</a></li>
                                        <li><a href="#">150</a></li>
                                        <li><a href="#">200</a></li>
                                        <li><a href="#">All</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sort-by-cover">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">Featured</a></li>
                                        <li><a href="#">Price: Low to High</a></li>
                                        <li><a href="#">Price: High to Low</a></li>
                                        <li><a href="#">Release Date</a></li>
                                        <li><a href="#">Avg. Rating</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row product-grid">
                        {{-- @dd($books) --}}
                        @foreach ($books as $item)
                            <livewire:view-book-tabs wire:key="{{ $item->id }}" :$item />
                        @endforeach
                        <!--end product card-->
                        {{$books->links()}}
                    </div>
                    <!--product grid-->
                    <div class="pagination-area mt-20 mb-20">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                                <li class="page-item"><a class="page-link" href="#">6</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <!--End Deals-->


                </div>
                <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                    <div class="sidebar-widget widget-category-2 mb-30">
                        <h5 class="section-title style-1 mb-30">Danh mục</h5>
                        <ul>
                            @foreach ($categories as $item)
                                <li wire:key="{{ $item->id }}"
                                    wire:click.prevent="filterCategories({{ $item->id }})">
                                    <a href=""> <img src="{{ asset('/storage/' . $item->image) }}"
                                            alt="" />{{ $item->name }}</a><span
                                        class="count">{{ $item->books->count() }}</span>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                    <!-- Fillter By Price -->
                    <div class="sidebar-widget price_range range mb-30" wire:ignore>
                        <h5 class="section-title style-1 mb-30">Lọc theo giá</h5>
                        <div class="price-filter" x-data="{ max_price: @js($maxPrice), min_price: @js($minPrice)}">
                            <div class="price-filter-inner"  x-on:click="filter_prices" >
                                <div id="slider-range"class="mb-20">

                                </div>
                                <div class="d-flex justify-content-between" >
                                    <input id="rangeMin" type="number" max="{{ $maxPrice }}"
                                        min="{{ $minPrice }}" step="5" value="{{ $minPrice }}" hidden >
                                    <input id="rangeMax" type="number" max="{{ $maxPrice }}"
                                        min="{{ $minPrice }}" step="5" value="{{ $maxPrice }}"
                                        hidden>

                                    <div class="caption d-flex align-items-center">From:
                                        <input type="text" id="slider-range-value1" class="text-brand"
                                             style="padding-left: 4px; border: none; font-weight:600;background-color: #fff;" disabled>
                                    </div>
                                    <div class="caption d-flex align-items-center">To: 
                                        <input type="text" id="slider-range-value2" class="text-brand "
                                            style="padding-left: 4px; border: none; font-weight:600;background-color: #fff;" disabled></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="banner-img wow fadeIn mb-lg-0 animated d-lg-block d-none">
                        <img src="assets/imgs/banner/banner-11.png" alt="" />
                    </div> --}}
                </div>
            </div>
        </div>
    </main>
    @push('scripts')
        <script>
            function filter_prices() {
                let max = parseInt(document.querySelector('#slider-range-value2').value.replace(/đ|,/g, ''));
                let min = parseInt(document.querySelector('#slider-range-value1').value.replace(/đ|,/g, ''));

                @this.dispatch('filterPrices', {max: max, min: min}); 
            }
            

            document.addEventListener('livewire:initialized', () => {


                if ($("#slider-range").length) {
                    $(".noUi-handle").on("click", function() {
                        $(this).width(50);
                    });

                    var rangeSlider = document.getElementById("slider-range");
                    var moneyFormat = wNumb({
                        decimals: 0,
                        thousand: ",",
                        prefix: "đ",
                    });



                    let maxPrice = parseInt(document.querySelector("#rangeMax").value) + 20000;
                    let minPrice = parseInt(document.querySelector("#rangeMin").value) - 10000;
                    if(minPrice <= 0) {
                        minPrice = 0;
                    }
                    noUiSlider.create(rangeSlider, {
                        start: [minPrice, maxPrice],
                        step: 1000,
                        range: {
                            min: [minPrice],
                            max: [maxPrice],
                        },
                        format: moneyFormat,
                        connect: true,
                    });

                    // Set visual min and max values and also update value hidden form inputs
                    rangeSlider.noUiSlider.on("update", function(values, handle) {
                        document.getElementById("slider-range-value1").value = values[0];

                        let min = document.getElementsByName("min-value").value = moneyFormat.from(values[0]);

                        document.getElementById("slider-range-value2").value = values[1];
                        document.getElementsByName("max-value").value = moneyFormat.from(values[1]);
                    });
                }

            })
        </script>
    @endpush
</div>
