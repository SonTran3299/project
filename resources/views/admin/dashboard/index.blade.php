@extends('admin.layout.master')

@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $countOrder }}</h3>
                    <p>Đơn hàng trong tháng {{ \Carbon\Carbon::now()->format('m') }}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('admin.order.list') }}" class="small-box-footer">Xem chi tiết <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $successRate }}<sup style="font-size: 20px">%</sup></h3>

                    <p>Tỷ lệ hoàn thành đơn</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info (chưa) <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $countUser }}</h3>

                    <p>Người dùng đã đăng ký</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('admin.user.list') }}" class="small-box-footer">Xem chi tiết <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        {{-- <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>65</h3>

                    <p>Unique Visitors</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div> --}}
        <!-- ./col -->

    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Sản phẩm
            </h3>
        </div>
        <div class="card-body d-flex justify-content-center align-items-center">
            <div id="product-sold" class="chart tab-pane" style="width: 800px; height: 400px;">
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-chart-line mr-1"></i>
                Doanh thu
            </h3>
        </div>
        <div class="card-body">
            <div>GROSS: 1000000</div>
            <div>NET: 700000</div>
            <div>Chi phí phát sinh: 300000</div>
        </div>
    </div>
@endsection
@section('my-js')
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable(@json($productSold));

            var options = {
                title: 'Sản phẩm đã bán',
                backgroundColor: 'transparent',
                titleTextStyle: {
                    color: '#3925cf',
                    fontSize: 18,
                    bold: true
                },
            };

            var chart = new google.visualization.PieChart(document.getElementById('product-sold'));

            chart.draw(data, options);
        }
    </script>
@endsection
