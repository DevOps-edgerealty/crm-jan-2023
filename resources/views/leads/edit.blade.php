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
                                    <h4 class="mb-sm-0 font-size-18">Edit Lead</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{URL('')}}">Home</a></li>
                                            <li class="breadcrumb-item"><a href="{{URL('/leads')}}">Leads</a></li>
                                            <li class="breadcrumb-item active">Edit Lead</li>
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
                                        <h4 class="card-title mb-4">Edit Lead</h4>

                                        <form method="POST" action="{{url('leads/update/'.$leads->id)}}" enctype="multipart/form-data">
                                            @csrf

                                            <div class="row mb-4">
                                                <label class="col-md-3 col-form-label">Status</label>
                                                <div class="col-md-9">
                                                    <select name="status" class="form-select" required>
                                                        <option value="">Select</option>
                                                        <option {{ ($leads->status) == '1' ? 'selected' : '' }}   value="1">Active</option>
                                                        <option {{ ($leads->status) == '2' ? 'selected' : '' }}   value="2">Deative</option>




                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label class="col-md-3 col-form-label">Select Campaign</label>
                                                <div class="col-md-9">
                                                    <select name="campaign_id" class="form-select" required>
                                                        <option value="">Select</option>
                                                        @foreach ($campagin as $campagins)
                                                            <option {{ $campagins->id == $leads->campaign_id ? 'selected' : '' }} value="{{$campagins->id}}"> {{$campagins->campaign_name}} </option>
                                                        @endforeach


                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label class="col-md-3 col-form-label">Select Lead Type</label>
                                                <div class="col-md-9">
                                                    <select name="lead_type" class="form-select" required>
                                                        <option value="">Select</option>
                                                        @foreach ($lead_type as $lead_types)
                                                            <option {{ $lead_types->id == $leads->lead_type ? 'selected' : '' }} value="{{$lead_types->id}}"> {{$lead_types->type_name}} </option>
                                                        @endforeach


                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label class="col-md-3 col-form-label">Select Agent</label>
                                                <div class="col-md-9">
                                                    <select name="agent_id" class="form-select" required>
                                                        <option value="">Select</option>
                                                        @foreach ($user as $users)
                                                            <option {{ $users->id == $leads->agent_id ? 'selected' : '' }}  value="{{$users->id}}"> {{$users->name}} </option>
                                                        @endforeach


                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Inquiry</label>
                                                <div class="col-sm-9">
                                                  <input type="text" name="inquiry" value="{{$leads->inquiry}}" class="form-control" id="horizontal-firstname-input">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Qualified Question</label>
                                                <div class="col-sm-9">
                                                  <input type="text" name="qualified_ques" value="{{$leads->qualified_question}}" class="form-control" id="horizontal-firstname-input">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Source</label>
                                                <div class="col-sm-9">
                                                  <input type="text" name="source" value="{{$leads->source}}" class="form-control" id="horizontal-firstname-input">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Full Name</label>
                                                <div class="col-sm-9">
                                                  <input type="text" name="full_name" value="{{$leads->full_name}}" class="form-control" id="horizontal-firstname-input">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="email" name="email" value="{{$leads->email}}" class="form-control" id="horizontal-email-input">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">Phone</label>
                                                <div class="col-sm-9">
                                                  <input type="phone" name="phone" value="{{$leads->phone}}" class="form-control" id="horizontal-password-input">
                                                </div>
                                            </div>

                                            <div class="row justify-content-end">
                                                <div class="col-sm-9">

                                                    <div>
                                                        <button type="submit" class="btn btn-primary w-md">Update</button>
                                                        <a href="{{URL('leads')}}" class="btn btn-danger w-md">Cancel</a>
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
