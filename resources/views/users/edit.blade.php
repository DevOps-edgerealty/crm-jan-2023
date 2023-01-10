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
                                    <h4 class="mb-sm-0 font-size-18">Edit User</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{URL('')}}">Home</a></li>
                                            <li class="breadcrumb-item"><a href="{{URL('/Users')}}">User</a></li>
                                            <li class="breadcrumb-item active">Edit User</li>
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
                                        <h4 class="card-title mb-4">User</h4>

                                        <form method="POST" action="{{url('users/update/'.$Users->id)}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mb-4">
                                                <label class="col-md-3 col-form-label">Status</label>
                                                <div class="col-md-9">
                                                    <select name="status" class="form-select" required>
                                                        <option value="">Select</option>
                                                        <option {{ ($Users->status) == '1' ? 'selected' : '' }} value="1">Active</option>
                                                        <option {{ ($Users->status) == '2' ? 'selected' : '' }} value="2">Deative</option>



                                                    </select>
                                                </div>
                                            </div>


                                            <div class="row mb-4">
                                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Full Name</label>
                                                <div class="col-sm-9">
                                                  <input type="text" value="{{$Users->name}}" name="name" class="form-control" placeholder="Enter Full Name" id="horizontal-firstname-input">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Position</label>
                                                <div class="col-sm-9">
                                                  <input type="text" name="position" value="{{$Users->position}}" class="form-control" placeholder="Enter Agent Position" id="horizontal-firstname-input">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                  <input type="email" value="{{$Users->email}}" name="email" class="form-control" placeholder="Enter Email Address" id="horizontal-firstname-input">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Phone</label>
                                                <div class="col-sm-9">
                                                  <input type="phone" value="{{$Users->phone}}" name="phone" class="form-control" placeholder="Enter Phone Number" id="horizontal-firstname-input">
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Agent Image</label>
                                                <div class="col-sm-9">


                                                        <input class="form-control" value="{{$Users->image}}" name="agent_image" type="file" id="formFile">

                                                </div>

                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Image</label>
                                                <div class="col-sm-9">
                                                  <img src="{{URL::asset('public/assets/images/users/'.$Users->image)}}" alt="">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Change Password</label>
                                                <div class="col-sm-9">
                                                    <div class="input-group auth-pass-inputgroup">

                                                        <input id="password" type="password" class="form-control" name="password"  autocomplete="current-password" placeholder="Enter Password" aria-label="Password" aria-describedby="password-addon" >
                                                        <button class="btn btn-light "  type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                    </div>

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
