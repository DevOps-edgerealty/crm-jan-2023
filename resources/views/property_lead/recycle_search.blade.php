<div class="row mb-5">
    <div class="col-lg-12">
        <form method="GET" action="{{url('property_listing/recycle_leads/search')}}" enctype="multipart/form-data">
            @csrf
            {{-- <div class="mb-3 row">
                <label for="example-text-input" class="col-md-1 offset-md-2 col-form-label">Search</label>
                <div class="col-md-6">
                    <input class="form-control" name="search" type="text" value="" placeholder="search" id="example-text-input">
                    <a id="flip"  class="float-end mt-2 fw-bold  text-decoration-underline" style="color: #000" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center">Advance Search</a>
                </div>

            </div> --}}
            <div id="panel">
                <div class="row">

                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="ref_number" class="form-label">Ref Number</label>
                            <input type="text" value="{{@$request->ref_number}}" name="ref_number" placeholder="Reference Number" class="form-control" id="ref_number">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" value="{{@$request->phone}}" name="phone" placeholder="Phone Number" class="form-control" id="ref_number">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" value="{{@$request->email}}" name="email" placeholder="Email" class="form-control" id="ref_number">
                        </div>
                    </div>

                    {{-- <div class="col-md-2">
                        <div class="mb-3">
                            <label for="lead_source" class="form-label">Select Status</label>
                            <select class="form-select" name="lead_status">
                                <option value="">Select Status</option>
                                <option value="1">Interested</option>
                                <option value="2">Not Interested</option>
                                <option value="3">No Answer</option>
                                <option value="5">Not Contacted</option>
                            </select>
                        </div>
                    </div> --}}
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="lead_source" class="form-label">Portals</label>
                            <select class="form-select" name="lead_source">
                                <option value="">Select Portal</option>
                                @if ($portals)
                                    @foreach ($portals as $portal)
                                        <option value="{{ $portal->email}}">{{ $portal->portal_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="agent" class="form-label">Agent</label>
                            <select class="form-select" name="agent">
                                <option value="">Select Agent</option>
                                @if ($agent)
                                    @foreach ($agent as $agents)
                                        <option value="{{ $agents->id}}">{{ $agents->name }}</option>
                                    @endforeach
                                @endif

                            </select>
                        </div>
                    </div>


                    {{-- <div class="col-md-2">
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

                    <div class="col-md-2 my-auto">
                        <div class="mt-2">
                            <button type="submit" class="btn btn-dark w-100">Search</button>

                        </div>
                    </div>

                </div>
            </div>


            {{-- <div class="row">
                <div class="col-md-6 offset-md-3">
                    <button type="submit" class="btn btn-dark w-100">Search</button>
                </div>
            </div> --}}


        </form>
    </div>
</div>
