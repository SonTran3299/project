@extends('admin.layout.master')

@section('content')
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Chi tiết sản phẩm</h3>
            </div>
            <form role="form" action="{{ route('admin.product.update', ['product' => $data->id]) }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter category name" value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    
                    <div class="form-group">
                        <label for="description">Mô tả sản phẩm</label>
                        <div id="description_html"></div>
                        <input type="hidden" name="description" id="description">
                        <input type="hidden" name="old_description" id="old_description" value="{{ old('description') }}">
                    </div>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="price">Giá</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Nhập giá của sản phẩm"
                            value="{{ old('price') }}">
                    </div>
                    @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="stock">Tồn kho</label>
                        <input type="number" class="form-control" id="stock" name="stock" placeholder="Nhập tồn kho của sản phẩm"
                            value="{{ old('stock') }}">
                    </div>
                    @error('stock')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="category">Danh mục sản phẩm</label>
                        <div class="form-group">
                            <select id="category" name="category" class="form-control">
                                <option value="">---Chọn---</option>
                                @foreach ($categoryList as $data)
                                    <option {{ old('category') === $data->id ? 'selected' : '' }}
                                        value="{{ $data->id }}">
                                        {{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @error('category')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="status">Trạng thái</label>
                        <div class="form-group">
                            <select id="status" name="status" class="form-control">
                                <option value="">---Chọn---</option>
                                <option {{ old('status') === '1' ? 'selected' : '' }} value="1">Show</option>
                                <option {{ old('status') === '0' ? 'selected' : '' }} value="0">Hide</option>
                            </select>
                        </div>
                    </div>
                    @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" name="update_product">Cập nhật</button>
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
