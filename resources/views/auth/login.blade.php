<x-layouts.layout-client>
     <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
                    <span></span> Đăng nhập <span></span>
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                        <div class="row">
                            <div class="col-lg-6 pr-30 d-none d-lg-block">
                                <img class="border-radius-15" src="{{asset('front-end/assets/imgs/page/login-1.png')}}" alt="" />
                            </div>
                            <div class="col-lg-6 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h1 class="mb-5">Đăng nhập</h1>
                                            <p class="mb-30">Không có tài khoản? <a href="{{route('register')}}">Tạo ngay</a></p>
                                        </div>
                                        <form method="post" action="{{ route('login') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" name="email" class="@error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" placeholder="Email *" />
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" class="@error('password') is-invalid @enderror" name="password"
                                                required autocomplete="current-password" placeholder="Mật khẩu *" />
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            
                                            <div class="login_footer form-group mb-50">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                            {{ old('remember') ? 'checked' : '' }}value="" />
                                                        <label class="form-check-label" for="remember"><span>Lưu đăng nhập</span></label>
                                                    </div>
                                                </div>
                                                @if (Route::has('password.request'))
                                                    <a class="text-muted" href="{{ route('password.request') }}">
                                                        {{ __('Quên mật khẩu?') }}
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-heading btn-block hover-up" name="login">Đăng nhập</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layouts.layout-client>
