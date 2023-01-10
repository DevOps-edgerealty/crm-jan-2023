
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
                                    <h3 class="mb-sm-0 font-size-18">Recycle Leads</h3>

                                    {{-- <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{URL('')}}">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Property Listing</li>
                                        </ol>
                                    </div> --}}

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
                                    <div class="card-body " style="position: relative">


                                        @if (Auth::user()->user_type == '1')
                                        <div class="row">
                                            <div class="col-lg-12">


                                                {{-- Create Lead Button --}}
                                                {{-- <a href="{{URL('/property_listing/create_property_leads')}}" class="btn btn-dark float-end"><i class="bx bx-filter-alt"> </i> Create Lead</a> --}}


                                            </div>
                                        </div>



                                        {{-- Admin Search --}}
                                        @include('all_leads.recycle.search.admin_search')


                                        {{-- Admin Table --}}
                                        {{-- <b>Total number of {{ $leads->getTotal() }} leads</b> --}}

                                        @include('all_leads.recycle.table.admin_table')



                                        @else
                                        <div class="row">
                                            <div class="col-lg-12">

                                                {{-- <a href="{{URL('/property_listing/create_property_leads')}}" class="btn btn-dark float-end"><i class="bx bx-filter-alt"> </i> Create Lead</a> --}}

                                            </div>

                                        </div>




                                        {{-- Agent Search --}}
                                        @include('all_leads.recycle.search.agent_search')


                                        {{-- Agent Table --}}
                                        @include('all_leads.recycle.table.agent_table')



                                        @endif

                                        {{-- <b>Total number of {{ $leads->getTotal() }} leads</b> --}}
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
                $(document).ready(function(){
                   $("#flip").click(function(){
                       $("#panel").slideToggle("slow");
                   });
                });
            </script>


@endsection


