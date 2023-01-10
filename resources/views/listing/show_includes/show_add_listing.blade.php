<form method="POST" action="{{url('/listing/store')}}" enctype="multipart/form-data" class="needs-validation">
    {{-- <form method="POST" action="{{url('/listing/store')}}" enctype="multipart/form-data" class="needs-validation"> --}}
    @csrf
    <div class="row mt-5">
        <div class="col-lg-4">
            <h6 class="mb-3">Location & Price</h6>
            <div class="row mb-3">

                    <label class="col-md-3 form-label">Type:<span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <select class="form-control select3" name="type" required>
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
                    <input type="text" name="location" value="" class="form-control form-control-sm" placeholder="Type location... ">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-3 form-label">Emirates:<span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <select class="form-control-sm select1 w-100" name="emirates" required>
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
                    <select class="form-control-sm select1 w-100" name="community" required>
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
                    <input type="text" name="unit" class="form-control form-control-sm" placeholder="Unit#" >
                </div>
                <div class="col-sm-3">
                    <input type="text" name="plot" class="form-control form-control-sm" placeholder="Plot#" >
                </div>
                <div class="col-sm-3">
                    <input type="text" name="street" class="form-control form-control-sm" placeholder="Street#" >
                </div>
            </div>

            <div class="row mb-3">

                <label class="col-md-3 form-label">Views:</label>
                <div class="col-md-9">
                    <select class="form-control-sm select1 w-100" name="views">
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
                    <input type="text" name="external_reference" class="form-control form-control-sm" placeholder="External Reference ">
                </div>
            </div>
            <div class="row mb-3">

                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Rent:<span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm mb-3">

                        <input type="number" class="form-control" name="rent" value="" aria-describedby="option-zIndex" placeholder="" required>
                        <span class="input-group-text" id="option-zIndex">AED</span>
                    </div>
                </div>

            </div>
            <div class="row mb-3">
                <label class="col-md-3 col-form-label">Frequency:</label>
                <div class="col-md-9">
                    <select class="form-select form-select-sm" name="frequency">
                        <option value="Yearly">Yearly</option>
                        <option value="Monthly">Monthly</option>
                        <option value="Weekly">Weekly</option>
                        <option value="Daily">Daily</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">

                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Annual Commision:</label>
                <div class="col-sm-4">
                    <div class="input-group input-group-sm mb-3">

                        <input type="number" class="form-control" name="annual_commission1" value="" aria-describedby="option-zIndex" placeholder="">
                        <span class="input-group-text" id="option-zIndex">%</span>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="input-group input-group-sm mb-3">

                        <input type="number" class="form-control" name="annual_commission2" value="" aria-describedby="option-zIndex" placeholder="">
                        <span class="input-group-text" id="option-zIndex">AED</span>
                    </div>
                </div>

            </div>

        </div>
        <div class="col-lg-4">
            <h6>Listing Details</h6>

            <div class="row mb-3">


                <div class="col-sm-6">
                    <div class="row">
                        <label for="horizontal-firstname-input" class="col-sm-6 col-form-label">Beds:</label>
                        <div class="col-sm-6">
                            <select class="form-select form-select-sm" name="beds">
                                <option value="">Select</option>
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
                <div class="col-sm-6">
                    <div class="row">
                        <label for="horizontal-firstname-input" class="col-sm-6 col-form-label">Baths:</label>
                        <div class="col-sm-6">
                            <select class="form-select form-select-sm" name="baths">
                                <option value="">Select</option>
                                <option value="">Studio</option>
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

            <div class="row mb-3">


                <div class="col-sm-6">
                    <div class="row">
                        <label for="horizontal-firstname-input" class="col-sm-6 col-form-label">Parking:</label>
                        <div class="col-sm-6">
                        <input type="text" name="parking" class="form-control form-control-sm" placeholder="" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <label for="horizontal-firstname-input" class="col-sm-6 col-form-label">Year of Built:</label>
                        <div class="col-sm-6">
                        <input type="text" name="year_of_built" class="form-control form-control-sm" placeholder="" >
                        </div>
                    </div>
                </div>



            </div>
            <div class="row mb-3">

                <label class="col-md-3 form-label">Developer:</label>
                <div class="col-md-9">
                    <select class="form-control-sm select1 w-100" name="developer">
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
                    <div class="input-group input-group-sm mb-3">

                        <input type="number" class="form-control form-control-sm" name="plot_area" value="" aria-describedby="option-zIndex" placeholder="">
                        <span class="input-group-text" id="option-zIndex">sqft</span>
                    </div>
                </div>


            </div>
            <div class="row mb-3">

                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Area:<span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm mb-3">

                        <input type="number" class="form-control form-control-sm" name="area" value="" aria-describedby="option-zIndex" placeholder="" required>
                        <span class="input-group-text" id="option-zIndex">sqft</span>
                    </div>
                </div>


            </div>
            <div class="row mb-3">
                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Deposit:</label>

                <div class="col-sm-4">
                    <div class="input-group input-group-sm mb-3">

                        <input type="number" class="form-control form-control-sm" name="deposit1" value="" aria-describedby="option-zIndex" placeholder="">
                        <span class="input-group-text" id="option-zIndex">%</span>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="input-group input-group-sm mb-3">

                        <input type="number" class="form-control form-control-sm" name="deposit2" value="" aria-describedby="option-zIndex" placeholder="">
                        <span class="input-group-text" id="option-zIndex">AED</span>
                    </div>
                </div>

            </div>
            <div class="row mb-3">

                <label class="col-md-3 form-label">Cheques:*</label>
                <div class="col-md-9">
                    <select class="form-control form-select-sm" name="cheques">
                        <option>Select Cheque Type</option>

                            <option value="1 Cheque (Yearly)">1 Cheque (Yearly)</option>
                            <option value="2 Cheque (Yearly)">2 Cheque (Yearly)</option>
                            <option value="3 Cheque (Yearly)">3 Cheque (Yearly)</option>
                            <option value="4 Cheque (Yearly)">4 Cheque (Yearly)</option>
                            <option value="6 Cheque (Yearly)">6 Cheque (Yearly)</option>
                            <option value="12 Cheque (Yearly)">12 Cheque (Yearly)</option>

                    </select>
                </div>

            </div>
            <div class="row mb-3">
                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Title:</label>
                <div class="col-sm-9">
                <input type="text" name="title" class="form-control form-control-sm" placeholder="">
                </div>
            </div>
            <div class="row mb-3">
                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Description:</label>
                <div class="col-sm-9">
                    <textarea id="textarea" class="form-control" name="description" maxlength="225" rows="3" placeholder="300 Characters for good health in portals."></textarea>
                </div>


            </div>
            <div class="row mb-3 col-12">

                <div class="col-md-2 m-2 mt-0">
                    @include('listing.show_includes.uploads.portals')
                </div>


                <div class="col-md-2 m-2 mt-0">
                    @include('listing.show_includes.uploads.photos')
                </div>


                <div class="col-md-2 m-2 mt-0">
                    @include('listing.show_includes.uploads.videos')

                </div>


                <div class="col-md-2 m-2 mt-0">
                    @include('listing.show_includes.uploads.floor_plans')

                </div>


                <div class="col-md-2 m-2 mt-0">
                    @include('listing.show_includes.uploads.documents')

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


                    <input type="number" class="form-control form-control-sm" name="transaction" value="" aria-describedby="option-zIndex" placeholder="Transcation #" disabled>


                </div>


            </div>
            <div class="row mb-3">
                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Permit:<span class="text-danger">*</span></label>

                <div class="col-sm-4">
                    <div class="input-group input-group-sm mb-3">

                        <input type="number" class="form-control form-control-sm" name="permit" value="" aria-describedby="option-zIndex" placeholder="Permit #">
                        <span class="input-group-text" id="option-zIndex"><i class="fas fa-redo-alt"></i></span>
                    </div>
                </div>
                <div class="col-sm-5">


                    <input type="number" class="form-control form-control-sm" name="permit_expiry" value="" aria-describedby="option-zIndex" placeholder="Permit Expiry">


                </div>

            </div>
            <div class="row mb-3">
                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Landlord:</label>

                <div class="col-sm-9">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="option-zIndex"><i class="fas fa-plus-circle"></i></span>
                        <input type="number" class="form-control form-control-sm" name="landlord" value="" aria-describedby="option-zIndex" placeholder="Contact">

                    </div>
                </div>


            </div>
            <div class="row mb-3">

                <label class="col-md-3 form-label">Assign to:<span class="text-danger">*</span><i class="fa fa-info-circle tooltips" data-placement="top" title="" data-original-title="Staff ">&nbsp;</i></label>
                <div class="col-md-9">
                    <select class="form-control select1" name="assign_to" required>
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
                    <select class="form-control form-select-sm" name="status">
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

            <div class="row pt-4">
                <div class="col-md-12 mx-auto">
                    <div class="col-md-4 mx-auto"></div>
                    <div class="col-md-4 mx-auto">
                        <button type="submit" class="btn btn-warning btn-sm btn-block w-100 form-control mx-auto">CREATE LISTING</button>
                    </div>
                    <div class="col-md-4 mx-auto"></div>
                </div>
            </div>

        </div>
    </div>
</form>
