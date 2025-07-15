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
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Giỏ hàng</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Trang chủ</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Giỏ hàng</p>
            </div>
        </div>
    </div>
@endsection



{{-- Note tạo form cho nút + và - thử --}}


@section('main-content')
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng cộng</th>
                            <th>Xoá</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($datas as $data)
                            <tr class="update-total-price">
                                <td class="align-middle"><img src="" alt="" style="width: 50px;">
                                    Colorful Stylish Shirt</td>
                                <td class="align-middle">{{ $data->product_id }} price</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;"
                                        data-product-id="{{ $data->product_id }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus" type="submit" name="minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" name="product_quantity"
                                            class="form-control form-control-sm bg-secondary text-center quantity-input"
                                            value="{{ $data->quantity }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus" type="submit" name="plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">{{ $data->quantity * 10 }}</td>
                                <td class="align-middle"><button class="btn btn-sm btn-primary"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                {{-- <form class="mb-5" action="">
                    <div class="input-group">
                        <input type="text" class="form-control p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Thêm mã giảm giá</button>
                        </div>
                    </div>
                </form> --}}
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Tạm tính</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Tổng</h6>
                            <h6 class="font-weight-medium cart-subtotal">{{ $totalPrice ?? 0 }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Phí vận chuyển</h6>
                            <h6 class="font-weight-medium" id="shipping-fee">
                                {{ $shippingFee }}
                            </h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Tổng cộng</h5>
                            <h5 class="font-weight-bold" id="final-price">{{ $finalPrice ?? 0 }}</h5>
                        </div>
                        <button class="btn btn-block btn-primary my-3 py-3">Thanh toán</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @section('my-js')
    <script>
        $(document).ready(function() {
            $('.btn-minus').off('click').on('click', function() {
                let $input = $(this).closest('.quantity').find('.quantity-input');
                let currentValue = parseInt($input.val());
                if (currentValue > 1) {
                    $input.val(currentValue - 1).trigger('change');
                }
            });

            $('.btn-plus').off('click').on('click', function() {
                let $input = $(this).closest('.quantity').find('.quantity-input');
                let currentValue = parseInt($input.val());
                $input.val(currentValue + 1).trigger('change');
            });

            $('.quantity-input').on('change', function() {
                let $row = $(this).closest('tr');
                let productId = $row.find('.quantity').data('product-id');
                let newQuantity = parseInt($(this).val());

                // Lấy giá sản phẩm (giả sử 10 là giá cố định, nếu không, bạn cần lấy từ data-attribute hoặc AJAX)
                const unitPrice =
                    10; // Thay thế bằng cách lấy giá thực tế từ $data->price hoặc data attribute

                let newSubtotal = newQuantity * unitPrice;

                $row.find('td:nth-child(4)').text(newSubtotal); // td thứ 4 là cột tổng phụ

                // Tùy chọn: Gửi yêu cầu AJAX để cập nhật số lượng trong database (nếu cần)
                updateCartItem(productId, newQuantity);

                // Cập nhật tổng số tiền cuối cùng của giỏ hàng
                updateOverallTotal();
            });

            // Hàm (tùy chọn) để gửi AJAX request cập nhật giỏ hàng trên server
            function updateCartItem(productId, newQuantity) {
                // URL của route bạn đã tạo
                const updateUrl = "{{ route('client.updateCart') }}";

                $.ajax({
                    url: updateUrl,
                    method: 'POST',
                    data: {
                        product_id: productId, // Gửi ID sản phẩm
                        quantity: newQuantity, // Gửi số lượng mới
                        _token: '{{ csrf_token() }}' // Rất quan trọng cho Laravel để bảo mật CSRF
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log('Cập nhật số lượng trong DB thành công!');
                            // Bạn có thể hiển thị thông báo thành công cho người dùng
                            // Hoặc không làm gì cả vì UI đã cập nhật
                        } else {
                            console.error('Cập nhật số lượng thất bại:', response.message);
                            // Xử lý khi cập nhật thất bại (ví dụ: hiển thị lỗi cho người dùng)
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Lỗi AJAX khi cập nhật giỏ hàng:', error);
                        //             // Thông báo lỗi cho người dùng hoặc quay lại số lượng cũ
                        alert('Đã xảy ra lỗi khi cập nhật giỏ hàng. Vui lòng thử lại.');
                    }
                });
            }

            // Hàm để tính toán và cập nhật tổng số tiền cuối cùng của giỏ hàng
            function updateOverallTotal() {
                let total = 0;
                $('.update-total-price').each(function() {
                    // Lấy giá trị tổng phụ từ cột thứ 4 của mỗi hàng
                    // Đảm bảo rằng giá trị này là số
                    let subtotalText = $(this).find('td:nth-child(4)').text();
                    let subtotal = parseFloat(subtotalText); // Sử dụng parseFloat để xử lý số thập phân

                    if (!isNaN(subtotal)) { // Kiểm tra nếu là một số hợp lệ
                        total += subtotal;
                    }
                });

                $('.cart-subtotal').text(total);
            }

            // Khởi tạo tổng số tiền ban đầu khi trang tải xong
            updateOverallTotal();
        });

        function shippingFee() {
            let fee = $('#shipping-fee').val();
            console.log(fee);
        }
    </script>
@endsection --}}
