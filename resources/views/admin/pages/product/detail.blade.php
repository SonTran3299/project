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
                            placeholder="Nhập tên sản phẩm" value="{{ $data->name }}">
                    </div>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="description">Mô tả sản phẩm</label>
                        <div id="description_html"></div>
                        <input type="hidden" name="description" id="description">
                        <input type="hidden" name="old_description" id="old_description" value="{{ $data->description }}">
                    </div>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="price">Giá</label>
                        <input type="number" class="form-control" id="price" name="price"
                            placeholder="Nhập giá của sản phẩm" value="{{ $data->price }}">
                    </div>
                    @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="discount_percentage">Giảm giá sản phẩm (nếu cần)</label>
                        <input type="number" step="any" class="form-control" id="discount_percentage"
                            name="discount_percentage" placeholder="Mặc định 0%" value="{{ $data->discount_percentage }}">
                    </div>
                    @error('discount_percentage')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="stock">Tồn kho</label>
                        <input type="number" class="form-control" id="stock" name="stock"
                            placeholder="Nhập tồn kho của sản phẩm" value="{{ $data->stock }}">
                    </div>
                    @error('stock')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="category">Danh mục sản phẩm</label>
                        <div class="form-group">
                            <select id="category" name="product_category_id" class="form-control">
                                <option value="">---Chọn---</option>
                                @foreach ($categoryList as $category)
                                    <option {{ $data->product_category_id === $category->id ? 'selected' : '' }} value="{{ $category->id }}">
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @error('product_category_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="status">Tình trạng</label>
                        <div class="form-group">
                            <select id="status" name="status" class="form-control">
                                <option value="">---Chọn---</option>
                                <option {{ $data->status == '1' ? 'selected' : '' }} value="1">Hiện
                                </option>
                                <option {{ $data->status == '0' ? 'selected' : '' }} value="0">Ẩn
                                </option>
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
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script>
        const quill = new Quill('#description_html', {
            theme: 'snow'
        });

        quill.on('text-change', function(delta, oldDelta, source) {
            document.getElementById("description").value = quill.root.innerHTML;
        });

        const oldDescription = document.getElementById("old_description").value;
        if (oldDescription) {
            quill.clipboard.dangerouslyPasteHTML(oldDescription);
        }
    </script>
@endsection
