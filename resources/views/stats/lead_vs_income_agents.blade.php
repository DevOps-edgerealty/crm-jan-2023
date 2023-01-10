
@extends('layout.master')

@section('content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">



            {{-- Menu-bar --}}
            @include('stats.menu_bar')
            {{-- /Menu-bar --}}




            {{-- Search Bar --}}
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- <div class="row">
                                <div class="watermark">{{Auth::user()->name}}</div>
                            </div> --}}
                                <form method="POST" action="{{url('statistics/leads-vs-income/search')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    @php
                                        $month = 01;
                                        $monthNum  = $month;
                                        $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
                                    @endphp

                                    <div class="row mt-2">

                                        @if(session()->has('message'))
                                            <div class="col-12">
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <i class="mdi mdi-check-all me-2"></i>
                                                    {{ session()->get('message') }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            </div>
                                        @elseif (session()->has('error'))
                                            <div class="col-12">
                                                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                                                    <i class="mdi mdi-check-all me-2"></i>
                                                    {{ session()->get('error') }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            </div>
                                        @endif

                                        @if( isset($agent_name))
                                            <label for="horizontal-firstname-input" class="col-sm-2 col-form-label font-size-15 fw-bold">Agent : {{ $agent_name->name }}</label>
                                        @else
                                            <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Categorize by Agent</label>
                                        @endif
                                        <div class="col-sm-6">
                                            <select id="formrow-inputState" name="agent" class="form-select" required>
                                                <option value="" selected>Select Agent</option>
                                                @foreach ($users as $data)
                                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="submit" class="btn btn-dark btn-block w-md">Submit</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                            </div>
                    </div><!--end card-->
                </div>
            </div>
            {{-- /Search Bar --}}





            <div class="row">
                <div class="col-lg-5">

                    <div class="card">

                        {{-- Apex Charts --}}
                        <div class="card-body" style="position: relative;">
                            <h4 class="card-title mb-4">Total Commission</h4>
                            <div id="chart_agent_stats_search" class="apex-charts" dir="ltr" style="max-width: 100%;  margin: 35px auto; opacity: 0.9;">
                            </div>
                            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 713px; height: 443px;"></div></div><div class="contract-trigger"></div></div>
                        </div>
                        {{-- Apex Charts --}}
                    </div>
                </div>



                <div class="col-lg-2">
                    <div class="card" style="min-height: 480px;">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Details</h4>
                            <div class="row mt-5">
                                <div class="col-sm-12">
                                    <p>Total Leads Recieved</p>
                                    <h5>{{ number_format($total_leads_final) }} </h5>
                                </div>
                            </div>



                            <div class="row mt-5">
                                <div class="col-sm-12">
                                    <p>Total Commission</p>
                                    <h5>{{ number_format($var8) }} </h5>
                                </div>
                            </div>



                            <div class="row mt-5">
                                <div class="col-sm-12">
                                    <p>Total Rent/Sale Made</p>
                                    <h5>{{ number_format($var11) }} </h5>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

{{-- {{ var_dump($var6)}} --}}
                <div class="col-lg-5">
                    <div class="card">

                        {{-- Apex Charts --}}
                        <div class="card-body" style="position: relative;">
                            <h4 class="card-title mb-4">Leads Recieved</h4>
                            <div id="chart_agent_stats" class="apex-charts" dir="ltr" style="max-width: 100%;  margin: 35px auto; opacity: 0.9;">
                            </div>
                            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 713px; height: 443px;"></div></div><div class="contract-trigger"></div></div>
                        </div>
                        {{-- Apex Charts --}}
                    </div>

                </div>



            </div>

        </div>
    </div>
</div>

<script>

    var cData = {{ json_encode($var12) }};
    var wData = {{ json_encode($total_leads_overall) }};
    var max = {{ json_encode($max) }};
    var max_l = {{ json_encode($max_l) }};
    // console.log(cData.reverse);


    var options = {
        series: [{
            name: "Total Commission",
            data: cData
        }
        ],
        colors: [ '#bc5090', ],
        chart: {
            height: 350,
            type: 'area',
            zoom: {
                enabled: true
            },
        },
        theme: {
        monochrome: {
            enabled: false,
            color: '#255aee',
            shadeTo: 'dark',
            shadeIntensity: 0.65
            }
        },
        dataLabels: {
        enabled: true
        },
        stroke: {
            width: [4, 4, 4],
            curve: 'smooth',
            dashArray: [0, 0, 0]
        },
        title: {
        text: 'Page Statistics',
        align: 'left'
        },
        legend: {
        tooltipHoverFormatter: function(val, opts) {
            return val + ' - ' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + ''
        }
        },
        markers: {
            size: 0,
            hover: {
                sizeOffset: 6
            }
        },
        xaxis: {
            categories: [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',
            ],
        },
        yaxis: {
            title: {
                text: 'Leads'
            },
            min: 0,
            max: max
        },
        tooltip: {
            y: [
                {
                    title: {
                        formatter: function (val) {
                        return val + " leads"
                        }
                    },
                },
                {
                    title: {
                        formatter: function (val) {
                        return val + " leads"
                        }
                    }
                },
                {
                    title: {
                        formatter: function (val) {
                        return val + " leads";
                        }
                    }
                },
            ]
        },
        grid: {
            borderColor: '#f1f1f1',
        }
    };



    var options2 = {
        series: [
        {
            name: 'Leads Recieved',
            data: wData,
        }
        ],
        chart: {
            height: 350,
            type: 'area',
            zoom: {
                enabled: true
            },
        },
        colors: ['#003f5c',],
        theme: {
        monochrome: {
            enabled: false,
            color: '#255aee',
            shadeTo: 'dark',
            shadeIntensity: 0.65
            }
        },
        dataLabels: {
        enabled: true
        },
        stroke: {
            width: [4, 4, 4],
            curve: 'smooth',
            dashArray: [0, 0, 0]
        },
        title: {
        text: 'Page Statistics',
        align: 'left'
        },
        legend: {
        tooltipHoverFormatter: function(val, opts) {
            return val + ' - ' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + ''
        }
        },
        markers: {
            size: 0,
            hover: {
                sizeOffset: 6
            }
        },
        xaxis: {
            categories: [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',
            ],
        },
        yaxis: {
            title: {
                text: 'Leads'
            },
            min: 0,
            max: max_l
        },
        tooltip: {
            y: [
                {
                    title: {
                        formatter: function (val) {
                        return val + " leads"
                        }
                    },
                },
                {
                    title: {
                        formatter: function (val) {
                        return val + " leads"
                        }
                    }
                },
                {
                    title: {
                        formatter: function (val) {
                        return val + " leads";
                        }
                    }
                },
            ]
        },
        grid: {
            borderColor: '#f1f1f1',
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart_agent_stats"), options);
    chart.render();

    var chart = new ApexCharts(document.querySelector("#chart_agent_stats_search"), options2);
    chart.render();

    // APex charts data
</script>


@endsection
