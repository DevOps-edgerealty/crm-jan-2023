
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
                                    <h4 class="mb-sm-0 font-size-18">Temporary Leads</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{URL('')}}">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Temporary Leads</li>
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

                                        <h4 class="card-title">Portal Leads</h4>
                                        <p class="card-title-desc"></p>
                                        @if (Auth::user()->user_type == '1')

                                        <div class="table-rep-plugin">
                                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                <table id="tech-companies-1" class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Ref Number</th>

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
                                                        @foreach ($property_leads as $lead)
                                                            <tr>
                                                                <td>{{$lead->ref_no}}</td>

                                                                <td style="width: 300px">{{$lead->inquiry}}</td>
                                                                <td>{{@$lead->lead_detailss->lead_description}}</td>
                                                                <td>{{$lead->full_name}}</td>
                                                                <td>{{$lead->email}}</td>
                                                                <td>{{$lead->phone}}</td>
                                                                <td>{{@$lead->users->name}}</td>
                                                                <td>
                                                                    <a href="{{url('property_listing/detail').'/'. $lead->id }}" class="btn btn-outline-info btn-sm Transfer" title="Details">
                                                                        <i class="fas fa-eye"> </i>
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-outline-info btn-sm  waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center-{{$lead->id}}"><i class="fas fa-edit"></i> Reassign to another</button>

                                                                    <a href="{{URL('property_listing_leads/transfer_temporary'.'/'.$lead->id)}}" class="btn btn-outline-warning btn-sm Transfer" title="Reassign Lead">
                                                                        <i class="fas fa-sync"> </i> Reassign Lead
                                                                    </a>
                                                                </td>


                                                            </tr>
                                                            <div class="modal fade bs-example-modal-center-{{$lead->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Refrence Number: {{$lead->ref_no}}</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <div class="col-sm-12">
                                                                                        <h4 class="card-title mt-4 mb-4">Lead Trasnfer To Another Agent</h4>

                                                                                    </div>
                                                                                    <form method="POST" action="{{url('property_listing_leads/temporary/reassign')}}" enctype="multipart/form-data">
                                                                                        @csrf
                                                                                        <div class="row mb-4">
                                                                                            <label class="col-sm-3 col-form-label">Select Agent</label>
                                                                                            <div class="col-sm-9">
                                                                                                <select class="form-select" name="user">
                                                                                                    @if ($users)
                                                                                                        @foreach ($users as $user)
                                                                                                            <option {{ ($user->id) == $lead->agent_id ? 'selected' : '' }} value="{{ $user->id}}">{{ $user->name }}</option>
                                                                                                        @endforeach
                                                                                                    @endif
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <input type="hidden" name="lead_id" value="{{$lead->id}}" >

                                                                                        <div class="row justify-content-end">
                                                                                            <div class="col-sm-9">

                                                                                                <div>
                                                                                                    <button type="submit" class="btn btn-success w-md"><i class="fas fa-arrow-right"> </i> Transfer</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                    </form>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div><!-- /.modal-content -->
                                                                </div><!-- /.modal-dialog -->
                                                            </div><!-- /.modal -->
                                                        @endforeach


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        @else
                                        <div class="table-rep-plugin">
                                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                <table id="tech-companies-1" class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Reference Number</th>

                                                    <th>Inquiry</th>
                                                    <th>Last Update</th>

                                                    <th>Actions</th>
                                                </tr>
                                                </thead>


                                                <tbody>
                                                    @foreach ($property_leads as $lead)
                                                        <tr>
                                                            <td>{{$lead->ref_no}}</td>

                                                            <td>{{$lead->inquiry}}</td>
                                                            <td>{{@$lead->lead_detailss->lead_description}}</td>




                                                            <td>
                                                            <a href="{{url('property_listing_leads/transfer/'.$lead->id)}}" class="btn btn-outline-info btn-sm Transfer" title="Transfer">
                                                                <i class="fas fa-sync"> </i>
                                                            </a>

                                                            </td>
                                                        </tr>
                                                    @endforeach


                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                        @endif

                                    </div>
                                </div>
                            </div>


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
