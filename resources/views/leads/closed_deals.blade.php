
@extends('layout.master')

@section('content')
<style>
    thead input {
        width: 100%;
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
                                    <h4 class="mb-sm-0 font-size-18">Closed Deal Campaign Leads</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{URL('')}}">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Closed Deal Campaign Leads</li>
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
                                    <div class="card-body">




                                        <h4 class="card-title"></h4>
                                        <p class="card-title-desc mb-5"></p>

                                        <table id="example" class="table table-bordered w-100">
                                            <thead>
                                            <tr>
                                                <th>Ref Number</th>

                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>


                                            </tr>
                                            </thead>


                                            <tbody>
                                                @foreach ($leads as $lead)
                                                    <tr>
                                                        <td>{{$lead->ref_no}}</td>
                                                   

                                                        <td>{{$lead->full_name}}</td>
                                                        <td>{{$lead->email}}</td>
                                                        <td>{{$lead->phone}}</td>


                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>





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


@endsection


