@extends('layouts.index')
@section('header')
    <div class="d-md-flex align-items-end">
        <div class="me-auto">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Family Day</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
            <h2 class="page-title mb-0 mt-2"></h2>

            <p class="lead mb-lg-0"></p>

        </div>
        <div class="flex-grow-1 d-flex flex-wrap justify-content-end align-items-center gap-3">
            <button id="btnGroupDrop1" id-acara="{{ (sizeof($data) > 0) ? $data[0]->acara_id : '' }}" type="button"
                class="btn btn-bg-purple btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                {{ (sizeof($data) > 0) ? $data[0]->acara_nama : '' }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                @foreach ($data as $d)
                    <li lidi="{{ $d->acara_id }}"><a class="dropdown-item"
                            href="javascript:void(0)">{{ $d->acara_nama }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-9">
            <div class="row">
                <div class="card  text-dark col-4  bg-transparent border-0">
                    <div class="card-body bg-white py-3 dashboard-c">

                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0">
                                <i class="la la-users dashboard-i fs-3 p-1"></i>
                            </div>
                            <div class="flex-grow-1 ms-4 text-right">
                                <h5 class="h2 mb-0 fw-bolder tkp">0</h5>
                            </div>
                        </div>

                        <p class="dashboard-t text-center fs-9 text-opacity-75 mb-0"><strong>Total Kuota Peserta</strong>
                        </p>

                    </div>
                </div>
                <div class="card  text-dark col-4  bg-transparent border-0">
                    <div class="card-body bg-white py-3 dashboard-c">

                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0">
                                <i class="la la-user-edit dashboard-i fs-3 p-1"></i>
                            </div>
                            <div class="flex-grow-1 ms-4 text-right">
                                <h5 class="h2 mb-0 fw-bolder tpt">0</h5>
                            </div>
                        </div>

                        <p class="dashboard-t text-center fs-9 text-opacity-75 mb-0"><strong>Total Peserta
                                Terdaftar</strong>
                        </p>

                    </div>
                </div>
                <div class="card  text-dark col-4  bg-transparent border-0">
                    <div class="card-body bg-white py-3 dashboard-c">

                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0">
                                <i class="la la-user-check dashboard-i fs-3 p-1"></i>
                            </div>
                            <div class="flex-grow-1 ms-4 text-right">
                                <h5 class="h2 mb-0 fw-bolder tpc">0</h5>
                            </div>
                        </div>

                        <p class="dashboard-t text-center fs-9 text-opacity-75 mb-0"><strong>Total Peserta Check-In</strong>
                        </p>

                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="card  text-dark col-12  bg-transparent border-0" style="height:150px">
                    <div class="card-body bg-white py-3 dashboard-c">

                        <h5><i class="demo-psi-data-storage text-reset text-opacity-75 fs-3 me-2"></i>Peserta Check-In
                        </h5>

                        <div id="content-main" style="width:100%;height:250px; margin-top: -25px;"></div>



                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card  text-dark col-12  bg-transparent border-0" style="height:410px">
                <div class="card-body bg-white py-3 dashboard-c">

                    <h5><i class="demo-psi-data-storage text-reset text-opacity-75 fs-3 me-2"></i> Presentase Peserta
                    </h5>

                    <div id="side-main" style="width:100%;height:275px;"></div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
@endsection

@section('script')
    <script src="{{ asset('plugins/echarts/echarts.min.js') }}"></script>
    <script>
        $(function() {
            var chartDom = document.getElementById('side-main');
            var myChart = echarts.init(chartDom);
            var option;

            let gaugeData = [{
                    value: 0,
                    name: 'Terdaftar',
                    title: {
                        offsetCenter: ['-40%', '150%']
                    },
                    detail: {
                        valueAnimation: true,
                        offsetCenter: ['-80%', '150%']
                    }
                },
                {
                    value: 0,
                    name: 'Check-In',
                    title: {
                        offsetCenter: ['80%', '150%']
                    },
                    detail: {
                        valueAnimation: true,
                        offsetCenter: ['40%', '150%']
                    }
                }
            ];
            option = {
                series: [{
                    type: 'gauge',
                    startAngle: 90,
                    endAngle: -270,
                    pointer: {
                        show: false
                    },
                    progress: {
                        show: true,
                        overlap: false,
                        roundCap: true,
                        clip: false,
                        itemStyle: {
                            borderWidth: 5,
                            borderColor: '#e6ebf8'
                        }
                    },
                    axisLine: {
                        lineStyle: {
                            width: 30
                        }
                    },
                    splitLine: {
                        show: false,
                        distance: 0,
                        length: 10
                    },
                    axisTick: {
                        show: false
                    },
                    axisLabel: {
                        show: false,
                        distance: 50
                    },
                    data: gaugeData,
                    title: {
                        fontSize: 10
                    },
                    detail: {
                        width: 3,
                        height: 5,
                        fontSize: 9,
                        color: '#fff',
                        backgroundColor: 'auto',
                        borderRadius: 3,
                        formatter: '{value}%'
                    }
                }]
            };

            option && myChart.setOption(option);


            var chartDom2 = document.getElementById('content-main');
            var myChart2 = echarts.init(chartDom2);
            var option2;

            option2 = {
                xAxis: {
                    type: 'category',
                    data: ['05:00', '06:00', '07:00', '08:00', '09:00', '10:00']
                },
                yAxis: {
                    type: 'value'
                },
                series: [{
                    data: [0, 0, 0, 0, 0, 0],
                    type: 'bar',
                    showBackground: true,
                    backgroundStyle: {
                        color: 'rgba(180, 180, 180, 0.2)'
                    },
                    barWidth: '5%',
                    itemStyle: {
                        barBorderRadius: 5,
                        borderWidth: 1,
                        borderType: 'solid',
                    }
                }]
            };

            option2 && myChart2.setOption(option2);

            function getAllPranks(lidi, callback) {
                $.getJSON("{{ url('dashboard/get') }}", {
                    id: lidi
                }, function(data) {
                    if (data) {
                        $("h5.tkp").html(data.stat.total_kuota),
                            $("h5.tpt").html(data.stat.total_peserta),
                            $("h5.tpc").html(data.stat.peserta_checkin),
                            callback(data);
                    }
                });
            }

            function getset(lidi) {
                getAllPranks(lidi, function(datanya) {
                    gaugeData[0].value = datanya.stat.total_peserta / datanya.stat.total_kuota * 100;
                    gaugeData[1].value = datanya.stat.peserta_checkin / datanya.stat.total_kuota * 100;
                    myChart.setOption({
                        series: [{
                            data: gaugeData,
                            pointer: {
                                show: false
                            }
                        }]
                    });

                    ldata = [];
                    mdata = [];
                    $.each(datanya.chart, function(dt, val) {
                        console.log(val);
                        ldata.push(val.jml);
                        mdata.push(val.waktu+":00");
                    });

                    myChart2.setOption({
                        series: [{
                            data: ldata
                        }],
                        xAxis: [{
                            data: mdata
                        }]
                    });
                });
            }

            getset($("button#btnGroupDrop1").attr("id-acara"));

            $(".dropdown-menu li").on("click", function(ev) {
                ev.preventDefault();
                if (ev.handler != true) {
                    getset($(this).attr("lidi"));
                    $("button#btnGroupDrop1").attr("id-acara", $(this).attr("lidi")),
                        $("button#btnGroupDrop1").text($(this).text());
                    ev.handler = true
                }
            });

        });
    </script>
@endsection
