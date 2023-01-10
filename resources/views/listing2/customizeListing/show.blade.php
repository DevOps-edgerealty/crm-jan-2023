
@extends('layout.master')

@section('content')
<style>
#panel {

    display: none;
    }

.modal-content {
  width:100%;
}

.modal-dialog-centered {
  display:-webkit-box;
  display:-ms-flexbox;
  display:flex;
  -webkit-box-align:center;
  -ms-flex-align:center;
  align-items:center;
  min-height:calc(100% - (.5rem * 2));
}

@media (min-width: 576px) {
  .modal-dialog-centered {
    min-height:calc(100% - (1.75rem * 2));
  }
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
                        <h4 class="mb-sm-0 font-size-18">Customize Listing Settings</h4>



                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{URL('listings')}}">Listings</a></li>
                                <li class="breadcrumb-item active">Customize Listing Settings</li>
                            </ol>
                        </div>

                    </div>

                    @if(session()->has('message'))
                    <div class="col-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-check-all me-2"></i>
                            {{ session()->get('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif
                    @if(session()->has('error'))
                    <div class="col-12">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-alert-outline me-2"></i>
                            {{ session()->get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <!-- end page title -->





            {{-- Add New Listing Wizard --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h4 class="card-title mb-4">Basic Wizard</h4> --}}

                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active d-flex justify-content-start py-3 text-dark " style="width: 350px;"  data-bs-toggle="tab" data-bs-target="#nav-pf" type="button" role="tab" aria-controls="nav-pf" aria-selected="true" >
                                        <span class="font-size-16 fw-bold">Property Finder</span>
                                    </button>


                                    <button class="nav-link d-flex justify-content-start py-3 text-dark  " style="width: 200px;" data-bs-toggle="tab" data-bs-target="#nav-bayut" type="button" role="tab" aria-controls="nav-bayut" aria-selected="true" >
                                        <span class="font-size-16 fw-bold">Bayut</span>
                                    </button>
                                </div>
                            </nav>


                            {{-- Page 01 - Information --}}
                            <div class="tab-content" id="nav-tabContent">


                                {{-- property finder Tab --}}
                                <div class="tab-pane fade show active" id="nav-pf" role="tabpanel" aria-labelledby="nav-pf-tab">

                                    <section id="basic-example-p-0" role="tabpanel" aria-labelledby="basic-example-h-0" class="body current" aria-hidden="false">



                                        {{-- Category & Property Type--}}
                                        @include('listing2.customizeListing.property_finder.category')
                                        {{-- Category & Property Type --}}



                                        {{-- community --}}
                                        @include('listing2.customizeListing.property_finder.location')
                                        {{-- community --}}


                                    </section>
                                </div>
                                {{-- property finder Tab --}}








                                {{-- Bayut Tab --}}
                                <div class="tab-pane fade" id="nav-bayut" role="tabpanel" aria-labelledby="nav-bayut-tab">

                                    {{-- <h3 id="basic-example-h-0" tabindex="-1" class="title current pt-4">Bayut</h3> --}}
                                    <section id="basic-example-p-0" role="tabpanel" aria-labelledby="basic-example-h-1" class="body current" aria-hidden="false">

                                        <div class="row">
                                            <!-- Customize Listing -->
                                            <div id="customizeNewListing" style="display:block;">
                                                <h3 class="card-title mt-4">Communities and Developers</h3>
                                                <form method="POST" action="{{url('/listing_customize/store')}}" enctype="multipart/form-data" class="needs-validation">
                                                    @csrf

                                                    <div class="row mt-3">
                                                        <div class="col-lg-3">
                                                            <div class="row mb-3">
                                                                {{-- <label class="col-md-3 form-label text-sm">Add Communities: </label> --}}
                                                                <div class="col-sm-12">
                                                                    <input type="text" name="community" class="form-control" placeholder="Enter a community name">
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-lg-3">
                                                            <div class="row mb-3">
                                                                {{-- <label class="col-md-3 form-label text-sm">Choose Emirate: </label> --}}
                                                                <div class="col-sm-12">
                                                                    <select class="form-select w-100" name="emirate">
                                                                        <option value="">Select Emirate</option>
                                                                        @if ($emirates)
                                                                            @foreach ($emirates as $emirate)
                                                                                <option value="{{ $emirate->id}}">{{ $emirate->name }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-lg-3">
                                                            <div class="row mb-3">
                                                                {{-- <label class="col-md-3 form-label">Add Developers: </label> --}}
                                                                <div class="col-sm-12">
                                                                    <input type="text" name="developer" class="form-control" placeholder="Enter a developer name">
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-lg-2">
                                                            <div class="col-md-12 mx-auto">
                                                                <button type="submit" class="btn btn-dark btn-block form-control">Create </button>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </form>

                                                <div class="row mt-3">


                                                    <!-- Community Table -->
                                                    <div class="col-lg-6">
                                                        <div class="card text-dark shadow-sm" style="height: 200px">
                                                            <h6 class=" px-3 pt-2 text-dark">Communities</h6>
                                                            <div class="table-responsive border border-top-3 bg-white">
                                                                <table class="table table-sm m-0 " height="20px">
                                                                    {{-- <thead class="bg-dark text-light">
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Community Name</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead> --}}
                                                                    <tbody>
                                                                        @if(!$communities->isEmpty())
                                                                            @foreach ($communities as $community)

                                                                                <tr>

                                                                                    <th scope="row">{{ $community->id }}</th>
                                                                                    <td>{{ $community->name }}</td>
                                                                                    <td class="text-center">
                                                                                        <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $community->id }}">
                                                                                            <button class="btn btn-outline-dark btn-sm">Edit</button>
                                                                                        </a>
                                                                                        &nbsp;&nbsp;/&nbsp;&nbsp;
                                                                                        <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-delete-xl-{{ $community->id }}">
                                                                                            <button class="btn btn-outline-danger btn-sm">Delete</button>
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        @else
                                                                            <p>No records</p>
                                                                        @endif
                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Community Table -->





                                                    <!-- Developers Table -->
                                                    <div class="col-lg-6">
                                                        <div class="card shadow-sm" style="height: 200px">
                                                            <h6 class=" px-3 pt-2 text-dark">Developers</h6>
                                                            <div class="table-responsive border border-top-3 bg-white">
                                                                <table class="table table-sm m-0" height="20px">
                                                                    {{-- <thead class="bg-dark text-light">
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Developer Name</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead> --}}
                                                                    <tbody>
                                                                        @if(!$developers->isEmpty())
                                                                            @foreach ($developers as $developer)

                                                                                <tr>

                                                                                    <th scope="row">{{ $developer->id }}</th>
                                                                                    <td>{{ $developer->name }}</td>
                                                                                    <td>
                                                                                        <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal2-xl-{{ $developer->id }}">
                                                                                            <button class="btn btn-outline-dark btn-sm">Edit</button>
                                                                                        </a>
                                                                                        &nbsp;&nbsp;/&nbsp;&nbsp;
                                                                                        <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal2-delete-xl-{{ $developer->id }}">
                                                                                            <button class="btn btn-outline-danger btn-sm">Delete</button>
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        @else
                                                                        <tr>
                                                                            <td><p class="text-center my-auto text-secondary">no record exists</p></td>
                                                                        </tr>
                                                                        @endif
                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Developers Table -->

                                                </div>
                                            </div>
                                            <!-- /Customize Listing -->




                                            <!-- Community Update Modal -->
                                            @foreach ($communities as $community)

                                                <div class="modal fade bs-example-modal-xl-{{ $community->id }}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-top modal-md">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Community Detail</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="table-rep-plugin mb-3">

                                                                            <form action="{{url('/listing_community/update/'.$community->id)}}" method="POST" enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                                                    <table id="tech-companies-1" class="table">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <th scope="row">Refrence ID :</th>
                                                                                                <td><input type="text" name="community_id" value="{{$community->id}}" class="form-control" id="horizontal-firstname-input" disabled></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th scope="row">Developer Name :</th>
                                                                                                <td><input type="text" name="community" value="{{$community->name}}" class="form-control" id="horizontal-firstname-input">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th scope="row"></th>
                                                                                                <td>
                                                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
                                                                                                        Cancel
                                                                                                    </button>&nbsp;
                                                                                                    <button type="submit" class="btn btn-warning ">
                                                                                                        Update
                                                                                                    </button>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->

                                            @endforeach
                                            <!-- /Community Update Modal -->



                                            <!-- Community Delete Modal -->
                                            @foreach ($communities as $community)

                                                <div class="modal fade bs-example-modal-delete-xl-{{ $community->id }}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Are you sure to delete this record?</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="table-rep-plugin mb-3">

                                                                            <form action="{{url('/listing_community/delete/'.$community->id)}}" method="POST" enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                                                    <table id="tech-companies-1" class="table">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <th scope="row">Refrence ID :</th>
                                                                                                <td><input type="text" name="community_id" value="{{$community->id}}" class="form-control" id="horizontal-firstname-input" disabled></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th scope="row">Developer Name :</th>
                                                                                                <td><input type="text" name="community" value="{{$community->name}}" class="form-control" id="horizontal-firstname-input" disabled>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th scope="row"></th>
                                                                                                <td>
                                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                                                                                        Cancel
                                                                                                    </button>&nbsp;
                                                                                                    <button type="submit" class="btn btn-danger ">
                                                                                                        Yes, delete
                                                                                                    </button>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->

                                            @endforeach
                                            <!-- /Community Delete Modal -->




                                            <!-- Developer Modal -->
                                            @foreach ($developers as $developer)

                                                <div class="modal fade bs-example-modal2-xl-{{ $developer->id }}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Developer Detail</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="table-rep-plugin mb-3">

                                                                            <form action="{{url('/listing_developer/update/'.$developer->id)}}" method="POST" enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                                                    <table id="tech-companies-1" class="table">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <th scope="row">Refrence ID :</th>
                                                                                                <td><input type="text" name="developer_id" value="{{$developer->id}}" class="form-control" id="horizontal-firstname-input" disabled></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th scope="row">Developer Name :</th>
                                                                                            <td>
                                                                                                <input type="text" name="developer" value="{{$developer->name}}" class="form-control" id="horizontal-firstname-input">
                                                                                            </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th scope="row"></th>
                                                                                                <td>
                                                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
                                                                                                        Cancel
                                                                                                    </button>&nbsp;
                                                                                                    <button type="submit" class="btn btn-warning ">
                                                                                                        Update
                                                                                                    </button>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->

                                            @endforeach
                                            <!-- /Developer Modal -->



                                            <!-- Developer Delete Modal -->
                                            @foreach ($developers as $developer)

                                                <div class="modal fade bs-example-modal2-delete-xl-{{ $developer->id }}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Are you sure to delete this record?</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="table-rep-plugin mb-3">

                                                                            <form action="{{url('/listing_developer/delete/'.$developer->id)}}" method="POST" enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                                                    <table id="tech-companies-1" class="table">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <th scope="row">Refrence ID :</th>
                                                                                                <td><input type="text" name="developer_id" value="{{$developer->id}}" class="form-control" id="horizontal-firstname-input" disabled></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th scope="row">Developer Name :</th>
                                                                                                <td><input type="text" name="developer" value="{{$developer->name}}" class="form-control" id="horizontal-firstname-input" disabled>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th scope="row"></th>
                                                                                                <td>
                                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                                                                                        Cancel
                                                                                                    </button>&nbsp;
                                                                                                    <button type="submit" class="btn btn-danger ">
                                                                                                        Yes, delete
                                                                                                    </button>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->

                                            @endforeach
                                            <!-- /Developer Delete Modal -->
                                        </div>

                                    </section>

                                </div>
                                {{-- Bayut Tab --}}


                            </div>

                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            {{-- Add New Listing Wizard --}}





        </div>
    </div>
</div>




@endsection
