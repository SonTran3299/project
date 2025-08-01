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
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Giỏ hàng</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('client.home') }}">Trang chủ</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Giỏ hàng</p>
            </div>
        </div>
    </div>
@endsection

@section('main-content')
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            @if (!empty($cart) && count($cart) > 0)
                <div class="col-lg-8 table-responsive mb-5">
                    <table class="table table-bordered text-center mb-0">
                        <thead class="bg-secondary text-dark">
                            <tr>
                                <th>Hình ảnh</th>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng cộng</th>
                                <th>Chiết khấu</th>
                                <th>Xoá</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @php $totalPrice = 0 @endphp
                            @foreach ($cart as $data)
                                <tr class="update-total-price">
                                    <td class="align-middle text-left">
                                        <img src="{{ asset('images/product/main_image/' . $data->product->main_image) }}"
                                            alt="{{ $data->product->name }}" style="width: 50px;">
                                    </td>
                                    <td class="align-middle text-left"><img src="" alt=""
                                            style="width: 50px;">
                                        {{ $data->product->name }}
                                    </td>
                                    <td class="align-middle">
                                        {{ Number::currency($data->product->price) }}
                                    </td>
                                    <td class="align-middle">
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-minus" type="submit"
                                                    name="minus">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" name="product_quantity"
                                                class="form-control form-control-sm bg-secondary text-center quantity-input"
                                                value="{{ $data->quantity }}">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-plus" type="submit"
                                                    name="plus">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    @php
                                        $total = $data->quantity * $data->product->price;
                                        $totalPrice += $total;
                                    @endphp
                                    <td class="align-middle">{{ Number::currency($total) }}</td>
                                    <td class="align-middle">{{ $data->product->discount_percentage * 100 }}%</td>
                                    <td class="align-middle">
                                        <form action="{{ route('client.delete-product', ['product' => $data->id]) }}"
                                            method="post">
                                            @csrf
                                            <button class="btn btn-sm btn-primary"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="col-lg-4">
                    {{-- chưa --}}
                    <form class="mb-5" action="">
                        <div class="input-group">
                            <input type="text" class="form-control p-4" placeholder="Mã giảm giá">
                            <div class="input-group-append">
                                <button class="btn btn-primary">Thêm mã giảm giá</button>
                            </div>
                        </div>
                    </form>

                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Tạm tính</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3 pt-1">
                                <h6 class="font-weight-medium">Tổng tiền</h6>
                                <h6 class="font-weight-medium cart-subtotal">
                                    {{ Number::currency($caculatePrice['subtotal']) }}</h6>
                            </div>
                            <div class="d-flex justify-content-between mb-3 pt-1">
                                <h6 class="font-weight-medium">Giảm giá</h6>
                                <h6 class="font-weight-medium cart-subtotal text-danger font-italic">
                                    {{ Number::currency($caculatePrice['discount']) }}</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Phí vận chuyển</h6>
                                <h6 class="font-weight-medium" id="shipping-fee">
                                    {{ Number::currency($caculatePrice['shippingFee']) }}
                                </h6>
                            </div>
                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <div class="d-flex justify-content-between mt-2">
                                <h5 class="font-weight-bold">Tổng cộng</h5>
                                <h5 class="font-weight-bold" id="final-price">
                                    {{ Number::currency($caculatePrice['total']) }}
                                </h5>
                            </div>
                            <a href="{{ route('client.checkout') }}" class="btn btn-block btn-success my-3 py-3"
                                style="font-size: 18px">
                                Thanh toán
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-12 text-center">
                    <h4 class="text-danger font-weight-bold">Giỏ hàng rỗng, hãy tiếp tục mua sắm</h4>
                </div>
            @endif
        </div>
    </div>
@endsection
