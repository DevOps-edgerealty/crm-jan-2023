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
                                    <h4 class="mb-sm-0 font-size-18 text-capitalize">Create Property Portal Lead</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{URL('')}}">Home</a></li>
                                            <li class="breadcrumb-item"><a href="{{URL('/leads')}}">Leads</a></li>
                                            <li class="breadcrumb-item active">Create Property Portal Lead</li>
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
                                        <h4 class="card-title mb-4">Lead</h4>

                                        <form method="POST" action="{{url('property_listing/store')}}" enctype="multipart/form-data">
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
                                                <label class="col-md-3 col-form-label">Property Portal</label>
                                                <div class="col-md-9">
                                                    <select name="property_portal_id" class="form-select" required>
                                                        <option value="">Select</option>
                                                        @foreach ($property_portals as $property_portal)
                                                            <option value="{{$property_portal->email}}"> {{$property_portal->portal_name}} </option>
                                                        @endforeach


                                                    </select>
                                                </div>
                                            </div>
                                            @if (Auth::user()->user_type == 2)
                                                 <input type="hidden"  name="agent" value="{{Auth::user()->id}}">
                                            @else
                                                <div class="row mb-4">
                                                    <label class="col-md-3 col-form-label">Select Agent</label>
                                                    <div class="col-md-9">
                                                        <select name="agent" class="form-select" required>
                                                            <option value="">Select</option>
                                                            @foreach ($user as $users)
                                                                <option value="{{$users->id}}"> {{$users->name}} </option>
                                                            @endforeach


                                                        </select>
                                                    </div>
                                                </div>

                                            @endif



                                            <div class="row mb-4">
                                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Inquiry</label>
                                                <div class="col-sm-9">
                                                  <input type="text" name="inquiry" class="form-control" id="horizontal-firstname-input" placeholder="ex: WhatsApp / Email" required>
                                                </div>
                                            </div>


                                            <div class="row mb-4">
                                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Full Name</label>
                                                <div class="col-sm-9">
                                                  <input type="text" name="full_name" class="form-control" id="horizontal-firstname-input" placeholder="Name of Customer" required>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="email" name="email" class="form-control" id="horizontal-email-input" placeholder="ex: someone@edgerealty.ae" required>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">Phone</label>
                                                <div class="col-sm-9">
                                                  <input type="phone" name="phone" class="form-control" id="horizontal-password-input" placeholder="ex: +971 50 123 4567" required>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">Location</label>
                                                <div class="col-sm-9">
                                                  <input type="location" name="location" class="form-control" id="horizontal-password-input" placeholder="Address" required>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">Property Detail</label>
                                                <div class="col-sm-9">
                                                  <input type="property_detail" name="property_detail" class="form-control" id="horizontal-password-input" placeholder="ex: Semi-Furnished, 3BR Duplex, etc." required>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">Property Location</label>
                                                <div class="col-sm-9">
                                                  <input type="property_location" name="property_location" class="form-control" id="horizontal-password-input" placeholder="ex: Binghatti Views, Silicon Oasis, Dubai" required>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">Refrence Number</label>
                                                <div class="col-sm-9">
                                                  <input type="property_ref_no" name="property_ref_no" class="form-control" id="horizontal-password-input"  required>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">Property ID</label>
                                                <div class="col-sm-9">
                                                  <input type="property_id" name="property_id" class="form-control" id="horizontal-password-input">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">Property URL</label>
                                                <div class="col-sm-9">
                                                  <input type="property_url" name="property_url" class="form-control" id="horizontal-password-input">
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
