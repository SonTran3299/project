@extends('admin.layout.master')

@section('content')
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Chi tiết danh mục sản phẩm</h3>
            </div>
            <form role="form" action="{{ route('admin.product_category.update', ['productCategory' => $data->id]) }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter category name" value="{{ $data->name }}">
                    </div>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter slug"
                            value="{{ $data->slug }}">
                    </div>
                    @error('slug')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="status">Status</label>
                        <div class="form-group">
                            <select id="status" name="status" class="form-control">
                                <option value="">---Select---</option>
                                <option {{ $data->status == '1' ? 'selected' : '' }} value="1">Show</option>
                                <option {{ $data->status == '0' ? 'selected' : '' }} value="0">Hide</option>
                            </select>
                        </div>
                    </div>
                    @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" name="update_category">Update</button>
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
