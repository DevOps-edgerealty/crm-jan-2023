
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


                                    <button class="nav-link active d-flex justify-content-start py-3  text-dark  " style="width: 200px;"  data-bs-toggle="tab" data-bs-target="#nav-common" type="button" role="tab" aria-controls="nav-common" aria-selected="true">
                                        <span class="font-size-14">Page 03 - Bayut</span>
                                    </button>


                                    <button class="nav-link d-flex justify-content-start py-3  text-dark  " style="width: 250px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Click next to continue">
                                        <span class="font-size-14">Page 04 - Property Finder</span>
                                    </button>
                                </div>


                            </nav>


                            {{-- Page 01 - Information --}}
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-common" role="tabpanel" aria-labelledby="nav-common-tab">

                                    <h3 id="basic-example-h-0" tabindex="-1" class="title current pt-4">Bayut Listing Information</h3>
                                    <section id="basic-example-p-0" role="tabpanel" aria-labelledby="basic-example-h-0" class="body current" aria-hidden="false">


                                        <form method="POST" action="{{url('/listing/store')}}" enctype="multipart/form-data" class="needs-validation">
                                            {{-- <form method="POST" action="{{url('/listing/store')}}" enctype="multipart/form-data" class="needs-validation"> --}}
                                            @csrf
                                            <div class="row mt-5">
                                                <div class="col-lg-4">
                                                    <h6 class="mb-3">Location & Price</h6>
                                                    <div class="row mb-3">

                                                            <label class="col-md-3 form-label">Type:<span class="text-danger">*</span></label>
                                                            <div class="col-md-9">
                                                                <select class="form-select" name="type" required>
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
                                                    <div class="row mb-3">
                                                        <label class="col-md-3 form-label">Purpose:</label>
                                                        <div class="col-xl-9">

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="purpose" value="Rent" id="formRadios1" checked>
                                                                <label class="form-check-label" for="formRadios1">
                                                                    Rent
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="purpose" value="Sale" id="formRadios2">
                                                                <label class="form-check-label" for="formRadios2">
                                                                    Sale
                                                                </label>
                                                            </div>

                                                        </div>
                                                    </div>
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
                                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Unit# :</label>

                                                        <div class="col-sm-3">
                                                            <input type="text" name="unit" class="form-control" placeholder="Unit#" >
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="text" name="plot" class="form-control" placeholder="Plot#" >
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="text" name="street" class="form-control" placeholder="Street#" >
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">

                                                        <label class="col-md-3 form-label">Views:</label>
                                                        <div class="col-md-9">
                                                            <select class="form-select w-100" name="views">
                                                                <option value="">Select a View</option>

                                                                    <option value="Pool View">Pool View</option>
                                                                    <option value="Road View">Road View</option>
                                                                    <option value="Park View">Park View</option>
                                                                    <option value="Sea View">Sea View</option>
                                                                    <option value="Marin View">Marin View</option>
                                                                    <option value="Lake View">Lake View</option>
                                                                    <option value="Garden View">Garden View</option>
                                                                    <option value="Palm Jumeirah View">Palm Jumeirah View</option>
                                                                    <option value="Burj Khalifa View">Burj Khalifa View</option>
                                                                    <option value="Atlantis View">Atlantis View</option>
                                                                    <option value="Skyline View">Skyline View</option>
                                                                    <option value="Golf Course View">Golf Course View</option>
                                                                    <option value="Fountain View">Fountain View</option>
                                                                    <option value="Creek View">Creek View</option>
                                                                    <option value="Canal View">Canal View</option>
                                                                    <option value="Stable View">Stable View</option>
                                                                    <option value="Boulevard View">Boulevard View</option>
                                                                    <option value="Landscape View">Landscape View</option>
                                                                    <option value="Mountain View">Mountain View</option>
                                                                    <option value="Ain Dubai View">Ain Dubai View</option>
                                                                    <option value="Lagoon View">Lagoon View</option>

                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">External Reference:</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="external_reference" class="form-control" placeholder="External Reference ">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">

                                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Annual Commision:</label>
                                                        <div class="col-sm-4">
                                                            <div class="input-group mb-3">

                                                                <input type="number" class="form-control" name="annual_commission1" value="" aria-describedby="option-zIndex" placeholder="">
                                                                <span class="input-group-text" id="option-zIndex">%</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <div class="input-group mb-3">

                                                                <input type="number" class="form-control" name="annual_commission2" value="" aria-describedby="option-zIndex" placeholder="">
                                                                <span class="input-group-text" id="option-zIndex">AED</span>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="col-lg-4">
                                                    <h6>Listing Details</h6>
                                                    <div class="row mb-3">

                                                        <label class="col-md-3 form-label">Developer:</label>
                                                        <div class="col-md-9">
                                                            <select class="form-select w-100" name="developer">
                                                                <option>Select Developer</option>
                                                                @if ($developers)
                                                                    @foreach ($developers as $developer)
                                                                        <option value="{{ $developer->id}}">{{ $developer->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="row mb-3">

                                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Plot Area:</label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group  mb-3">

                                                                <input type="number" class="form-control " name="plot_area" value="" aria-describedby="option-zIndex" placeholder="">
                                                                <span class="input-group-text" id="option-zIndex">sqft</span>
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="row mb-3">

                                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Area:<span class="text-danger">*</span></label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group input-group-sm mb-3">

                                                                <input type="number" class="form-control " name="area" value="" aria-describedby="option-zIndex" placeholder="" required>
                                                                <span class="input-group-text" id="option-zIndex">sqft</span>
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Deposit:</label>

                                                        <div class="col-sm-4">
                                                            <div class="input-group mb-3">

                                                                <input type="number" class="form-control " name="deposit1" value="" aria-describedby="option-zIndex" placeholder="">
                                                                <span class="input-group-text" id="option-zIndex">%</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <div class="input-group mb-3">

                                                                <input type="number" class="form-control " name="deposit2" value="" aria-describedby="option-zIndex" placeholder="">
                                                                <span class="input-group-text" id="option-zIndex">AED</span>
                                                            </div>
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
                                                    <div class="row mb-3">
                                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Transcation:</label>

                                                        <div class="col-sm-9">


                                                            <input type="number" class="form-control " name="transaction" value="" aria-describedby="option-zIndex" placeholder="Transcation #" disabled>


                                                        </div>


                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Permit:<span class="text-danger">*</span></label>

                                                        <div class="col-sm-4">
                                                            <div class="input-group  mb-3">

                                                                <input type="number" class="form-control " name="permit" value="" aria-describedby="option-zIndex" placeholder="Permit #">
                                                                <span class="input-group-text" id="option-zIndex"><i class="fas fa-redo-alt"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-5">


                                                            <input type="number" class="form-control " name="permit_expiry" value="" aria-describedby="option-zIndex" placeholder="Permit Expiry">


                                                        </div>

                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Landlord:</label>

                                                        <div class="col-sm-9">
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="option-zIndex"><i class="fas fa-plus-circle"></i></span>
                                                                <input type="number" class="form-control " name="landlord" value="" aria-describedby="option-zIndex" placeholder="Contact">

                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="row mb-3">

                                                        <label class="col-md-3 form-label">Assign to:<span class="text-danger">*</span><i class="fa fa-info-circle tooltips" data-placement="top" title="" data-original-title="Staff ">&nbsp;</i></label>
                                                        <div class="col-md-9">
                                                            <select class="form-control select" name="assign_to" required>
                                                                <option value="">Select Agent</option>
                                                                @if ($agents)
                                                                    @foreach ($agents as $agent)
                                                                        <option value="{{ $agent->id}}">{{ $agent->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="row mb-3">

                                                        <label class="col-md-3 form-label">Status:</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" name="status">
                                                                    <option value="draft">draft</option>
                                                                    <option value="live">live</option>
                                                                    <option value="archive">archive</option>
                                                                    <option value="review">review</option>


                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Note:</label>
                                                        <div class="col-sm-9">
                                                            <textarea id="textarea" class="form-control" maxlength="225" rows="3" placeholder="" name="note"></textarea>
                                                        </div>


                                                    </div>

                                                    {{-- <div class="row pt-4">
                                                        <div class="col-md-12 mx-auto">
                                                            <div class="col-md-4 mx-auto"></div>
                                                            <div class="col-md-4 mx-auto">
                                                                <button type="submit" class="btn btn-warning btn-sm btn-block w-100 form-control mx-auto">CREATE LISTING</button>
                                                            </div>
                                                            <div class="col-md-4 mx-auto"></div>
                                                        </div>
                                                    </div> --}}


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
