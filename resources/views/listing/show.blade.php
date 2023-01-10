
@extends('layout.master')

@section('content')
<style>
#panel {

    display: none;
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
                                    <h4 class="mb-sm-0 font-size-18">Listing</h4>



                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{URL('')}}">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Listing</li>
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
                            @if(session()->has('error'))
                            <div class="col-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-alert-outline me-2"></i>
                                    {{ session()->get('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                            @endif
                            <div class="col-12">
                                <div class="card shadow-lg p-2" style="background-color: #fcfcfc; border-radius: 10px;">
                                    <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <a href="" class="btn btn-dark btn-sm waves-effect waves-light me-2">   <i class="fa-solid fa-house"> </i> All ( 509 )</a>
                                                    <a href="" class="btn btn-dark btn-sm waves-effect waves-light me-2">   <i class="fa-solid fa-circle-plus"> </i> Live ( 298 )</a>
                                                    <a href="" class="btn btn-dark btn-sm waves-effect waves-light me-2">   <i class="fa-regular fa-floppy-disk"></i> Draft ( 18 )</a>
                                                    <a href="" class="btn btn-dark btn-sm waves-effect waves-light me-2">   <i class="fa fa-box-archive"></i> Archive ( 266 )</a>
                                                    <a href="" class="btn btn-dark btn-sm waves-effect waves-light me-2">   <i class="fa-regular fa-eye"> </i> Review ( 0 )</a>
                                                    <a>
                                                        <button class="btn btn-warning btn-sm waves-effect waves-light me-2" id="customizeListing" onclick="addNewListing()">
                                                            <i class="fa fa-cog"> </i>&nbsp;
                                                            Customize Listing
                                                        </button>
                                                    </a>
                                                    <a>
                                                        <button class="btn btn-success btn-sm waves-effect waves-light me-2 float-end" id="addListing" onclick="addNewListing()">
                                                            <i class="fa-solid fa-plus"></i>&nbsp;
                                                            Add Listing
                                                        </button>
                                                    </a>

                                                </div>
                                            </div>




                                            <!-- Customize Listing -->
                                            <div id="customizeNewListing" style="display:none;">
                                                <h3 class="card-title mt-4">Customize Listing</h3>
                                                <hr class="border border-warning border-2">
                                                <form method="POST" action="{{url('/listing_customize/store')}}" enctype="multipart/form-data" class="needs-validation">
                                                    @csrf


                                                    <div class="row mt-3">
                                                        <div class="col-lg-3">
                                                            <div class="row mb-3">
                                                                {{-- <label class="col-md-3 form-label text-sm">Add Communities: </label> --}}
                                                                <div class="col-sm-12">
                                                                    <input type="text" name="community" class="form-control form-control-sm" placeholder="Enter a new community">
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-lg-3">
                                                            <div class="row mb-3">
                                                                {{-- <label class="col-md-3 form-label text-sm">Choose Emirate: </label> --}}
                                                                <div class="col-sm-12">
                                                                    <select class="form-select2 form-control-sm w-100" name="emirate">
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
                                                                    <input type="text" name="developer" class="form-control form-control-sm" placeholder="Enter a new developer">
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-lg-2">
                                                            <div class="col-md-12 mx-auto">
                                                                <button type="submit" class="btn btn-sm btn-warning btn-block form-control">Create </button>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </form>

                                                <div class="row mt-3">


                                                    <!-- Community Table -->
                                                    <div class="col-lg-6">
                                                        <div class="card bg-dark text-light shadow-sm" style="height: 200px">
                                                            <h6 class=" px-3 pt-2 text-light">Communities</h6>
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
                                                        <div class="card bg-dark shadow-sm" style="height: 200px">
                                                            <h6 class=" px-3 pt-2 text-light">Developers</h6>
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
                                                    <div class="modal-dialog modal-dialog-centered modal-md">
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





                                            <!-- Search -->
                                            <div id="searchBox" class="row mb-2 relative mt-4">
                                                <div class="col-lg-12">
                                                    <form method="GET" action="{{url('/listing/search')}}" enctype="multipart/form-data" >
                                                        @csrf
                                                        <div class="mb-3 row">
                                                            <label for="example-text-input" class="col-md-1 offset-md-2 col-form-label">Search</label>

                                                            <div class="col-md-6">
                                                                <input class="form-control" name="search" value="" type="text" value="" placeholder="search" id="example-text-input">
                                                                <a id="flip" class="float-end mt-2 fw-bold text-decoration-underline" style="color: #000" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center">
                                                                    <i class="bx bx-search-alt-2"></i>
                                                                    Advance Search
                                                                </a>
                                                            </div>

                                                        </div>
                                                        <div id="panel">
                                                            <div class="row">

                                                                <div class="col-md-2">
                                                                    <div class="mb-3">
                                                                        <label for="ref_number" class="form-label">Ref Number</label>
                                                                        <input type="text" value="" name="ref_number" placeholder="Reference Number" class="form-control" id="ref_number">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="mb-3">
                                                                        <label for="phone" class="form-label">Location</label>
                                                                        <input type="text" value="" name="location" placeholder="Location" class="form-control" id="location">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <div class="mb-3">
                                                                        <label for="lead_source" class="form-label">Property Type</label>
                                                                        <select class="form-select" name="type">
                                                                            <option value="">Select</option>
                                                                            <optgroup label="Residential ">
                                                                                <option value="villa">Villa</option>
                                                                                <option value="apartment">Apartment</option>
                                                                                <option value="residential_floor">Residential Floor</option>
                                                                                <option value="residential_plot">Residential Plot</option>
                                                                                <option value="townhouse">Townhouse</option>
                                                                                <option value="residential_building">Residential Building</option>
                                                                                <option value="penthouse">Penthouse</option>
                                                                                <option value="villa_compound">Villa Compound</option>
                                                                                <option value="hotel_apartment">Hotel Apartment</option>
                                                                            </optgroup>
                                                                            <optgroup label="Commercial">
                                                                                <option value="office">Office</option>
                                                                                <option value="shop">Shop</option>
                                                                                <option value="warehouse">Warehouse</option>
                                                                                <option value="factory">Factory</option>
                                                                                <option value="labour_camp">Labour Camp</option>
                                                                                <option value="commercial_building">Commerial Building</option>
                                                                                <option value="other_commercial">Other Commercial</option>
                                                                                <option value="commercial_floor">Commercial Floor</option>
                                                                                <option value="commercial_plot">Commercial Plot</option>
                                                                                <option value="bulk_units">Bulk Units</option>
                                                                                <option value="industrial_bank">Industrial Land</option>
                                                                                <option value="mixed_used_land">Mixed Use Land</option>
                                                                                <option value="showroom">Showroom</option>
                                                                                <option value="commercial_villa">Commercial Villa</option>
                                                                            </optgroup>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="mb-3">
                                                                        <label for="lead_source" class="form-label">Beds</label>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <select class="form-select" name="bed_min">
                                                                                    <option value="">Min</option>
                                                                                    <option value="Studio">Studio</option>
                                                                                    <option value="1">1</option>
                                                                                    <option value="2">2</option>
                                                                                    <option value="3">3</option>
                                                                                    <option value="4">4</option>
                                                                                    <option value="5">5</option>
                                                                                    <option value="6">6</option>
                                                                                    <option value="7">7</option>
                                                                                    <option value="8">8</option>
                                                                                    <option value="1">9</option>
                                                                                    <option value="10">10</option>
                                                                                    <option value="11">11</option>
                                                                                    <option value="12">12</option>
                                                                                    <option value="13">13</option>
                                                                                    <option value="14">14</option>
                                                                                    <option value="15">15</option>
                                                                                    <option value="16">16</option>
                                                                                    <option value="17">17</option>
                                                                                    <option value="18">18</option>
                                                                                    <option value="19">19</option>
                                                                                    <option value="20">20+</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <select class="form-select" name="bed_max">
                                                                                    <option value="">Max</option>
                                                                                    <option value="Studio">Studio</option>
                                                                                    <option value="1">1</option>
                                                                                    <option value="2">2</option>
                                                                                    <option value="3">3</option>
                                                                                    <option value="4">4</option>
                                                                                    <option value="5">5</option>
                                                                                    <option value="6">6</option>
                                                                                    <option value="7">7</option>
                                                                                    <option value="8">8</option>
                                                                                    <option value="1">9</option>
                                                                                    <option value="10">10</option>
                                                                                    <option value="11">11</option>
                                                                                    <option value="12">12</option>
                                                                                    <option value="13">13</option>
                                                                                    <option value="14">14</option>
                                                                                    <option value="15">15</option>
                                                                                    <option value="16">16</option>
                                                                                    <option value="17">17</option>
                                                                                    <option value="18">18</option>
                                                                                    <option value="19">19</option>
                                                                                    <option value="20">20+</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="mb-3">
                                                                        <label for="lead_source" class="form-label">Frequency</label>
                                                                        <select class="form-select" name="frequency">
                                                                            <option value="">Select Frequency</option>
                                                                            {{-- @if ($campaigns)
                                                                                @foreach ($campaigns as $campaign)
                                                                                    <option value=""></option>
                                                                                @endforeach
                                                                            @endif --}}
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="mb-3">
                                                                        <label for="agent" class="form-label">Agent</label>
                                                                        <select class="form-select" name="agent">
                                                                            <option value="">Select Agent</option>
                                                                            @if ($agents)
                                                                                @foreach ($agents as $agent)
                                                                                    <option value="{{$agent->id}}">{{ $agent->name }}</option>
                                                                                @endforeach
                                                                            @endif

                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                {{--
                                                                <div class="col-md-2">
                                                                    <div class="mb-3">
                                                                        <label for="start-date-input" class="form-label">Start Date</label>
                                                                        <input class="form-control" name="start_date" type="date" value="" id="example-date-input" placeholder="Start Date">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="mb-3">
                                                                        <label for="end-date-input" class="form-label">End Date</label>
                                                                        <input class="form-control" name="end_date" type="date" value="" id="example-date-input" placeholder="End Date">
                                                                    </div>
                                                                </div> --}}

                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 offset-md-3">
                                                                <button type="submit" class="btn btn-dark btn-sm w-100">Search</button>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                            <!-- /Search -->






                                            <!-- Add New Listing Hidden Form: on-click show -->
                                            <div id="addNewListing" style="display: show">
                                                <h4 class="card-title mt-4">Add Listing</h4>
                                                <hr class="border border-success border-2">
                                                @include('listing.show_includes.show_add_listing')
                                            </div>
                                            <!-- /Add New Listing Form -->





                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->



                        <!-- Listings table -->
                        <div class="row">
                            @include('listing.show_includes.show_listing_table')
                        </div>
                        <!-- Listings table -->


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

                <script type="text/javascript">
                    var button = document.getElementById('addListing');

                    button.onclick = function() {
                        var x = document.getElementById("addNewListing");
                        var y = document.getElementById("searchBox");
                        var z = document.getElementById("customizeNewListing");
                        if (x.style.display === "none") {
                            x.style.display = "block";
                            y.style.display = "none";
                            z.style.display = "none";

                        } else {
                            x.style.display = "none";
                            y.style.display = "block";
                            z.style.display = "none";
                        }
                    }


                    var button2 = document.getElementById('customizeListing');
                    button2.onclick = function() {
                        var x = document.getElementById("customizeNewListing");
                        var y = document.getElementById("searchBox");
                        var z = document.getElementById("addNewListing");
                        if (x.style.display === "none") {
                            x.style.display = "block";
                            y.style.display = "none";
                            z.style.display = "none";
                        } else {
                            x.style.display = "none";
                            y.style.display = "block";
                            z.style.display = "none";
                        }
                    }

                    $(document).ready(function(){
                        $("#flipnow").click(function(){
                            $("#panelnow").slideToggle("slow");
                        });
                    });


                    $().DataTable();
                </script>
            </div>
            <!-- end main content-->


@endsection


