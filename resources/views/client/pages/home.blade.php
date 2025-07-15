@extends('client.layout.master')

@section('nav-homepage')
    <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0"
        id="navbar-vertical">
        @include('client.blocks.side-bar', ['dataCategory' => $dataCategory])
    </nav>
@endsection

@section('header-carousel')
    <div id="header-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" style="height: 410px;">
                <img class="img-fluid" src="{{ asset('client_asset/img/carousel-1.jpg') }}" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        <h4 class="text-light text-uppercase font-weight-medium mb-3">Giảm 10% cho đơn hàng đầu tiên</h4>
                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">Fashionable Dress</h3>
                        <a href="" class="btn btn-light py-2 px-3">Mua ngay</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item" style="height: 410px;">
                <img class="img-fluid" src="{{ asset('client_asset/img/carousel-2.jpg') }}" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        <h4 class="text-light text-uppercase font-weight-medium mb-3">Ưu đãi tháng 8</h4>
                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">Giá ưu đãi bất ngờ</h3>
                        <a href="" class="btn btn-light py-2 px-3">Mua ngay</a>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-prev-icon mb-n2"></span>
            </div>
        </a>
        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-next-icon mb-n2"></span>
            </div>
        </a>
    </div>
@endsection

@section('page-header')
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('main-content')
    <!-- Danh mục hàng demo -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            @foreach ($dataCategory as $data)
                <div class="col-lg-4 col-md-6 pb-1">
                    <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                        <p class="text-right">15 Products</p>
                        <a href="" class="cat-img position-relative overflow-hidden mb-3">
                            <img class="img-fluid" src="{{ asset("client_asset/img/cat-$loop->iteration.jpg") }}"
                                alt="">
                        </a>
                        <h5 class="font-weight-semi-bold m-0">{{ Str::title($data->name) }}</h5>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <!----------------------->

    <!-- Ưu đãi -->
    <div class="container-fluid offer pt-5">
        <div class="row px-xl-5">
            <div class="col-md-6 pb-4">
                <div class="position-relative bg-secondary text-center text-md-right text-white mb-2 py-5 px-5">
                    <img src="{{ asset('client_asset/img/offer-1.png') }}" alt="">
                    <div class="position-relative" style="z-index: 1;">
                        <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                        <h1 class="mb-4 font-weight-semi-bold">Spring Collection</h1>
                        <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pb-4">
                <div class="position-relative bg-secondary text-center text-md-left text-white mb-2 py-5 px-5">
                    <img src="{{ asset('client_asset/img/offer-2.png') }}" alt="">
                    <div class="position-relative" style="z-index: 1;">
                        <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                        <h1 class="mb-4 font-weight-semi-bold">Winter Collection</h1>
                        <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!----------------------->

    <!-- Sản phẩm nổi bật -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Sản phẩm nổi bật</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            @foreach ($dataProduct as $data)
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="{{ asset("images/$data->main_image") }}"
                                alt="{{ $data->name }}">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{ $data->name }}</h6>
                            <div class="d-flex justify-content-center">
                                <h6>{{ Number::currency($data->price) }}</h6>
                                <h6 class="text-muted ml-2"><del>{{ Number::currency($data->price) }}</del></h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="" class="btn btn-sm text-dark p-0"><i
                                    class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                            <a href="" class="btn btn-sm text-dark p-0"><i
                                    class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!----------------------->


    <!-- Subscribe Start -->
    <div class="container-fluid bg-secondary my-5">
        <div class="row justify-content-md-center py-5 px-xl-5">
            <div class="col-md-6 col-12 py-5">
                <div class="text-center mb-2 pb-2">
                    <h2 class="section-title px-5 mb-3"><span class="bg-secondary px-2">Stay Updated</span></h2>
                    <p>Amet lorem at rebum amet dolores. Elitr lorem dolor sed amet diam labore at justo ipsum eirmod duo
                        labore labore.</p>
                </div>
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-white p-4" placeholder="Nhập Email Của bạn">
                        <div class="input-group-append">
                            <button class="btn btn-primary px-4">Đăng ký ngay</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Subscribe End -->


    <!-- Sản phẩm mới -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Sản phẩm mới</span></h2>
        </div>

        <div class="row px-xl-5 pb-3">
            @foreach ($dataProduct as $data)
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100 rounded" src="{{ asset("images/$data->main_image") }}"
                                alt="{{ $data->name }}">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{ $data->name }}</h6>
                            <div class="d-flex justify-content-center">
                                <h6>{{ Number::currency($data->price) }}</h6>
                                <h6 class="text-muted ml-2"><del>{{ Number::currency($data->price) }}</del></h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <button class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View
                                Detail</button>
                            <button data-my-url="{{ route('client.add-item-to-cart', ['product' => $data->id]) }}"
                                class="btn btn-sm text-dark p-0 add-product-to-cart"><i
                                    class="fas fa-shopping-cart text-primary mr-1"></i>Thêm</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!----------------------->


    <!-- Nhà cung cấp -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    @for ($i = 1; $i <= 8; $i++)
                        <div class="vendor-item border p-4">
                            <img src="{{ asset("client_asset/img/vendor-$i.jpg") }}" alt="">
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
    <!----------------------->
@endsection
@section('my-js')
    <script>
        $(document).ready(function() {
            $('.add-product-to-cart').on('click', function(e) {
                e.preventDefault();
                var myUrl = $(this).data('my-url');
                $.ajax({
                    method: "GET", //method of form
                    url: myUrl,
                    success: function(response) {
                        alert(response.message);
                    }
                });
            });
        });
    </script>
@endsection
