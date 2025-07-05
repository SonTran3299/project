@extends('client.layout.user')

@section('main_content')
    <div class="card-header">
        <h3>Đăng nhập</h3>
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
                <label for="password" class="col-md-4 col-form-label text-md-right">
                    Mật khẩu:
                </label>
                <div class="col-md-6">
                    <input type="password" id="password" class="form-control" name="password">
                </div>
            </div>

            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary" name="user_register">
                    Đăng nhập
                </button>
            </div>
        </form>
    </div>
@endsection