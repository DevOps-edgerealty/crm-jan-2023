
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
                        <h2 class="mb-sm-0 font-size-25 text-center">Create a New Listing</h2>



                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{URL('listings')}}">Listings</a></li>
                                <li class="breadcrumb-item active">Add Listing</li>
                            </ol>
                        </div>

                    </div>
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
                                    <button class="nav-link d-flex justify-content-start text-dark py-3" style="width: 300px;" id="nav-common-tab" data-bs-toggle="tooltip" data-bs-placement="top" title="Click next to continue">
                                        <span class="font-size-14">Page 01 - Information</span>
                                    </button>

                                    <button class="nav-link d-flex justify-content-start py-3 text-dark " style="width: 350px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Click next to continue" >
                                        <span class="font-size-14">Page 02 - Documents & other media</span>
                                    </button>


                                    <button class="nav-link  d-flex justify-content-start py-3 text-dark  " style="width: 200px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Click next to continue">
                                        <span class="font-size-14">Page 03 - Bayut</span>
                                    </button>


                                    <button class="nav-link active d-flex justify-content-start py-3 text-dark  " style="width: 250px;"  data-bs-toggle="tab" data-bs-target="#nav-common" type="button" role="tab" aria-controls="nav-common" aria-selected="true">
                                        <span class="font-size-14">Page 04 - Property Finder</span>
                                    </button>
                                </div>


                            </nav>


                            {{-- Page 01 - Information --}}
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-common" role="tabpanel" aria-labelledby="nav-common-tab">

                                    <h3 id="basic-example-h-0" tabindex="-1" class="title current pt-4">Property Finder Listing Information</h3>
                                    <section id="basic-example-p-0" role="tabpanel" aria-labelledby="basic-example-h-0" class="body current" aria-hidden="false">


                                        <form method="POST" action="{{url('/listing/store')}}" enctype="multipart/form-data" class="needs-validation">
                                            {{-- <form method="POST" action="{{url('/listing/store')}}" enctype="multipart/form-data" class="needs-validation"> --}}
                                            @csrf
                                            <div class="row mt-5">
                                                <div class="col-lg-4">
                                                    <h6 class="mb-3">Location & Price</h6>
                                                    <div class="row mb-3">
                                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Location</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="location" value="" class="form-control " placeholder="Type location... ">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-md-3 form-label">Emirates:<span class="text-danger">*</span></label>
                                                        <div class="col-md-9">
                                                            <select class="form-select w-100" name="emirates" required>
                                                                <option value="">Select an Emirate</option>
                                                                @if ($emirates)
                                                                    @foreach ($emirates as $emirate)
                                                                        <option value="{{ $emirate->id}}">{{ $emirate->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="row mb-3">

                                                        <label class="col-md-3 form-label">Community:<span class="text-danger">*</span></label>
                                                        <div class="col-md-9">
                                                            <select class="form-select w-100" name="community" required>
                                                                <option value="">Select Emirates First</option>
                                                                @if ($communities)
                                                                    @foreach ($communities as $community)
                                                                        <option value="{{ $community->id}}">{{ $community->name }}</option>
                                                                    @endforeach
                                                                @endif


                                                            </select>
                                                        </div>

                                                    </div>

                                                    <div class="row mb-3">

                                                        <label class="col-md-3 form-label">Sub-Community:<span class="text-danger">*</span></label>
                                                        <div class="col-md-9">
                                                            <select class="form-select w-100" name="community" required>
                                                                <option value="">Select Emirates First</option>
                                                                @if ($communities)
                                                                    @foreach ($communities as $community)
                                                                        <option value="{{ $community->id}}">{{ $community->name }}</option>
                                                                    @endforeach
                                                                @endif


                                                            </select>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="col-lg-4">
                                                    <h6>Listing Details</h6>

                                                    <div class="row mb-3">

                                                        <label class="col-md-3 form-label">Select a category:</label>
                                                        <div class="col-md-9">
                                                            <select class="form-select w-100" name="developer">
                                                                <option>Please select</option>
                                                                @if ($categories)
                                                                    @foreach ($categories as $category)
                                                                        <option value="{{ $category->id}}">{{ $category->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="col-lg-4">
                                                    <h6>Associations</h6>

                                                    <div class="row mb-3">
                                                        <label class="col-md-3 form-label">LSM:</label>
                                                        <div class="col-xl-9">

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="lsm" value="Shared" id="formRadios1" checked>
                                                                <label class="form-check-label" for="formRadios1">
                                                                    Shared
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="lsm" value="Private" id="formRadios2">
                                                                <label class="form-check-label" for="formRadios2">
                                                                    Private
                                                                </label>
                                                            </div>

                                                        </div>
                                                    </div>



                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-dark btn-lg waves-effect waves-light">
                                                                Submit and Continue
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </form>
                                    </section>

                                </div>
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
