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
                                    <h4 class="mb-sm-0 font-size-18">Create Campaign</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{URL('')}}">Home</a></li>
                                            <li class="breadcrumb-item"><a href="{{URL('/Campaign')}}">Campaign</a></li>
                                            <li class="breadcrumb-item active">Create Campaign</li>
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
                                        <h4 class="card-title mb-4">Campaign</h4>

                                        {{-- <form method="POST" action="#" enctype="multipart/form-data"> --}}
                                        <form method="POST" action="{{url('campaign/store')}}" enctype="multipart/form-data">
                                            @csrf

                                            <div class="row mb-4">
                                                <label class="col-md-3 col-form-label">Status</label>
                                                <div class="col-md-9">
                                                    <select name="status" class="form-select" required>
                                                        <option value="">Select</option>
                                                        <option value="1">Active</option>
                                                        <option value="2">Deative</option>



                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label class="col-md-3 col-form-label">Select Platform Type</label>
                                                <div class="col-md-9">
                                                    <select name="lead_type" class="form-select " required>
                                                        <option value="">Select</option>
                                                        @foreach ($lead_type as $lead_types)
                                                            <option value="{{$lead_types->id}}"> {{$lead_types->type_name}} </option>
                                                        @endforeach


                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-4">

                                                <label class="col-md-3 col-form-label">Team Me</label>
                                                <div class="col-md-9">
                                                    <div class="repeater">
                                                        <div data-repeater-list="agent_group"  id="agent_group" class="mb-2">
                                                            <div data-repeater-item="" class="row">
                                                                <div class="mb-2 col-lg-6">
                                                                    <select id="vid_host" class="form-select" name="agent_id" required>
                                                                        <option value="">Select a Team Member</option>
                                                                        <optgroup label="Users">
                                                                            @foreach ($user as $users)
                                                                                <option value="{{$users->id}}"> {{$users->name}} </option>
                                                                            @endforeach
                                                                        </optgroup>
                                                                    </select>
                                                                </div>


                                                                <div class="col-lg-1 align-self-center">
                                                                    <div class="d-grid">
                                                                        <input data-repeater-delete="" type="button" class="btn btn-danger btn-block" value="Delete">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <input data-repeater-create type="button" for="#vid_grp" class="btn btn-success btn-sm mb-3 mt-lg-0" value="+ Add another">
                                                    </div>
                                                    {{-- <select class="select2 form-control select2-multiple" name="agent[]" multiple="multiple" data-placeholder="Select Team ..." required>
                                                        <optgroup label="users">

                                                            @foreach ($user as $users)
                                                                <option value="{{$users->id}}"> {{$users->name}} </option>
                                                            @endforeach
                                                        </optgroup>

                                                    </select> --}}
                                                </div>


                                            </div>

                                            <div class="row mb-4">
                                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Campaign Name</label>
                                                <div class="col-sm-9">
                                                  <input type="text" name="campaign_name" class="form-control" id="horizontal-firstname-input">
                                                </div>
                                            </div>


                                            <div class="row mb-4">
                                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Sources</label>
                                                <div class="col-sm-9">
                                                  <input type="text" name="source" class="form-control" id="horizontal-firstname-input">
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
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
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
