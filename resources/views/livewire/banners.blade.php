<div>
    <section class="banners mb-25">
        <div class="container">
            <div class="row">
                @foreach ($banners as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="banner-img wow animate__ animate__fadeInUp animated" data-wow-delay="0"
                            style="visibility: visible; animation-name: fadeInUp;">
                            <img src="{{asset('/storage/'. $item->banner_image)}}" alt="">
                            <div class="banner-text">
                                <h4>
                                    {{-- {{$item->title}} --}}
                                </h4>
                                <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i
                                        class="fi-rs-arrow-small-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="col-lg-4 d-md-none d-lg-flex">
                    <div class="banner-img mb-sm-0 wow animate__ animate__fadeInUp animated" data-wow-delay=".4s"
                        style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                        <img src="assets/imgs/banner/banner-3.png" alt="">
                        <div class="banner-text">
                            <h4>The best Organic <br>Products Online</h4>
                            <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i
                                    class="fi-rs-arrow-small-right"></i></a>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
</div>
