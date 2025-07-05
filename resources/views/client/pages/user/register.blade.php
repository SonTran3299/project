@extends('client.layout.user')

@section('main_content')
    <div class="card-header">
        <h3>Đăng ký</h3>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="form-group row">
                <label for="username" class="col-md-4 col-form-label text-md-right">
                    Tên tài khoản:
                </label>
                <div class="col-md-6">
                    <input type="text" id="username" class="form-control" name="username">
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">
                    Email:
                </label>
                <div class="col-md-6">
                    <input type="text" id="email" class="form-control" name="email">
                </div>
            </div>

            <div class="form-group row">
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
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">
                    Mật khẩu:
                </label>
                <div class="col-md-6">
                    <input type="password" id="password" class="form-control" name="password">
                </div>
            </div>

            <div class="form-group row">
                <label for="repeat_password" class="col-md-4 col-form-label text-md-right">
                    Nhập lại mật khẩu:
                </label>
                <div class="col-md-6">
                    <input type="password" id="repeat_password" class="form-control" name="repeat_password">
                </div>
            </div>

            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary" name="user_register">
                    Đăng ký
                </button>
            </div>
        </form>
    </div>
@endsection
