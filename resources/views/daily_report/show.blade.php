
@extends('layout.master')

@section('content')
    <style>
        thead input {
            width: 100%;
        }

        .watermark{

            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 0;
            margin-top: 250px;
            color: #a1a1a1;
            font-size: 5rem;
            font-weight: 700;
            display: grid;
            justify-content: center;
            align-content: center;
            opacity: 0.2;
            transform: rotate(-30deg);
        }
        #panel {

        display: none;
        }
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
                                    <h4 class="mb-sm-0 font-size-18">Daily Report</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{URL('')}}">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Daily Report</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->



                        <div class="row">
                            @if(session()->has('message'))
                            <div class="col-12">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-check-all me-2"></i>
                                    {{ session()->get('message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                            @endif
                            <div class="col-12 mx-0 px-0">
                                <div class="card">
                                    <div class="row">
                                        <div class="watermark">{{Auth::user()->name}}</div>
                                    </div>
                                    <div class="card-body" style="position: relative">


                                        @if (Auth::user()->user_type == '1')
                                        <div class="row mb-4">
                                            <div class="col-lg-12">
                                                {{-- <button type="button" class="btn btn-outline-dark float-end"><i class="bx bx-plus" data-bs-toggle="modal" data-bs-target="#create_lead_modal"></i> Create Lead</button> --}}
                                                {{-- <a href="{{URL('/property_listing/create_property_leads')}}" class="btn btn-dark float-end"><i class="bx bx-filter-alt"> </i> Create Lead</a> --}}

                                                <div class=" float-end">
                                                    <button class="btn btn-dark" style="background-color: black;" type="button" data-bs-toggle="modal" data-bs-target="#create_report_modal">
                                                            + Add Report
                                                    </button>
                                                </div>
                                            </div>
                                        </div>





                                        {{-- Admin Search --}}
                                        @include('daily_report.search.admin')


                                        {{-- Admin Table --}}
                                        {{-- <b>Total number of {{ $leads->total() }} leads</b> --}}

                                        @include('daily_report.table.admin')



                                        @elseif (Auth::user()->user_type == '2')
                                        <div class="row mb-4">
                                            <div class="col-lg-12">
                                                <div class="float-end">
                                                    <button class="btn btn-dark " style="background-color: black;" type="button" data-bs-toggle="modal" data-bs-target="#create_report_modal">
                                                        + Add Report
                                                    </button>
                                                </div>
                                            </div>
                                        </div>




                                        {{-- Agent Search --}}
                                        @include('daily_report.search.agent')


                                        {{-- Agent Table --}}

                                        {{-- <b>Total number of {{ $leads->total() }} leads</b> --}}

                                        @include('daily_report.table.agent')


                                        @endif

                                        {{-- <b>Total number of {{ $leads->total() }} leads</b> --}}
                                        <br>
                                         {{-- {!! $leads->appends($_GET)->links() !!} --}}

                                        {{-- {!! $leads->appends($_GET)->links() !!} --}}


                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <!-- Modal -->
                <div id="create_report_modal" class="modal fade" tabindex="-1" aria-labelledby="modal" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered  modal-lg">
                        <div class="modal-content">
                            <div class="modal-header p-4">
                                <h4 class="modal-title" id="target_modal">
                                    Create a New Report
                                </h4>
                                <button type="button" class="btn-close bg-secondary" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                            </div>

                            <div class="modal-body p-4">
                                <form method="POST" action="{{url('daily-report/store')}}" enctype="multipart/form-data">
                                @csrf
                                    <div class="row mb-4 mt-1">
                                        <div class="col-md-6">
                                            <label for="inputName" class="form-label">Client Name</label>
                                            <input type="text" class="form-control" name="name" id="inputName" placeholder="Tom Cruise" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputPhone" class="form-label">Client Phone</label>
                                            <input type="text" class="form-control" name="phone" id="inputPhone" placeholder="+971 123 4567" required>
                                        </div>
                                    </div>


                                    <div class="row my-4">
                                        <div class="col-md-6">
                                            <label for="inputEmail" class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" id="inputEmail" placeholder="tomcruise@gmail.com">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputLocation" class="form-label">Location</label>
                                            <input type="text" class="form-control" name="location" id="inputLocation" placeholder="No. 34, Bay Avenue, Business Bay, Dubai" required>
                                        </div>
                                    </div>


                                    <div class="row my-4">
                                        <div class="col-md-6">
                                            <label for="inputReason" class="form-label">Reason</label>
                                            <select class="form-select" aria-label="Reason" id="reasonType" name="reason" required>
                                                <option selected>Select the Reason</option>
                                                <option value="1">Developer</option>
                                                <option value="2">Viewing</option>
                                                <option value="4">Office</option>
                                                <option value="3">Other</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputOther" class="form-label">Other</label>
                                            <input type="text" class="form-control" id="inputOther" name="others" disabled>
                                        </div>
                                    </div>


                                    <div class="row my-4">
                                        <div class="col-md-6">
                                            <label for="inputTime" class="form-label">Time of Occurance</label>
                                            <input type="time" class="form-control" id="inputTime" name="time" required>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary w-100" style="margin-top: 26px !important;">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>


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
window.onload=function()
{
    document.getElementById("reasonType").onchange=function()
    {
        if(this.options[this.selectedIndex].value==2)
        {
            document.getElementById("inputOther").disabled=true;
        }
        else if(this.options[this.selectedIndex].value==1)
        {
            document.getElementById("inputOther").disabled=true;
        }
        else if(this.options[this.selectedIndex].value==3)
        {
            document.getElementById("inputOther").disabled=false;
            document.getElementById("inputOther").required=true;
        }
        else if(this.options[this.selectedIndex].value==4)
        {
            document.getElementById("inputOther").disabled=false;
            document.getElementById("inputOther").required=true;
        }
    }


}
</script>

@endsection


