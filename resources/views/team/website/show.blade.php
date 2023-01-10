
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
                        @include('team.nav')
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
                                        <h4 class="mb-sm-0 font-size-24">Team Website Leads</h4>


                                            <div class="row">
                                                <div class="col-lg-12 mb-3">
                                                    @if (Auth::user()->team_leader == '1')
                                                    @else
                                                        <a href="{{URL('/leads/create_leads')}}" class="btn btn-dark float-end"><i class="bx bx-filter-alt"> </i> Create Lead</a>
                                                    @endif

                                                </div>
                                                {{-- <div class="col-lg-4">
                                                    <form action="{{ URL('import') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <label for="">Excel Import</label>
                                                        <input type="file" name="file" class="form-control mb-2">
                                                        <input type="submit" class="btn btn-dark">

                                                    </form>
                                                </div> --}}
                                            </div>


                                            <p class="card-title-desc mb-2"></p>
                                            {{-- <h4 class="card-title mb-3">Search</h4> --}}


                                            {{-- Search --}}
                                            @include('team.website.search')
                                            {{-- /Search --}}



                                            {{-- Campaign Table --}}
                                            <div class="table-rep-plugin" >
                                                @include('team.website.includes.table')
                                            </div>
                                            {{-- /Campaign Table --}}



                                            {{-- campaign Modal --}}
                                            @foreach ($leads as $lead)
                                                @include('team.website.includes.modal')
                                            @endforeach
                                            {{-- /Campaign Modal --}}


                                        {!! $leads->appends($_GET)->links() !!}
                                        {{ $leads->firstItem() }} - {{ $leads->lastItem() }} Total Leads {{$leads->total()}}

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


