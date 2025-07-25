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
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Checkout</p>
            </div>
        </div>
    </div>
@endsection

@section('main-content')
    <div class="container-fluid pt-5">
        <form action="{{ route('client.place-order') }}" method="post">
            @csrf
            <div class="row px-xl-5">
                <div class="col-lg-8">
                    <div class="mb-4">
                        <h4 class="font-weight-semi-bold mb-4">Địa chỉ nhận đơn</h4>
                        <div class="col-md-12 form-group">
                            <label>Tên</label>
                            <input class="form-control" type="text" name="name" value="{{ $user->name }}" readonly>
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Email</label>
                            <input class="form-control" type="text" name="email" value="{{ $user->email }}" readonly>
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Số điện thoại</label>
                            <input class="form-control" type="text" name="phone" value="{{ $user->phone }}">
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Địa chỉ </label>
                            <input class="form-control" type="text" name="address" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Ghi chú đơn hàng </label>
                            <input class="form-control" type="text" name="note"
                                placeholder="Thêm ghi chú của bạn cho đơn hàng">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Tổng đơn hàng</h4>
                        </div>
                        <div class="card-body">
                            <h5 class="font-weight-medium mb-3">Sản phẩm</h5>
                            @php $priceTotal = 0 @endphp
                            @foreach ($cart as $data)
                                <div class="d-flex justify-content-between">
                                    <p>{{ $data->product->name }}</p>
                                    @php
                                        $price = $data->product->price * $data->quantity;
                                        $priceTotal += $price;
                                    @endphp
                                    <p>{{ Number::currency($price) }}</p>
                                </div>
                            @endforeach

                            <hr class="mt-0">
                            <div class="d-flex justify-content-between mb-3 pt-1">
                                <h6 class="font-weight-medium">Tạm tính</h6>
                                <h6 class="font-weight-medium">{{ Number::currency($priceTotal) }}</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Phí giao hàng</h6>
                                @if ($totalPrice > 2000000)
                                    @php $shippingFee = 0 @endphp
                                @else
                                    @php $shippingFee = 10000 @endphp
                                @endif
                                <h6 class="font-weight-medium">{{ $shippingFee }}</h6>
                            </div>
                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <div class="d-flex justify-content-between mt-2">
                                <h5 class="font-weight-bold">Tổng cộng</h5>
                                <h5 class="font-weight-bold">{{ Number::currency($priceTotal + $shippingFee) }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Phương thức thanh toán</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment_method" id="cash"
                                        value="cash">
                                    <label class="custom-control-label" for="cash">Thanh toán khi nhận hàng</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment_method" id="vnpay"
                                        value="vnpay">
                                    <label class="custom-control-label" for="vnpay">VNPAY</label>
                                </div>
                            </div>
                            {{-- <div class="">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment_method"
                                        id="banktransfer" value="banktransfer">
                                    <label class="custom-control-label" for="banktransfer">Chuyển khoản ngân hàng</label>
                                </div>
                            </div> --}}
                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Đặt hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
