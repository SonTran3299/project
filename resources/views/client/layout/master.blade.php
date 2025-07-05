<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>My Project</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{ asset('client_asset/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('client_asset/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('client_asset/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Topbar -->
    @include('client.blocks.topbar')

    <!-- Navbar  -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                    data-toggle="collapse" href="#navbar-vertical"
                    style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                @yield('nav-home')
                @yield('nav-except-home')
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span
                                class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        @yield('navbar')
                        <div class="navbar-nav ml-auto py-0">
                            <a href="{{ route('client.pages.user.login') }}" class="nav-item nav-link">Đăng nhập</a>
                            <a href="{{ route('client.pages.user.register') }}" class="nav-item nav-link">Đăng ký</a>
                        </div>
                    </div>
                </nav>
                @yield('header-carousel')
            </div>
        </div>
    </div>

    <!-- Featured/ Page Header -->
    @yield('page-header')

    <!-- content -->
    @yield('main-content')

    <!-- Footer -->
    @include('client.blocks.footer')


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('client_asset/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('client_asset/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('client_asset/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('client_asset/mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('client_asset/js/main.js') }}"></script>
</body>

</html>
