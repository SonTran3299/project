@extends('admin.layout.master')

@section('content')
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tạo danh mục sản phẩm</h3>
            </div>
            <form role="form" action="{{ route('admin.product_category.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="image">Ảnh danh mục</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>

                    <div class="form-group">
                        <label for="name">Tên danh mục sản phẩm</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Nhập tên danh mục sản phẩm" value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Nhập slug"
                            value="{{ old('slug') }}">
                    </div>
                    @error('slug')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="status">Trạng thái</label>
                        <div class="form-group">
                            <select id="status" name="status" class="form-control">
                                <option value="">---Chọn---</option>
                                <option {{ old('status') === '1' ? 'selected' : '' }} value="1">Hiện</option>
                                <option {{ old('status') === '0' ? 'selected' : '' }} value="0">Ẩn</option>
                            </select>
                        </div>
                    </div>
                    @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" name="create_category">Tạo danh mục</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('my-js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#name').on('keyup', function() {
                var slug = $(this).val();

                $.ajax({
                    method: "GET", //method of form
                    url: "{{ route('admin.product_category.make_slug') }}",
                    data: {
                        slug: slug
                    },
                    success: function(response) {
                        $('#slug').val(response.slug);
                    }
                });
            });
        });
    </script>
@endsection
