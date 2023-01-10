
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
        margin-top: 350px;
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
                                    <h3>
                                        Statistics
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

                            <div class="col-12">
                                <div class="card">
                                    <div class="row">
                                        <div class="watermark">{{Auth::user()->name}}</div>
                                    </div>
                                    <div class="card-body" style="position: relative">

                                        <form accept="{{url(' ')}}" method="GET" enctype="multipart/form-data">
                                            <div class="row">



                                                <div class="col-md-3">
                                                    {{-- <input type="text" class="form-control" id="autoSizingInput" placeholder="Jane Doe"> --}}
                                                    <select class="form-select form-control" id="autoSizingSelect" name="lead_type">
                                                        <option >Choose a Lead Type...</option>
                                                        <option value="1" selected>All Leads</option>
                                                        <option value="2">Campaign Leads</option>
                                                        <option value="3">Property Leads</option>
                                                        <option value="4">Website Leads</option>
                                                    </select>
                                                </div>



                                                <div class="col-md-3">
                                                    <select class="form-select form-control" id="autoSizingSelect" name="agent">
                                                        <option >Choose Agent...</option>
                                                        @if($agents)
                                                            @foreach ( $agents as $agent )
                                                                <option value="{{$agent->id}}">{{ $agent->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>



                                                <div class="col-md-3">
                                                    <select class="form-select form-control" id="autoSizingSelect" name="lead_status">
                                                        <option >Choose Lead Status...</option>
                                                        <option value="1" >All Leads</option>
                                                        <option value="2">Campaign Leads</option>
                                                        <option value="3">Property Leads</option>
                                                        <option value="4">Website Leads</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-auto">
                                                    <select class="form-select form-control" id="autoSizingSelect" name="year">
                                                        <option >Choose year...</option>
                                                        <option value="1" selected>2022</option>
                                                        <option value="1" >2021</option>
                                                        <option value="1" >2020</option>
                                                    </select>
                                                </div>



                                                <div class="col-md-auto">
                                                    <button type="submit" class="btn btn-primary w-xl">Submit</button>
                                                </div>



                                            </div>
                                        </form>

                                        {{-- Chart --}}
                                        <div class="row mt-3">


                                                {{-- Apex Charts --}}
                                                @include('stats.all_leads')
                                                {{-- Apex Charts --}}


                                        </div>
                                        {{-- Chart --}}

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
            //  $(document).ready(function(){
            //     $("#flip").click(function(){
            //         $("#panel").slideToggle("slow");
            //     });
            // });







            // Apex charts data




            </script>


@endsection


