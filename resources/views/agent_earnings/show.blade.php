@extends('layout.master')

@section('content')
<style>
    @page { size: auto;  margin: 5mm; }
</style>

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
                                    <h4 class="mb-sm-0 font-size-18">Earning Details</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{URL('')}}">Home</a></li>
                                            <li class="breadcrumb-item active">Earning Details</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-12 d-none d-print-block">
                                <div class=" p-4">

                                    <img class="pt-2 d-inline-block" src="https://www.edgerealty.ae/public/assets/images/logo-black.png" style="height:75px" alt="">

                                    <div class="text-center" style="margin-top: -65px;">
                                        <h6 class="mb-0"><b>  Edge Realty Real Estate </b></h6>
                                        <h6 class="mb-0"><b> Office No, 117 , DNIC Building,Sheikh Zayed Road Dubai</b></h6>
                                        <h6 class="mb-0"><b> Tel:+97143881856,Email: info@edgerealty.ae </b></h6>
                                        <h4 class="mt-3">Sales Net Commission</h4>
                                        <br>
                                    </div>
                                </div>

                            </div>


                            <div class="col-xl-12"></div>
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4 d-print-none">Agent Details</h4>
                                        <h4 class="card-title mb-4 d-none d-print-block">Agent Detail</h4>
                                        <div class="table-rep-plugin mb-3">
                                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                <table id="tech-companies-1" class="table table-striped">
                                                    <tbody>

                                                        <tr>
                                                            <th scope="row" class="w-auto fw-bold">Agent Name</th>
                                                            <td  class="w-auto">{{$leader_board->name}}</td>
                                                            <th scope="row" class="w-auto fw-bold">E-mail</th>
                                                            <td class="w-auto">{{$leader_board->email}}</td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class=" fw-bold">Total Net Commission </th>
                                                            <td><a href="javascript: void(0);" class="badge badge-soft-success font-size-14 m-1">AED {{ number_format($leader_net_commision) }}</a></td>
                                                            <th scope="row"></th>
                                                            <td></td>
                                                        </tr>


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>




                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                            <div class="col-xl-12">

                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Agent Earnings</h4>
                                        @if(session()->has('message'))
                                        <div class="col-12">
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <i class="mdi mdi-check-all me-2"></i>
                                                {{ session()->get('message') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="table-rep-plugin mb-5">
                                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                <table id="tech-companies-1" class="table border">
                                                    <thead class="shadow-sm">
                                                        <tr>

                                                            <td>
                                                                Leaderboard Description
                                                            </td>
                                                            <td>
                                                                Lead Source
                                                            </td>
                                                            <td>
                                                                Sale Value
                                                            </td>
                                                            <td>
                                                                Rent Value
                                                            </td>
                                                            <td>
                                                                Net Commission
                                                            </td>
                                                            <td>
                                                                Date
                                                            </td>

                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        {{-- @foreach ($lead_detail as $detail) --}}
                                                        @if (!empty($leader_detail) )
                                                        @foreach ($leader_detail as $leader)
                                                            <tr>

                                                                <td>{{@$leader->leader_detail}}</td>

                                                                @if($leader->lead_source != null)
                                                                    <td>{{@$leader->lead_source}}</td>
                                                                @else
                                                                    <td> No Source Listed </td>
                                                                @endif

                                                                <td>{{@ number_format($leader->sale_value)}}</td>

                                                                <td>{{@ number_format($leader->rent_value)}}</td>

                                                                <td>{{@ number_format($leader->net_commission)}}</td>

                                                                <td>{{date('d-m-Y H:i:s', strtotime($leader->created_at));}}</td>

                                                            </tr>
                                                        @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="3" class="text-center">No Record Found</td>
                                                            </tr>

                                                        @endif

                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->


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


@endsection
