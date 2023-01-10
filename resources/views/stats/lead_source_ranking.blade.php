
@extends('layout.master')

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">







            <!-- start page title -->
            {{-- <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h3>
                            Monthly - Lead Source Ranking
                        </h3>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{URL('')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Statistics</li>
                                <li class="breadcrumb-item active">Overview</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div> --}}
            <!-- end page title -->




            {{-- Menu-bar --}}
            @include('stats.menu_bar')
            {{-- /Menu-bar --}}






            <div class="row">
                <div class="col-xl-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                                <form method="POST" action="{{url('statistics/lead_source_ranking_by_month')}}" enctype="multipart/form-data">
                                    @csrf
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="row">

                                            <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Select Month</label>
                                            <div class="col-sm-6 mb-3">
                                                <select id="formrow-inputState" name="month" class="form-select">
                                                    <option value="" selected>Select Month</option>
                                                    <option {{ ($month) == '01' ? 'selected' : '' }} value="01">January</option>
                                                    <option {{ ($month) == '02' ? 'selected' : '' }} value="02">Febuary</option>
                                                    <option {{ ($month) == '03' ? 'selected' : '' }} value="03">March</option>
                                                    <option {{ ($month) == '04' ? 'selected' : '' }} value="04">April</option>
                                                    <option {{ ($month) == '05' ? 'selected' : '' }} value="05">May</option>
                                                    <option {{ ($month) == '06' ? 'selected' : '' }} value="06">June</option>
                                                    <option {{ ($month) == '07' ? 'selected' : '' }} value="07">July</option>
                                                    <option {{ ($month) == '08' ? 'selected' : '' }} value="08">August</option>
                                                    <option {{ ($month) == '09' ? 'selected' : '' }} value="09">September</option>
                                                    <option {{ ($month) == '10' ? 'selected' : '' }} value="10">October</option>
                                                    <option {{ ($month) == '11' ? 'selected' : '' }} value="11">November</option>
                                                    <option {{ ($month) == '12' ? 'selected' : '' }} value="12">December</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <button type="submit" class="btn btn-outline-dark btn-block w-md">Submit</button>
                                            </div>
                                        </div>





                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="text-secondary text-justify mt-2">Categorization of all deals made by the source of lead and ranking it by the number of deals made for the particular month</p>

                                                <div class="table-responsive">
                                                    <table class="table table-nowrap align-middle mb-0 table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Id</th>
                                                                <th scope="col">Lead Source</th>
                                                                <th scope="col">Count</th>
                                                                <th scope="col">Commission</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($leader_board as $data => $value)
                                                                <tr class='clickable-row' data-href='url://link-for-first-row/'>
                                                                    <th scope="row">
                                                                        <div class="d-flex align-items-center">
                                                                             &nbsp;
                                                                            <div class="avatar-xs me-3">
                                                                                <span class="avatar-title rounded-circle bg-warning bg-opacity-100 text-white font-size-18">
                                                                                    {{$data+1}}
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </th>
                                                                    <td>
                                                                        <div class="text-muted">
                                                                            <a href="#">
                                                                                {{$value->lead_source}}
                                                                            </a>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <a href="#">
                                                                            <h5 class="font-size-14 mb-1"> {{$value->count}}</h5>
                                                                        </a>
                                                                    </td>

                                                                    <td>
                                                                        <a href="#">
                                                                            <h5 class="font-size-14 mb-1">AED {{number_format($net_commission[$data])}}</h5>
                                                                        </a>
                                                                    </td>

                                                                    <td>
                                                                        <div class="text-muted">
                                                                            <a href="{{url('statistics/lead_source_ranking_by_month/sources').'/'. $value->lead_source.'/'. @$month}}" class="btn btn-outline-dark btn-sm">
                                                                                Details
                                                                            </a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>





                                    </div>
                                    <div class="col-md-6">
                                        @php
                                            $monthNum  = $month;
                                            $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
                                        @endphp

                                        {{-- <h3 class="text-center">Monthly Ranking Month of {{date('F Y');}} </h3> --}}

                                        <h3 class="text-center">Lead Source Rank {{$monthName}} {{date('Y');}} </h3>
                                        <div id="monthly_ranking" class="apex-charts" dir="ltr" style="max-width: 100%;  margin: 35px auto; opacity: 0.9;">
                                        </div>
                                        <div class="resize-triggers"><div class="expand-trigger"><div style="width: 200px; height: 443px;"></div></div><div class="contract-trigger"></div></div>


                                    </div>

                                </div>

                                <div class="row">

                                </div>
                            </form>
                            </div>
                    </div><!--end card-->
                </div>
            </div>

        </div>
    </div>
</div>


<script type="text/javascript">
    var cData = JSON.parse(`<?php echo $chart_data; ?>`);
    var ctx = document.getElementById("monthly");
    if (cData === undefined || cData.length == 0) {
        var options = {
            series: [100],
            chart: {
            width: 680,
            type: 'pie',
        },
        labels: ['no data', 'no data'],
        responsive: [{
            breakpoint: 580,
            options: {
                chart: {
                width: 300
                },
                legend: {
                position: 'bottom'
                }
            }
            }]
        };
    }
    else{
        var options = {
            series: cData.data,
            chart: {
            width: 680,
            type: 'pie',
        },
        labels: cData.label,
        responsive: [{
            breakpoint: 580,
            options: {
                chart: {
                width: 300
                },
                legend: {
                position: 'bottom'
                }
            }
            }]
        };
    }



        var chart = new ApexCharts(document.querySelector("#monthly_ranking"), options);
        chart.render();
</script>




@endsection
