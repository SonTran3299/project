$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $('.add-product-to-cart').on('click', function (e) {
        e.preventDefault();

        var url = $(this).data('url');
        var productId = $(this).data('product');
        $.ajax({
            method: "POST",
            url: url,
            data: {
                //_token: '{{ csrf_token() }}',
                product_id: productId
            },
            success: function (response) {
                updateCartCount();
                $('.toast').toast('show');
            },
            statusCode: {
                401: function () {
                    window.location.href = "{{ route('login') }}";
                }
            }
        });
    });
});