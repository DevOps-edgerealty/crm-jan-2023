
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

                                        <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Categorize by Agent</label>
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
                <div class="col-lg-3">
                    {{-- <div class="card" style="min-height: 480px;">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Transaction History</h4>
                            <div class="tab-content mt-4">
                                <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                                    <div class="table-responsive" data-simplebar="init" style="max-height: 380px;"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: -16.8889px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: auto; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">
                                        <table class="table align-middle table-nowrap">
                                            <tbody>
                                                @foreach($leaderboard_var1 as $data)
                                                    <tr>

                                                        <td>
                                                            <div>
                                                                <h5 class="font-size-14 mb-1">{{@$data->leader_details->name}}</h5>
                                                                <p class="text-muted mb-0 font-size-12">{{$data->created_at->format('jS \\of F Y ')}}</p>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 text-muted mb-0">{{number_format($data->net_commission)}} AED </h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 473px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 230px; transform: translate3d(0px, 99px, 0px); display: block;"></div></div></div>
                                </div>

                            </div>
                        </div>
                    </div> --}}

                    <div class="card" style="min-height: 480px;">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <div class="me-2">
                                    <h5 class="card-title mb-4">Transaction History</h5>
                                </div>
                                {{-- <div class="dropdown ms-auto">
                                    <a class="text-muted font-size-16" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Separated link</a>
                                    </div>
                                </div> --}}
                            </div>
                            <div data-simplebar="init" class="mt-2 border border-2 rounded" style="max-height: 370px;"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: -16.8889px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: auto; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">
                                <ul class="verti-timeline list-unstyled">
                                    @foreach($leaderboard_var1 as $data)
                                    <li class="event-list active">
                                        <div class="event-timeline-dot">
                                            <i class="bx bxs-right-arrow-circle text-dark font-size-18"></i>
                                        </div>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <h5 class="font-size-14">{{$data->created_at->format('jS \\of F Y ')}} <i class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ms-2"></i></h5>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div>
                                                     <span class="fw-semibold">{{number_format($data->net_commission)}} AED</span> <br> {{@$data->leader_details->name}}
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 341px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 229px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>

                        </div>
                    </div>
                </div>


                <div class="col-lg-6">
                    <div class="card">

                        {{-- Apex Charts --}}
                        <div class="card-body" style="position: relative;">
                            <h4 class="card-title mb-4">Total Commission vs Leads Recieved</h4>
                            <div id="chart_agent_stats" class="apex-charts" dir="ltr" style="max-width: 100%;  margin: 35px auto; opacity: 0.9;">
                            </div>
                            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 713px; height: 443px;"></div></div><div class="contract-trigger"></div></div>
                        </div>
                        {{-- Apex Charts --}}
                    </div>

                </div>


                 <div class="col-lg-3">
                    <div class="card" style="min-height: 480px;">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Details</h4>
                            <div class="row mt-5">
                                <div class="col-sm-6">
                                    <p>Number of Leads</p>
                                    <h5>{{ number_format($dashboard_total_leads_2023) }} </h5>
                                </div>
                                <div class="col-sm-6">
                                    <p>Total Rent/Sale Value</p>
                                    <h5>{{ number_format($total_sales_and_rent) }} </h5>
                                </div>
                            </div>




                            <div class="row mt-5">
                                <div class="col-sm-6">
                                    <p>Total Commission</p>
                                    <h5>{{ number_format($total_net_commission) }} </h5>
                                </div>

                                <div class="col-sm-6">
                                    <p>Campaign Leads</p>
                                    <h5>{{ number_format($dashboard_campaign_lead_count) }} </h5>
                                </div>
                            </div>



                            <div class="row mt-5">
                                <div class="col-sm-6">
                                    <p>Portal Leads</p>
                                    <h5>{{ number_format($dashboard_portal_lead_count) }} </h5>
                                </div>

                                <div class="col-sm-6">
                                    <p>Website Leads</p>
                                    <h5>{{ number_format($dashboard_website_lead_count) }} </h5>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>

    var cData = {{ json_encode($total_net_commission_company2) }};
    var wData = {{ json_encode($total_leads_overall) }};
    var max = 1200000;
    // console.log(cData.reverse);


    var options = {
        series: [{
            name: "Total Commission",
            data: cData
        },
        {
            name: 'Leads Recieved',
            data: wData
        }
        ],
        chart: {
            height: 350,
            type: 'area',
            zoom: {
                enabled: true
            },
        },
        colors: ['#8d02eb', '#1f0133'],
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

    var chart = new ApexCharts(document.querySelector("#chart_agent_stats"), options);
    chart.render();

    // APex charts data
</script>


@endsection
