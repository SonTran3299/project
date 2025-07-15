@extends('client.layout.user')

@section('main_content')
    <div class="card-header">
        <h3>Đăng ký</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">
                    Tên người dùng:
                </label>
                <div class="col-md-6">
                    <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="mt-2 alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">
                    Email:
                </label>
                <div class="col-md-6">
                    <input type="text" id="email" class="form-control" name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="mt-2 alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- <div class="form-group row">
                <label for="phone_number" class="col-md-4 col-form-label text-md-right">
                    Số điện thoại:
                </label>
                <div class="col-md-6">
                    <input type="text" id="phone_number" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">
                    Địa chỉ:
                </label>
                <div class="col-md-6">
                    <input type="text" id="address" class="form-control">
                </div>
            </div> --}}

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
                <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">
                    Nhập lại mật khẩu:
                </label>
                <div class="col-md-6">
                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation">

                </div>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary" name="register">
                    Đăng ký
                </button>
            </div>
        </form>
    </div>
@endsection
