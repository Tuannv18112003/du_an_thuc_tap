<div>
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
                    <span></span> Tài khoản <span></span>
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="dashboard-menu">
                                    <ul class="nav flex-column" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab"
                                                href="#dashboard" role="tab" aria-controls="dashboard"
                                                aria-selected="false"><i
                                                    class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders"
                                                role="tab" aria-controls="orders" aria-selected="false"><i
                                                    class="fi-rs-shopping-bag mr-10"></i>Sản phẩm đã đặt</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab"
                                                href="#account-detail" role="tab" aria-controls="account-detail"
                                                aria-selected="true"><i class="fi-rs-user mr-10"></i>Cập nhật tài
                                                khoản</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="" x-on:click.prevent="logout"><i
                                                    class="fi-rs-sign-out mr-10"></i>Đăng xuất</a>
                                            <form action="{{ route('logout') }}" method="post" id="logout">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="tab-content account dashboard-content pl-50">
                                    <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                        aria-labelledby="dashboard-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="mb-0">Hello Rosie!</h3>
                                            </div>
                                            <div class="card-body">
                                                <p>
                                                    From your account dashboard. you can easily check &amp; view your <a
                                                        href="#">recent orders</a>,<br />
                                                    manage your <a href="#">shipping and billing addresses</a> and
                                                    <a href="#">edit your password and account details.</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="orders" role="tabpanel"
                                        aria-labelledby="orders-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="mb-0">Sản phẩm của bạn</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Ngày đặt hàng</th>
                                                                <th>Tổng tiền</th>
                                                                <th>Trạng thái</th>
                                                                <th>Hành động</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($carts as $item)
                                                                <tr wire:key="$item->id">
                                                                    <td>{{ $item->date_order }}</td>
                                                                    <td>{{ number_format($item->total_price) }}</td>
                                                                    <td>
                                                                        @if ($item->status == 1)
                                                                            Đã đặt hàng
                                                                        @elseif($item->status == 2)
                                                                            Đơn hàng đã được xác nhận
                                                                        @elseif($item->status == 3)
                                                                            Đơn hàng đang trên đường giao đến bạn
                                                                        @elseif($item->status == 4)
                                                                            Đã giao hàng thành công
                                                                        @elseif($item->status == 0)
                                                                            Đơn hàng đã bị hủy
                                                                        @endif
                                                                    </td>
                                                                    <td><a href="#"
                                                                            class="btn-small d-block">Xem chi tiết</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="track-orders" role="tabpanel"
                                        aria-labelledby="track-orders-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="mb-0">Orders tracking</h3>
                                            </div>
                                            <div class="card-body contact-from-area">
                                                <p>To track your order please enter your OrderID in the box below and
                                                    press "Track" button. This was given to you on your receipt and in
                                                    the confirmation email you should have received.</p>
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <form class="contact-form-style mt-30 mb-50" action="#"
                                                            method="post">
                                                            <div class="input-style mb-20">
                                                                <label>Order ID</label>
                                                                <input name="order-id"
                                                                    placeholder="Found in your order confirmation email"
                                                                    type="text" />
                                                            </div>
                                                            <div class="input-style mb-20">
                                                                <label>Billing email</label>
                                                                <input name="billing-email"
                                                                    placeholder="Email you used during checkout"
                                                                    type="email" />
                                                            </div>
                                                            <button class="submit submit-auto-width"
                                                                type="submit">Track</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="account-detail" role="tabpanel"
                                        aria-labelledby="account-detail-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Cập nhật tài khoản</h5>
                                            </div>
                                            <div class="card-body">
                                                <p>Already have an account? <a href="page-login.html">Log in
                                                        instead!</a></p>
                                                <form method="post" name="enq">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>First Name <span class="required">*</span></label>
                                                            <input required="" class="form-control" name="name"
                                                                type="text" />
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Last Name <span class="required">*</span></label>
                                                            <input required="" class="form-control"
                                                                name="phone" />
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>Display Name <span class="required">*</span></label>
                                                            <input required="" class="form-control" name="dname"
                                                                type="text" />
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>Email Address <span
                                                                    class="required">*</span></label>
                                                            <input required="" class="form-control" name="email"
                                                                type="email" />
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>Current Password <span
                                                                    class="required">*</span></label>
                                                            <input required="" class="form-control"
                                                                name="password" type="password" />
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>New Password <span class="required">*</span></label>
                                                            <input required="" class="form-control"
                                                                name="npassword" type="password" />
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>Confirm Password <span
                                                                    class="required">*</span></label>
                                                            <input required="" class="form-control"
                                                                name="cpassword" type="password" />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button type="submit"
                                                                class="btn btn-fill-out submit font-weight-bold"
                                                                name="submit" value="Submit">Save Change</button>
                                                        </div>
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
            </div>
        </div>
    </main>

    <script>
        function logout() {
            document.getElementById('logout').submit();
        }
    </script>
</div>
