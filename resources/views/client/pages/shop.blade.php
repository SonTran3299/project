@extends('client.layout.master')

@section('nav-other-pages')
    <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light"
        id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
        @include('client.blocks.side-bar', ['dataCategory' => $dataCategory])
    </nav>
@endsection

@section('page-header')
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Danh sách sản phẩm</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shop</p>
            </div>
        </div>
    </div>
@endsection

@section('main-content')
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <!-- Price Start -->
                <div class="border-bottom mb-4 pb-4">

                    <form action="{{ route('client.shop') }}" method="GET">
                        {{-- <h5 class="font-weight-semi-bold mb-4">Lọc theo tên sản phẩm</h5>
                        <div class="form-row mb-4">
                            <input type="text" class="form-control" id="query" name="query"
                                    placeholder="Tìm tên sản phẩm" value="{{ request()->get('query') ?? '' }}">
                        </div> --}}
                        <h5 class="font-weight-semi-bold mb-4">Lọc theo giá</h5>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="minPrice" placeholder="Tối thiểu">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="maxPrice" placeholder="Tối đa">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success w-100 mt-1">Áp dụng</button>
                    </form>
                </div>
                <!-- Price End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div>
                            {{-- <form action="{{ route('client.shop') }}" method="GET" id="searchSortForm"
                                class="d-flex align-items-center justify-content-between mb-4"> --}}
                            <form action="{{ route('client.shop') }}" method="GET" id="searchSortForm"
                                class="d-flex align-items-center justify-content-end mb-4">

                                {{-- <div>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="query" name="query"
                                            placeholder="Tìm tên sản phẩm" value="{{ request()->get('query') ?? '' }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="input-group-text bg-transparent text-primary">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="ml-4">
                                    <select class="form-control mr-sm-2" name="sort" id="sort">
                                        <option {{ in_array(request()->get('sort'), ['latest', '']) ? 'selected' : '' }}
                                            value="latest">
                                            Mới nhất</option>
                                        <option {{ request()->get('sort') === 'oldest' ? 'selected' : '' }} value="oldest">
                                            Cũ nhất
                                        </option>

                                        {{-- <option {{ in_array(request()->get('sort'), ['latest', '']) ? 'selected' : '' }}
                                            value="latest">
                                            Mua nhiều nhất</option> --}}
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>

                    @foreach ($dataProduct as $data)
                        <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4">
                                <div
                                    class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img class="img-fluid w-100" src="{{ asset("images/$data->main_image") }}"
                                        alt="{{ $data->name }}">
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3">{{ $data->name }}</h6>
                                    <div class="d-flex justify-content-center">
                                        <h6>{{ Number::currency($data->price) }}</h6>
                                        {{-- <h6>{{$data->price*(1 - $data->discount_percentage)}}</h6> --}}
                                        <h6 class="text-muted ml-2"><del>{{ Number::currency($data->price) }}</del></h6>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a href="{{ route('client.detail', ['product' => $data->id]) }}"
                                        class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Chi
                                        tiết</a>
                                    <a href="" class="btn btn-sm text-dark p-0"><i
                                            class="fas fa-shopping-cart text-primary mr-1"></i>Thêm vào giỏ</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- Pagination --}}
                    <div class="col-12 pb-1">
                        <nav aria-label="Page navigation">
                            {{ $dataProduct->withQueryString()->links() }}
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
@endsection
@section('my-js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sortSelect = document.getElementById('sort');
            const searchSortForm = document.getElementById('searchSortForm');

            if (sortSelect && searchSortForm) {
                sortSelect.addEventListener('change', function() {
                    searchSortForm.submit(); // Gửi form khi giá trị của select thay đổi
                });
            }
        });
    </script>
@endsection
