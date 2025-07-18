<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0">Categories</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            @yield('nav-homepage')
            @yield('nav-other-pages')
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

                    {{-- @yield('navbar') --}}
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{ route('client.home') }}"
                            class="nav-item nav-link {{ Request::routeIs('client.home') ? 'active' : '' }}">Home</a>
                        <a href="{{ route('client.shop') }}"
                            class="nav-item nav-link {{ Request::routeIs('client.shop') ? 'active' : '' }}">Shop</a>
                        <div class="nav-item dropdown">
                            <a href="#"
                                class="nav-link dropdown-toggle {{ Request::routeIs('client.cart') ? 'active' : '' }}"
                                data-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="{{ route('client.cart') }}" class="dropdown-item">Giỏ hàng</a>
                                <a href="{{ route('client.checkout') }}" class="dropdown-item">Checkout</a>
                            </div>
                        </div>
                        <a href="{{ route('client.contact') }}"
                            class="nav-item nav-link {{ Request::routeIs('client.contact') ? 'active' : '' }}">Contact</a>
                    </div>
                    {{-- -------------------- --}}

                    <div class="navbar-nav ml-auto py-0">
                        @auth
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle"
                                    data-toggle="dropdown">{{ Auth::user()->name }}</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="{{ route('dashboard') }}" class="dropdown-item">
                                        Dashboard
                                    </a>
                                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                        Profile
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="nav-item nav-link">Đăng nhập</a>
                            <a href="{{ route('register') }}" class="nav-item nav-link">Đăng ký</a>
                        @endauth
                    </div>
                </div>
            </nav>


            @yield('header-carousel')
        </div>
    </div>
</div>
