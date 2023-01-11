
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





                        {{-- Menu-bar --}}
                        @include('stats.menu_bar')
                        {{-- /Menu-bar --}}









                        {{-- Statistics Overview --}}
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
                                <div class="card shadow-sm">
                                    {{-- <div class="row">
                                        <div class="watermark">{{Auth::user()->name}}</div>
                                    </div> --}}
                                    <div class="card-body" style="position: relative">


                                        {{-- Form --}}
                                        <div class="d-none d-md-block d-lg-block">
                                            <form action="{{url('/statistics/search')}}" method="GET" enctype="multipart/form-data">
                                                <div class="row mx-auto">


                                                    {{-- Desktop responsive --}}
                                                    <div class="d-none d-md-block d-lg-block ">
                                                        <div class="d-flex justify-content-center mx-auto">
                                                            {{-- <div class="col-md-3 my-2 mx-2 ">
                                                                <select class="form-select form-control" id="autoSizingSelect" name="lead_type">
                                                                    <option >Choose a Lead Type...</option>
                                                                    @if (isset($request))
                                                                        @if ($request->lead_type == '1')
                                                                            <option value="1" selected>All Leads</option>
                                                                        @else
                                                                            <option value="1">All Leads</option>
                                                                        @endif

                                                                        @if ($request->lead_type == '2')
                                                                            <option value="2" selected>Campaign Leads</option>
                                                                        @else
                                                                            <option value="2">Campaign Leads</option>
                                                                        @endif

                                                                        @if ($request->lead_type == '3')
                                                                            <option value="3" selected>Property Leads</option>
                                                                        @else
                                                                            <option value="3">Property Leads</option>
                                                                        @endif

                                                                        @if ($request->lead_type == '4')
                                                                            <option value="4" selected>Website Leads</option>
                                                                        @else
                                                                            <option value="4">Website Leads</option>
                                                                        @endif
                                                                    @else
                                                                        <option value="1" selected>All Leads</option>
                                                                        <option value="2">Campaign Leads</option>
                                                                        <option value="3">Property Leads</option>
                                                                        <option value="4">Website Leads</option>
                                                                    @endif
                                                                </select>
                                                                </form>
                                                            </div> --}}



                                                            <div class="col-md-3 my-2 mx-2">
                                                                <input value="1" name="lead_type" hidden>
                                                                <select class="form-select form-control" id="autoSizingSelect" name="agent">
                                                                    <option value="">Choose Agent...</option>
                                                                    @if($agents)
                                                                        @foreach ( $agents as $agent )
                                                                            <option value="{{$agent->id}}">{{ $agent->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>



                                                            <div class="col-md-auto my-2 mx-2">
                                                                <button type="submit" class="btn btn-dark w-xl">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- /Desktop responsive --}}




                                                </div>
                                            </form>
                                        </div>
                                        {{-- /Form --}}




                                        {{-- Mobile Form --}}
                                        <div class="d-md-none d-lg-none d-xl-none">
                                            <form action="{{url('/statistics/msearch')}}" method="GET" enctype="multipart/form-data">
                                                <div class="row mx-auto">

                                                    {{-- Mobile responsive --}}
                                                    <div class="d-md-none d-lg-none d-xl-none">
                                                        <div class="col-md-3 my-2 mx-2">
                                                            {{-- <input type="text" class="form-control" id="autoSizingInput" placeholder="Jane Doe"> --}}
                                                            {{-- <form id="IdName" action="/" enctype="multipart/form-data" method="GET"> --}}
                                                            <select class="form-select form-control" id="autoSizingSelect" name="lead_type">
                                                                {{-- <select class="form-select form-control" id="autoSizingSelect" name="lead_type" onchange="IdName.submit()"> --}}
                                                                <option >Choose a Lead Type...</option>
                                                                @if (isset($request))
                                                                    @if ($request->lead_type == '1')
                                                                        <option value="1" selected>All Leads</option>
                                                                    @else
                                                                        <option value="1">All Leads</option>
                                                                    @endif

                                                                    @if ($request->lead_type == '2')
                                                                        <option value="2" selected>Campaign Leads</option>
                                                                    @else
                                                                        <option value="2">Campaign Leads</option>
                                                                    @endif

                                                                    @if ($request->lead_type == '3')
                                                                        <option value="3" selected>Property Leads</option>
                                                                    @else
                                                                        <option value="3">Property Leads</option>
                                                                    @endif

                                                                    @if ($request->lead_type == '4')
                                                                        <option value="4" selected>Website Leads</option>
                                                                    @else
                                                                        <option value="4">Website Leads</option>
                                                                    @endif
                                                                @else
                                                                    <option value="1" selected>All Leads</option>
                                                                    <option value="2">Campaign Leads</option>
                                                                    <option value="3">Property Leads</option>
                                                                    <option value="4">Website Leads</option>
                                                                @endif



                                                            </select>
                                                            {{-- </form> --}}
                                                        </div>



                                                        <div class="col-md-3 my-2 mx-2">
                                                            <select class="form-select form-control" id="autoSizingSelect" name="agent">
                                                                <option value="">Choose Agent...</option>
                                                                @if($agents)
                                                                    @foreach ( $agents as $agent )
                                                                        <option value="{{$agent->id}}">{{ $agent->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>


                                                        <div class="col-md-auto my-2 mx-2">
                                                            <button type="submit" class="btn btn-dark btn-block w-100">Submit</button>
                                                        </div>
                                                    </div>
                                                    {{-- /Mobile responsive --}}




                                                </div>
                                            </form>
                                        </div>
                                        {{-- Mobile Form --}}






                                    </div>
                                </div>


                                {{-- Chart --}}
                                <div class="row mt-3">

                                    @if (isset($search))

                                        {{-- Apex charts on search results --}}
                                        @include('stats.search_result')
                                        {{-- /Apex charts on search results --}}

                                    @else

                                        {{-- Apex Charts in deafault --}}
                                        @include('stats.all_leads')
                                        {{-- /Apex Charts in deafault --}}

                                    @endif



                                </div>
                                {{-- Chart --}}
                            </div> <!-- end col -->
                        </div>
                        {{-- /Statistics Overview --}}





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


