@extends('client.layout.master')

@section('nav-homepage')
    <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0"
        id="navbar-vertical">
        @include('client.blocks.side-bar')
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
            @foreach ($categoryDemo as $data)
                <div class="col-lg-4 col-md-6 pb-1">
                    <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                        @if (array_key_exists($data->id, $productCounts))
                            {{ $productCounts[$data->id] }} Sản phẩm
                        @else
                            0 Sản phẩm
                        @endif
                        <a href="" class="cat-img position-relative overflow-hidden mb-3">
                            <img class="img-fluid" src="{{ asset('client_asset/img/cat-demo.png') }}" alt="">
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
                    <img src="{{ asset('client_asset/img/cat-demo.png') }}" alt="">
                    <div class="position-relative" style="z-index: 1;">
                        <h5 class="text-uppercase text-primary mb-3">Giảm giá 5%</h5>
                        <h1 class="mb-4 font-weight-semi-bold">Sách nổi bật trong tuần</h1>
                        {{-- <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-6 pb-4">
                <div class="position-relative bg-secondary text-center text-md-left text-white mb-2 py-5 px-5">
                    <img src="{{ asset('client_asset/img/cat-demo.png') }}" alt="">
                    <div class="position-relative" style="z-index: 1;">
                        <h5 class="text-uppercase text-primary mb-3">Giảm giá 5%</h5>
                        <h1 class="mb-4 font-weight-semi-bold">Sách nhiều người mua</h1>
                        {{-- <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a> --}}
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
            @foreach ($outstandingProducts as $data)
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100 rounded"
                                src="{{ asset("images/product/main_image/$data->main_image") }}"
                                alt="{{ $data->name }}">
                            @if ($data->discount_percentage > 0)
                                <span class="badge badge-danger position-absolute mt-2 mr-2"
                                    style="top: 0; right: 0; z-index: 10;">
                                    {{ round($data->discount_percentage * 100) }}%
                                </span>
                            @endif
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{ $data->name }}</h6>
                            <div class="d-flex justify-content-center">
                                @php
                                    $reducePrice = $data->price * (1 - $data->discount_percentage);
                                @endphp
                                <h6>{{ Number::currency($reducePrice) }}</h6>
                                <h6 class="text-muted ml-2"><del>{{ Number::currency($data->price) }}</del></h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <button class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View
                                Detail</button>
                            <button data-url="{{ route('client.add-item-to-cart', ['product' => $data->id]) }}"
                                class="btn btn-sm text-dark p-0 add-product-to-cart"><i
                                    class="fas fa-shopping-cart text-primary mr-1"></i>Thêm</button>
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
            @foreach ($newProduct as $data)
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100 rounded"
                                src="{{ asset("images/product/main_image/$data->main_image") }}"
                                alt="{{ $data->name }}">
                            @if ($data->discount_percentage > 0)
                                <span class="badge badge-danger position-absolute mt-2 mr-2"
                                    style="top: 0; right: 0; z-index: 10;">
                                    {{ round($data->discount_percentage * 100) }}%
                                </span>
                            @endif
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{ $data->name }}</h6>
                            <div class="d-flex justify-content-center">
                                @php
                                    $reducePrice = $data->price * (1 - $data->discount_percentage);
                                @endphp
                                <h6>{{ Number::currency($reducePrice) }}</h6>
                                <h6 class="text-muted ml-2"><del>{{ Number::currency($data->price) }}</del></h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <button class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View
                                Detail</button>
                            <button data-product="{{ $data->id }}"
                                data-url="{{ route('client.add-item-to-cart', ['product' => $data->id]) }}"
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

    {{-- toast --}}
    <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-end align-items-end"
        style="min-height: 100px; position: fixed; bottom: 20px; right: 20px; z-index: 1050;">
        <div class="toast" role="alert" data-delay="3000">
            <div class="toast-header">
                {{-- <img src="..." class="rounded mr-2" alt="..."> --}}
                <strong class="mr-auto">Thông báo</strong>
                {{-- <small>11 mins ago</small> --}}
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                Thêm sản phẩm thành công
            </div>
        </div>
    </div>
@endsection
@section('my-js')
    <script>
        $(document).ready(function() {
            $('.add-product-to-cart').on('click', function(e) {
                e.preventDefault();

                var url = $(this).data('url');
                var productId = $(this).data('product');
                $.ajax({
                    method: "POST",
                    url: url,
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: productId
                    },
                    success: function(response) {
                        updateCartCount();
                        $('.toast').toast('show');
                    },
                    statusCode: {
                        401: function() {
                            window.location.href = "{{ route('login') }}";
                        }
                    }
                });
            });
        });
    </script>
@endsection
