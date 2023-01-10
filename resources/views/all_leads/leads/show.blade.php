
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
                                    <h4 class="mb-sm-0 font-size-18">All Leads</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{URL('')}}">Dashboard</a></li>
                                            <li class="breadcrumb-item active">All leads</li>
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
                                        <div class="row">
                                            <div class="col-lg-12">
                                                {{-- <button type="button" class="btn btn-outline-dark float-end"><i class="bx bx-plus" data-bs-toggle="modal" data-bs-target="#create_lead_modal"></i> Create Lead</button> --}}
                                                {{-- <a href="{{URL('/property_listing/create_property_leads')}}" class="btn btn-dark float-end"><i class="bx bx-filter-alt"> </i> Create Lead</a> --}}

                                                <div class="dropdown float-end">
                                                    <button class="btn btn-dark dropdown-toggle" style="background-color: black;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        + Add Lead <i class="bx bx-caret-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li>
                                                            <a class="dropdown-item" href="{{URL('/leads/create_leads')}}">Campaign Lead</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{URL('/website/create_website_leads')}}">Website Lead</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{URL('/property_listing/create_property_leads')}}">Portal Lead</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>





                                        {{-- Admin Search --}}
                                        @include('all_leads.leads.search.admin_search')


                                        {{-- Admin Table --}}
                                        {{-- <b>Total number of {{ $leads->total() }} leads</b> --}}

                                        @include('all_leads.leads.table.admin_table')



                                        @elseif (Auth::user()->user_type == '2')
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="dropdown float-end">
                                                    <button class="btn btn-dark dropdown-toggle" style="background-color: black;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        + Add Lead <i class="bx bx-caret-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li>
                                                            <a class="dropdown-item" href="{{URL('/property_listing/create_property_leads')}}">Portal Lead</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>




                                        {{-- Agent Search --}}
                                        @include('all_leads.leads.search.agent_search')


                                        {{-- Agent Table --}}

                                        {{-- <b>Total number of {{ $leads->total() }} leads</b> --}}

                                        @include('all_leads.leads.table.agent_table')


                                        @endif

                                        {{-- <b>Total number of {{ $leads->total() }} leads</b> --}}
                                        <br>
                                         {{-- {!! $leads->appends($_GET)->links() !!} --}}
                                        {!! $leads->appends($_GET)->links() !!}


                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <!-- Modal -->
                                        <div id="create_lead_modal" class="modal fade" tabindex="-1" aria-labelledby="modal" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered ">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="target_modal">
                                                            Create New Lead
                                                        </h4>
                                                        <button type="button" class="btn-close bg-secondary" data-bs-dismiss="modal" aria-label="Close">
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="row mb-4">
                                                            <div class="col-sm-4">
                                                                <a href="{{URL('/leads/create_leads')}}" class="btn btn-primary float-end"> Campaign Lead</a>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <a href="{{URL('/website/create_website_leads')}}" class="btn btn-dark float-end"> Website Lead</a>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <a href="{{URL('/property_listing/create_property_leads')}}" class="btn btn-success float-end"> Portal Lead</a>
                                                            </div>
                                                        </div>

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


@endsection


