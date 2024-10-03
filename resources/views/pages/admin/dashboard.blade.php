@extends('layout.admin')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">

                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $electionC }}</h3>
                        <p>Total Elections</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-file"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $teamC }}</h3>
                        <p>Total Teams</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $adminC }}</h3>
                        <p>Administrator</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $studentC }}</h3>
                        <p>Students</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-address-book"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Monthly Recap Report</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <p class="text-center">
                            <strong id="monthlyRecapTitle"></strong>
                        </p>
                        <div class="chart">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>

                            <canvas id="salesChart" height="180" style="height: 180px; display: block; width: 513px;"
                                width="513" class="chartjs-render-monitor"></canvas>
                        </div>

                    </div>

                    <div class="col-md-4">
                        <p class="text-center">
                            <strong>Goal Completion</strong>
                        </p>
                        <div class="progress-group">
                            Add Products to Cart
                            <span class="float-right"><b>160</b>/200</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-primary" style="width: 80%"></div>
                            </div>
                        </div>

                        <div class="progress-group">
                            Complete Purchase
                            <span class="float-right"><b>310</b>/400</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-danger" style="width: 75%"></div>
                            </div>
                        </div>

                        <div class="progress-group">
                            <span class="progress-text">Visit Premium Page</span>
                            <span class="float-right"><b>480</b>/800</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-success" style="width: 60%"></div>
                            </div>
                        </div>

                        <div class="progress-group">
                            Send Inquiries
                            <span class="float-right"><b>250</b>/500</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-warning" style="width: 50%"></div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>



        <div class="row">
            <div class="col-12 col-sm-9">
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Recently Added Elections</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>Election</th>
                                        <th>Start At</th>
                                        <th>End At</th>
                                        <th>Teams</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($elections as $election)
                                   <tr>
                                    <th>{{$election->electionName}}</th>
                                    <td>{{$election->startAt}}</td>
                                    <td>{{$election->endAt}}</td>
                                    <td>{{$election->teamC}}</td>
                                </tr>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="card-footer clearfix">
                        <a href="{{ url('/administrator/elections') }}" class="btn btn-sm btn-secondary float-right">View All</a>
                    </div>

                </div>
            </div>
            <div class="col-12 col-sm-3">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Recently Added Students</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <ul class="products-list product-list-in-card pl-2 pr-2">

                           @foreach ($students as $student)
                            <li class="item">
                                <div class="product-img">
                                    <img src="{{url("/photos/student.png")}}" class="img-size-50">
                                </div>
                                <div class="product-info">
                                    <a href="javascript:void(0)" class="product-title">
                                        {{$student->name}}
                                        <span class="badge badge-success float-right">{{$student->lrn}}</span></a>
                                    <span class="product-description">
                                        {{$student->phone}}
                                    </span>
                                </div>
                            </li>
                           @endforeach

                        </ul>
                    </div>

                    <div class="card-footer text-center">
                        <a href="{{ url('/administrator/students') }}" class="uppercase">View All</a>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection


@section('script')
    <script type="module">
        $(function() {
            getData();

            function getData() {
                $.ajax({
                    url: '/vote/administrator/monthlyrecap',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        displayMonthlyRecap(response)
                    },
                    error: function() {
                        getData();
                    }
                });
            }

            function displayMonthlyRecap(monthsData) {
                $('#monthlyRecapTitle').text(
                    `${monthsData[0].monthLabel} - ${monthsData[monthsData.length - 1].monthLabel}`);
                var salesChartCanvas = $('#salesChart').get(0).getContext('2d');

                var salesChartData = {
                    labels: monthsData.map(list => list.monthName),
                    datasets: [{
                        label: 'All checkups',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: monthsData.map(list => list.elections + 50),
                    }]
                };

                var salesChartOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                display: false
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                display: false
                            }
                        }]
                    }
                };

                new Chart(salesChartCanvas, {
                    type: 'line',
                    data: salesChartData,
                    options: salesChartOptions
                });
            }
        })
    </script>
@endsection
