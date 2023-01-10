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
                                    <h4 class="mb-sm-0 font-size-18">Create Leader User</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{URL('')}}">Home</a></li>
                                            <li class="breadcrumb-item"><a href="{{URL('/leader_board')}}">Leaderboard</a></li>
                                            <li class="breadcrumb-item active">Create Leader User</li>
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
                                        <h4 class="card-title mb-4">Leaderboard</h4>

                                        <form method="POST" action="{{url('leader_board/store')}}" enctype="multipart/form-data">
                                            @csrf


                                            <div class="row mb-4">
                                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Select Agent</label>
                                                <div class="col-sm-9">
                                                    <select class="form-select w-100" name="agent" required>
                                                        <option value="">Select an agent</option>
                                                            @if ($agents!=null)
                                                                @foreach ($agents as $agent)
                                                                    <option value="{{ $agent->id}}">{{ $agent->name }}</option>
                                                                @endforeach
                                                            @endif
                                                    </select>
                                                    <div class="mt-2">
                                                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                                                    </div>

                                                </div>
                                            </div>

                                            {{-- <div class="row mb-4">
                                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                  <input type="email" name="email" class="form-control" placeholder="Enter Email Address" id="horizontal-firstname-input">
                                                </div>
                                            </div> --}}

                                            {{-- <div class="row mb-4">
                                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label"> Image</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" name="agent_image" type="file" id="formFile">
                                                    <div class="mt-2">
                                                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                                                    </div>
                                                </div>
                                            </div> --}}
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
