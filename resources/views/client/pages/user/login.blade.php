@extends('client.layout.user')

@section('main_content')
    <div class="card-header">
        <h3>Đăng nhập</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">
                    Email:
                </label>
                <div class="col-md-6">
                    <input type="text" id="email" class="form-control" name="email">
                    @error('email')
                        <div class="mt-2 alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">
                    Mật khẩu:
                </label>
                <div class="col-md-6">
                    <input type="password" id="password" class="form-control" name="password">
                    @error('password')
                        <div class="mt-2 alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <span class="col-md-4"></span>
                <div class="col-md-6">
                    <label for="remember_me" class="col-form-label text-md-right">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Duy trì đăng nhập') }}</span>
                    </label>
                </div>

            </div>

            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary" name="user_register">
                    Đăng nhập
                </button>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Quên mật khẩu?') }}
                    </a>
                @endif

                
                    <a class="text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('client.google.redirect') }}">
                        {{ __('Hoặc đăng nhập bằng tài khoản Google?') }}
                    </a>
                
            </div>
        </form>
    </div>
@endsection
