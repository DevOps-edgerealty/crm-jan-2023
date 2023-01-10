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
                                    <h4 class="mb-sm-0 font-size-18">Edit Protal Lisitng Lead</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{URL('')}}">Home</a></li>
                                            <li class="breadcrumb-item"><a href="{{URL('/property_listing')}}">Property Portal Leads</a></li>
                                            <li class="breadcrumb-item active">Edit Protal Lisitng Lead</li>
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
                                        <h4 class="card-title mb-4">Edit Portal Lisitng Lead</h4>

                                        <form method="POST" action="{{url('property_listing_leads/update/'.$leads->id)}}" enctype="multipart/form-data">
                                            @csrf


                                            @if (Auth::user()->user_type == 1)
                                            <div class="row mb-4">
                                                <label class="col-md-3 col-form-label">Status</label>
                                                <div class="col-md-9">
                                                    <select name="status" class="form-select" required>
                                                        <option value="">Select</option>
                                                        <option {{ ($leads->status) == '1' ? 'selected' : '' }} value="1">Active</option>
                                                        <option {{ ($leads->status) == '2' ? 'selected' : '' }} value="2">Deative</option>




                                                    </select>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="row mb-4">
                                                <label class="col-md-3 col-form-label">Property Portal</label>
                                                <div class="col-md-9">
                                                    <select name="property_portal_id" class="form-select" required>
                                                        <option value="">Select</option>

                                                        @foreach ($property_portals as $property_portal)
                                                            <option  {{ $property_portal->email == $leads->from ? 'selected' : '' }} value="{{$property_portal->email}}"> {{$property_portal->portal_name}} </option>
                                                        @endforeach


                                                    </select>
                                                </div>
                                            </div>

                                            @if (Auth::user()->user_type == 1)
                                                <div class="row mb-4">
                                                    <label class="col-md-3 col-form-label">Select Agent</label>
                                                    <div class="col-md-9">
                                                        <select name="agent" class="form-select" required>
                                                            <option value="">Select</option>
                                                            @foreach ($user as $users)
                                                                <option {{ $users->id == $leads->agent_id ? 'selected' : '' }} value="{{$users->id}}"> {{$users->name}} </option>
                                                            @endforeach


                                                        </select>
                                                    </div>
                                                </div>
                                            @else
                                                <input type="hidden" name="agent" value="{{Auth::user()->id}}">
                                            @endif



                                            <div class="row mb-4">
                                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Inquiry</label>
                                                <div class="col-sm-9">
                                                  <input type="text" value="{{$leads->inquiry}}" name="inquiry" class="form-control" id="horizontal-firstname-input" required>
                                                </div>
                                            </div>


                                            <div class="row mb-4">
                                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Full Name</label>
                                                <div class="col-sm-9">
                                                  <input type="text" value="{{$leads->name}}" name="full_name" class="form-control" id="horizontal-firstname-input" required>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="email" value="{{$leads->email}}" name="email" class="form-control" id="horizontal-email-input" required>
                                                </div>
                                            </div>
                                            @if (Auth::user()->user_type == 2)
                                                <div class="row mb-4">
                                                    <label for="horizontal-password-input" class="col-sm-3 col-form-label">Phone</label>
                                                    <div class="col-sm-9">
                                                    <input type="phone" value="{{$leads->phone}}" name="phone_disable" class="form-control" id="horizontal-password-input" disabled>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="phone" value="{{$leads->phone}}">

                                            @else
                                                <div class="row mb-4">
                                                    <label for="horizontal-password-input" class="col-sm-3 col-form-label">Phone</label>
                                                    <div class="col-sm-9">
                                                    <input type="phone" value="{{$leads->phone}}" name="phone" class="form-control" id="horizontal-password-input" required>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="row mb-4">
                                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">Location</label>
                                                <div class="col-sm-9">
                                                  <input type="location" value="{{$leads->location}}" name="location" class="form-control" id="horizontal-password-input" required>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">Property Detail</label>
                                                <div class="col-sm-9">
                                                  <input type="property_detail" value="{{$leads->property_detail}}" name="property_detail" class="form-control" id="horizontal-password-input" required>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">Property Location</label>
                                                <div class="col-sm-9">
                                                  <input type="property_location" value="{{$leads->property_location}}" name="property_location" class="form-control" id="horizontal-password-input" required>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">Refrence Number</label>
                                                <div class="col-sm-9">
                                                  <input type="property_ref_no" value="{{$leads->property_ref}}" name="property_ref_no" class="form-control" id="horizontal-password-input" required>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">Property ID</label>
                                                <div class="col-sm-9">
                                                  <input type="property_id" value="{{$leads->property_id}}" name="property_id" class="form-control" id="horizontal-password-input">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">Property URL</label>
                                                <div class="col-sm-9">
                                                  <input type="property_url" value="{{$leads->property_url}}" name="property_url" class="form-control" id="horizontal-password-input">
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
