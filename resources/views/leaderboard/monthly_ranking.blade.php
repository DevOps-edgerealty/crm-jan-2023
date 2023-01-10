
@extends('layout.master')

@section('content')


 <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Monthly Ranking</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{URL('')}}">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Monthly Ranking</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">

                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="col-lg-6">
                                            <form method="POST" action="{{url('leader_board/monthly_ranking_by_month')}}" enctype="multipart/form-data">
                                                @csrf
                                            <div class="row mb-4">

                                                    <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Select Month</label>
                                                    <div class="col-sm-6 mb-3">
                                                        <select id="formrow-inputState" name="month" class="form-select">
                                                            <option selected="">Select Month</option>
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
                                                        <button type="submit" class="btn btn-primary btn-block w-md">Submit</button>
                                                    </div>

                                            </div>
                                         </form>
                                        </div>




                                    </div>
                                </div><!--end card-->
                            </div>

                        </div>

                        <!-- end row -->


                        <div class="row">

                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            Select Month
                                        </div>
                                        @php
                                            $monthNum  = $month;
                                            $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
                                        @endphp

                                        {{-- <h3 class="text-center">Monthly Ranking Month of {{date('F Y');}} </h3> --}}

                                        <h3 class="text-center">Monthly Ranking Month of {{$monthName}} {{date('Y');}} </h3>
                                        <canvas id="myChart" style="position: relative; height:60vh; width:80vw"></canvas>


                                    </div>
                                </div><!--end card-->
                            </div>

                        </div>
                        <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © Edge Realty.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Design & Develop by Edge Realty
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->
            <script>
                var cData = JSON.parse(`<?php echo $chart_data; ?>`);
                var ctx = document.getElementById("myChart");

                var myChart = new Chart(ctx, {
                type: "bar",
                options: {
                    plugins: {
                    datalabels: {
                        // hide datalabels for all datasets
                        display: false
                    }
                    }
                },

                tooltips: {
                                enabled: true
                            },


                data: {
                    labels: cData.label,


                    datasets: [
                    {
                        maintainAspectRatio: false,
                        label: "Values in AED",
                        data: cData.data,
                        backgroundColor: [

                        "rgba(54, 162, 235, 0.2)",

                        ],
                        borderColor: [

                        "rgba(54, 162, 235, 1)",

                        ],
                        borderWidth: 1,

                    }
                    ]
                },


                options: {
                    scales: {
                    y: {
                        scaleLabel: {
                            display: true,

                        }

                    },
                    x:
                        {
                        ticks: {

                            autoSkip: false,
                            maxRotation: 75,
                            minRotation: 75
                        }
                        }


                    }
                }
                });

            </script>

@endsection

