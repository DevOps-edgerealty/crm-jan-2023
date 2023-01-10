
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
                                    <h4 class="mb-sm-0 font-size-18">Trash Leads</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{URL('')}}">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Trash Leads</li>
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

                                        <h4 class="card-title">Campagin Leads</h4>
                                        <p class="card-title-desc"></p>

                                        <div class="table-rep-plugin">
                                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                <table id="tech-companies-1" class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Ref Number</th>
                                                            <th>Lead Platform</th>
                                                            <th>Inquiry</th>
                                                            <th>Last Update</th>
                                                            <th>Full Name</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Agent Name</th>
                                                            <th>Details</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>



                                                    <tbody>
                                                        @foreach ($leads as $lead)
                                                            <tr>
                                                                <td>{{$lead->ref_no}}</td>
                                                                <td>{{$lead->lead_typess->type_name}}</td>
                                                                <td>{{$lead->inquiry}}</td>
                                                                <td>{{@$lead->lead_detailss->lead_description}}</td>
                                                                <td>{{$lead->full_name}}</td>
                                                                <td>{{$lead->email}}</td>
                                                                <td>{{$lead->phone}}</td>
                                                                <td>{{$lead->users->name}}</td>
                                                                <td>
                                                                    <a href="{{url('leads/detail').'/'. $lead->id }}" class="btn btn-outline-info btn-sm Transfer" title="Details">
                                                                        <i class="fas fa-eye"> </i>
                                                                    </a>
                                                                </td>

                                                                <td>




                                                                <a href="{{('leads/transfer_trash/'.$lead->id)}}" class="btn btn-outline-info btn-sm Transfer" title="Transfer">
                                                                    <i class="fas fa-sync"> </i>
                                                                </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


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
