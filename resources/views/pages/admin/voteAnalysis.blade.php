@extends('layout.admin')

@section('title')
    Analysis
@endsection

@section('moreOption')
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="btn btn-sm btn btn-info" data-toggle="dropdown" href="#" aria-expanded="false">
                More actions
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                <a class="dropdown-item bg-info">
                    View Options
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" data-toggle="modal" data-target="#add-team">
                    <i class="fa fa-users mr-2"></i> Participant View
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" data-toggle="modal" data-target="#add-team">
                    <i class="fa fa-line-chart mr-2"></i> Graph View
                </a>
                <a href="{{ route('manage-election', ['id' => $election->id]) }}" class="dropdown-item">
                    <i class="fa fa-angle-double-left mr-2"></i> Back
                </a>
            </div>
        </li>
    </ul>
@endsection

@section('content')
    <input type="hidden" id="electionId" value="{{ $election->id }}">
    <div class="container-fluid">

        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Bar Chart</h3>
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
                <div class="chart">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="barChart"
                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 339px;"
                        width="339" height="250" class="chartjs-render-monitor"></canvas>
                </div>
            </div>

        </div>


        
        <div class="row analysisCont">

        </div>


    </div>
@endsection

@section('script')
    <script type="module">
        $(function() {

            let teamInd = -1;

            getData();

            // setInterval(() => {
            //     teamInd = -1;
            //     getData();
            // }, 3000);

            function getData() {
                const electionId = $("#electionId").val();
                $.ajax({
                    url: `/vote/administrator/elections/analysis/getData/${electionId}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        displayParticipants(response);
                        chartView(response)
                    },
                    error: function(err) {
                        console.log(err);
                        setTimeout(getData, 3000);
                    }
                });
            }

            function displayParticipants(res) {
                $(".analysisCont").empty();

                const positions = [{
                        key: "President",
                        label: "President"
                    },
                    {
                        key: "Vice President",
                        label: "Vice President"
                    },
                    {
                        key: "Secretary",
                        label: "Secretary"
                    },
                    {
                        key: "Treasurer",
                        label: "Treasurer"
                    },
                    {
                        key: "Auditor",
                        label: "Auditor"
                    },
                    {
                        key: "PIO",
                        label: "PIO"
                    },
                    {
                        key: "Protocol Officer",
                        label: "Protocol Officer"
                    },
                    {
                        key: "Grade 7 Representative",
                        label: "Grade 7 Representative"
                    },
                    {
                        key: "Grade 8 Representative",
                        label: "Grade 8 Representative"
                    },
                    {
                        key: "Grade 9 Representative",
                        label: "Grade 9 Representative"
                    },
                    {
                        key: "Grade 10 Representative",
                        label: "Grade 10 Representative"
                    },
                    {
                        key: "Grade 11 Representative",
                        label: "Grade 11 Representative"
                    },
                    {
                        key: "Grade 12 Representative",
                        label: "Grade 12 Representative"
                    },
                ];

                positions.forEach(({
                    key,
                    label
                }) => {
                    const participants = res[key] || [];
                    $(".analysisCont").append(generateDisplay(participants, label));
                });
            }

            function generateDisplay(participants, pos) {

                function displayParticipants(participants) {
                    let htmlElem = '';

                    if (participants.length === 0) {
                        return `<div class="col-12">No participants for ${pos}</div>`;
                    }

                    for (let x = 0; x < participants.length; x++) {
                        const participant = participants[x];
                        if (participant) {
                            htmlElem += `
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-header-title">
                                                ${participant.team.teamName || "Unknown"}
                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="participants-viewer">
                                            <img src="${participant.photo ? `{{ url('/participants/image/${participant.photo}') }}` : '/path/to/default-image.jpg'}" alt="Photo" class="img-fluid">
                                        </div>

                                         <div class="card-footer">
                                           ${participant.participantsName}
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                        }
                    }

                    return htmlElem;
                }

                return `
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-header-title">
                                ${pos}
                            </div>
                        </div>
                        <div class="card-body">
                          <div class="row">
                             ${displayParticipants(participants)}
                          </div>
                        </div>
                    </div>
                </div>
                `;
            }


            function chartView(response){
                const positions = Object.keys(response)
                const data = positions.map(item => {
                    return response[item]
                });
                const teamCount = data[0].length;
                let genDataSet = [];

                for(let x=0; x<teamCount; x++){
                    genDataSet = [...genDataSet, generateDataSet(data)];
                }

                var areaChartData = {
                labels  : positions,
                datasets: genDataSet
                }



            var barChartCanvas = $('#barChart').get(0).getContext('2d')
                var barChartData = $.extend(true, {}, areaChartData)
                var temp0 = areaChartData.datasets[0]
                var temp1 = areaChartData.datasets[1]
                barChartData.datasets[0] = temp1
                barChartData.datasets[1] = temp0

                var barChartOptions = {
                responsive              : true,
                maintainAspectRatio     : false,
                datasetFill             : false
                }

                new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
                })
            }

            
            function generateDataSet(data){
                teamInd ++;
                const colorPicker = [
                    '#FF5733', '#33FF57', '#3357FF', '#FF33A1', '#33FFA1',
                    '#A133FF', '#FF3333', '#57FF33', '#5733FF', '#33FF33',
                    '#FF3333', '#33A1FF', '#FF5733', '#3357A1', '#A1FF33',
                    '#33A1A1', '#FF33FF', '#5733A1', '#FFA133', '#33FF57'
                ];

                    return {
                    label               : 'Team A',
                    backgroundColor     : colorPicker[teamInd],
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius          : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : [28, 48, 40, 19, 86, 27, 90]
                    }
            }
        });


        
    </script>
@endsection




<style>
    .photo-container {
        width: 60%;
        height: 200px;
        margin: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 2px solid lightgray;
        overflow: hidden;
        position: relative;
        /* Required for absolute positioning inside */
    }

    .preview-photo {
        width: 100%;
        height: auto;
    }

    .participants-viewer {
        width: 100%;
        height: 140px;
    }

    .participants-viewer img {
        width: 100%;
        height: 100%;
    }
</style>
