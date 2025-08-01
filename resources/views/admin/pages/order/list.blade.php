@extends('admin.layout.master')

@section('content')
    <div class="col-md-12">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Danh sách đơn hàng</h3>
            </div>

            {{-- Search --}}
            <div class="container mt-2 d-flex justify-content-between">
                <form action="{{ route('admin.order.list') }}" method="GET" class="form-inline my-2 my-lg-0 ml-auto">
                    <select class="form-control mr-sm-2" name="filter" id="filter">
                        <option {{ in_array(request()->get('filter'), ['all', '']) ? 'selected' : '' }} value="">
                            ---Chọn---</option>
                        <option {{ request()->get('filter') === '0' ? 'selected' : '' }} value="0">
                            Chờ xử lý
                        </option>
                        <option {{ request()->get('filter') === '1' ? 'selected' : '' }} value="1">Đã xác nhận
                        </option>
                        <option {{ request()->get('filter') === '2' ? 'selected' : '' }} value="2">
                            Đang giao hàng
                        </option>
                        <option {{ request()->get('filter') === '3' ? 'selected' : '' }} value="3">Đã giao
                        </option>
                        <option {{ request()->get('filter') === '4' ? 'selected' : '' }} value="4">Đã hủy
                        </option>
                        <option {{ request()->get('filter') === '5' ? 'selected' : '' }} value="5">Giao thất bại
                        </option>
                    </select>

                    <button type="submit"class="btn btn-outline-primary my-2 my-sm-0">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>


            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Mã đơn hàng</th>
                            <th>Người mua</th>
                            <th>Địa chỉ</th>
                            <th>Ghi chú</th>
                            <th>Tổng đơn</th>
                            <th>Tình trạng đơn</th>
                            <th>Thời gian xử lý</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>#<span class="text-red">{{ $data->id }}</span> </td>
                                <td>{{ $data->user->name }}</td>
                                <td>{{ $data->address }}</td>
                                <td>{{ $data->note ?? '-' }}</td>
                                <td>{{ $data->total }}</td>
                                <td>{{ $data->status_to_text }}</td>
                                <td>{{ $data->updated_at ? \Carbon\Carbon::parse($data->updated_at)->format('d/m/Y H:i:s') : '-' }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.order.detail', ['order' => $data->id]) }}"
                                        class="btn btn-outline-info"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                {{ $datas->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection
@section('my-js')
    @include('admin.blocks.notification')
@endsection