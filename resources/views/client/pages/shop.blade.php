@extends('client.layout.master')

@section('nav-other-pages')
    <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light"
        id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
        @include('client.blocks.side-bar')
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

                    <form action="{{ route('client.shop') }}" method="GET" id="price-filter-form">
                        <h5 class="font-weight-semi-bold mb-4">Lọc theo giá</h5>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="number" class="form-control" id="minPrice" name="min_price"
                                    placeholder="Tối thiểu" value="{{ request()->get('min_price') ?? '' }}">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="number" class="form-control" id="maxPrice" name="max_price"
                                    placeholder="Tối đa" value="{{ request()->get('max_price') ?? '' }}">
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
                            <form action="{{ route('client.shop') }}" method="GET" id="sort-form"
                                class="d-flex align-items-center justify-content-end mb-4 ">
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
                                    <img class="img-fluid w-100" src="{{ asset("images/product/main_image/$data->main_image") }}"
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
                                    <a href="{{ route('client.detail', ['product' => $data->id]) }}"
                                        class="btn btn-sm text-dark p-0">
                                        <i class="fas fa-eye text-primary mr-1"></i>
                                        Chi tiết
                                    </a>
                                    <button class="btn btn-sm text-dark p-0">
                                        <i class="fas fa-shopping-cart text-primary mr-1"></i>
                                        Thêm vào giỏ
                                    </button>
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
            const filterForm = document.getElementById('price-filter-form');
            const searchForm = document.getElementById('search-form');

            function submitAllFilters(source) {
                const params = new URLSearchParams(window.location.search);

                if (sortSelect) {
                    params.set('sort', sortSelect.value);
                }

                if (searchForm) {
                    const query = searchForm.querySelector('input[name="query"]')?.value;
                    if (query) {
                        params.set('query', query);
                    } else {
                        params.delete('query');
                    }
                }

                if (source === 'search') {
                    params.delete('min_price');
                    params.delete('max_price');
                } else if (filterForm) {
                    const minPrice = filterForm.querySelector('#minPrice')?.value;
                    const maxPrice = filterForm.querySelector('#maxPrice')?.value;

                    if (minPrice) {
                        params.set('min_price', minPrice);
                    } else {
                        params.delete('min_price');
                    }
                    if (maxPrice) {
                        params.set('max_price', maxPrice);
                    } else {
                        params.delete('max_price');
                    }
                }

                window.location.href = "{{ route('client.shop') }}?" + params.toString();
            }

            if (sortSelect) {
                sortSelect.addEventListener('change', function() {
                    submitAllFilters('sort');
                });
            }

            if (filterForm) {
                filterForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    submitAllFilters('filter');
                });
            }

            if (searchForm) {
                searchForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    submitAllFilters('search');
                });

                // Nhấn enter gửi form
                const searchInput = searchForm.querySelector('input[name="query"]');
                if (searchInput) {
                    // Dùng 'keyup' thay vì 'up'
                    searchInput.addEventListener('keyup', function(e) {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            submitAllFilters('search');
                        }
                    });
                }
            }
        });
    </script>
@endsection
