@extends('layout.master')

@section('content')
<style>
    @page { size: auto;  margin: 5mm; }
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
                                    <h4 class="mb-sm-0 font-size-18">Edit Leader User</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{URL('')}}">Home</a></li>
                                            <li class="breadcrumb-item"><a href="{{URL('/leader_board')}}">Leaderboard</a></li>
                                            <li class="breadcrumb-item active">Edit Leader User</li>
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
                                        <h4 class="card-title mb-4">Leader Details</h4>
                                        @if(session()->has('message'))
                                        <div class="col-12">
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <i class="mdi mdi-check-all me-2"></i>
                                                {{ session()->get('message') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="d-print-none">
                                            <h4 class="card-title mb-4"> Update Leader Detail</h4>
                                           <form method="POST" action="{{url('/leader_board/detail/update_leader/'.$user_id)}}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row mb-4">
                                                    <label class="col-sm-3 col-form-label">Full Name</label>
                                                    <div class="col-sm-9">

                                                        <input class="form-control" value="{{$leader_board->name}}" name="name" type="text"  id="example-text-input" placeholder="{{$leader_board->name}}">

                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label class="col-sm-3 col-form-label">Email</label>
                                                    <div class="col-sm-9">

                                                        <input class="form-control" name="email" value="{{$leader_board->email}}"  type="text"  id="example-text-input" placeholder="{{$leader_board->email}}">

                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label class="col-sm-3 col-form-label">Office</label>
                                                    <div class="col-sm-9">

                                                        <input class="form-control" name="office" value="{{$leader_board->office}}"  type="text"  id="example-text-input" required placeholder="{{$leader_board->office}}">

                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Image</label>
                                                    <div class="col-sm-9">

                                                            <input class="form-control" name="agent_image" type="file" id="formFile">
                                                            <p>*only files with .jpg extensions will be allowed</p><br>
                                                            <img class="rounded-circle avatar-lg" src="{{URL::asset('public/assets/images/users/'.$leader_board->image)}}" alt="">


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

                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->


                            </div>
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
