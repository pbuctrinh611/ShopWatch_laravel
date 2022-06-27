@extends('admin.master')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h1>Chào mừng bạn đến trang quản trị</h1>
                        <div class="d-flex mt-4">
                            <div class="col-md-3">
                                <div class="bg-red rounded justify-content-center p-3">
                                    <h3 class="text-center mt-2">Nhân viên</h3>
                                    @if($total_employee > 0)
                                    <h4 class="text-center mb-2">{{$total_employee}}</h4>
                                    @else
                                    <h4 class="text-center mb-2">Không có</h4>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="bg-warning rounded justify-content-center p-3">
                                    <h3 class="text-center mt-2">Khách hàng</h3>
                                    @if($total_customer > 0)
                                    <h4 class="text-center mb-2">{{$total_customer}}</h4>
                                    @else
                                    <h4 class="text-center mb-2">Không có</h4>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="bg-success rounded justify-content-center p-3">
                                    <h3 class="text-center mt-2">Số lượng đơn đặt</h3>
                                    @if($total_order_pay > 0)
                                    <h4 class="text-center mb-2">{{$total_order_pay}}</h4>
                                    @else
                                    <h4 class="text-center mb-2">Không có</h4>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="bg-primary rounded justify-content-center p-3">
                                    <h3 class="text-center mt-2">Doanh thu</h3>
                                    @if($total_money > 0)
                                    <h4 class="text-center mb-2">{{number_format($total_money)}} VND</h4>
                                    @else
                                    <h4 class="text-center mb-2">Không có</h4>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-start flex-column">
                            <div id="piechart" style="width: 1000px; height: 500px;"></div>
                            <div class="row">
                                <canvas id="myChart" style="width: 1000px !important; height: 500px !important; margin: auto"></canvas>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">

                    </div>

                </div>
            </div>
        </div>
</section>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Tên khách hàng', 'Tổng số lượt đặt'],
            <?php echo $chartData; ?>
        ]);

        var options = {
            is3D: true,
            titleTextStyle: {
                color: "#000",
                fontName: "Roboto",
                fontSize: 17,
                bold: true,
            }
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    var data = <?= json_encode($data_month); ?>;
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            datasets: [{
                label: 'Thống kê lượt người dùng đăng ký',
                data: data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection