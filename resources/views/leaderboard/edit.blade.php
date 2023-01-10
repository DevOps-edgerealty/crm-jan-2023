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
                                    <h4 class="mb-sm-0 font-size-18">Leaderboard Detail</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{URL('')}}">Home</a></li>
                                            <li class="breadcrumb-item"><a href="{{URL('/leader_board')}}">Leaderboard</a></li>
                                            <li class="breadcrumb-item active">Leaderboard Detail</li>
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
                                        <h4 class="card-title mb-4">Leaderboard Details</h4>
                                        @if(session()->has('message'))
                                        <div class="col-12">
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <i class="mdi mdi-check-all me-2"></i>
                                                {{ session()->get('message') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="d-print-none">
                                            <h4 class="card-title mb-4"> Add Leader Detail</h4>

                                           <form method="POST" action="{{url('leader_board/detail/update/'.$leader_detail->id)}}" enctype="multipart/form-data">
                                                @csrf

                                                <div class="row mb-4">
                                                    <label class="col-sm-3 col-form-label">Add Sale Value</label>
                                                    <div class="col-sm-9">

                                                        <input class="form-control" value="{{$leader_detail->sale_value}}" name="sale_value" type="number"  id="example-text-input" required="false">

                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label class="col-sm-3 col-form-label">Add Rent Value</label>
                                                    <div class="col-sm-9">

                                                        <input class="form-control" name="rent_value" value="{{$leader_detail->rent_value}}"  type="number"  id="example-text-input">

                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label class="col-sm-3 col-form-label">Add Commission</label>
                                                    <div class="col-sm-9">

                                                        <input class="form-control" name="net_commission" value="{{$leader_detail->net_commission}}"  type="number"  id="example-text-input" required>

                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label class="col-sm-3 col-form-label">Add Lead Source</label>
                                                    <div class="col-sm-9">
                                                        <select id="lead_source" class="form-select" name="lead_source" required>
                                                            @if ($leader_detail->lead_source != null)
                                                                <option value="{{$leader_detail->lead_source}}">{{$leader_detail->lead_source}}</option>
                                                                <option value="">No Lead Source Added - Select a Lead Source</option>
                                                                <option value="Direct">1 - Direct</option>
                                                                <option value="Referral">2 - Referral</option>
                                                                <option value="Portal-Property Finder">3 - Portal-Property Finder</option>
                                                                <option value="Portal-Dubizzle">4 - Portal-Dubizzle</option>
                                                                <option value="Portal-Bayut">5 - Portal-Bayut</option>
                                                                <option value="A to A">6 - A to A</option>
                                                                <option value="Website">7 - Website</option>
                                                                <option value="Campaign">8 - Campaign</option>
                                                            @else
                                                                <option value="">No Lead Source Added - Select a Lead Source</option>
                                                                <option value="Direct">1 - Direct</option>
                                                                <option value="Referral">2 - Referral</option>
                                                                <option value="Portal-Property Finder">3 - Portal-Property Finder</option>
                                                                <option value="Portal-Dubizzle">4 - Portal-Dubizzle</option>
                                                                <option value="Portal-Bayut">5 - Portal-Bayut</option>
                                                                <option value="A to A">6 - A to A</option>
                                                                <option value="Website">7 - Website</option>
                                                                <option value="Campaign">8 - Campaign</option>
                                                            @endif
                                                        </select>
                                                        {{-- <input class="form-control" name="lead_source" type="text"  id="lead_source" required> --}}

                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Add Description</label>
                                                    <div class="col-sm-9">
                                                    <input  name="description" class="form-control" value="{{$leader_detail->leader_detail}}"  type="text"  id="example-text-input" required>



                                                    </div>
                                                </div>
                                                <div class="row justify-content-end">
                                                    <div class="col-sm-9">

                                                        <div>
                                                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>
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
