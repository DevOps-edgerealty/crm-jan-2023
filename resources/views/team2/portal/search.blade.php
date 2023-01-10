<div class="row mb-5">
    <div class="col-lg-12">
        <form method="GET" action="{{url('team/portal/search')}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row">
                <label for="example-text-input" class="col-md-1 offset-md-2 col-form-label">Search</label>

                <div class="col-md-6">
                    <input class="form-control" name="search" value="{{@$request->search}}" type="text" value="" placeholder="Search" id="example-text-input">
                    <a id="flip" class="float-end mt-2 fw-bold  text-decoration-underline" style="color: #000" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"> Advance Search <i class="bx bx-search-alt-2"></i></a>
                </div>

            </div>
            <div id="panel">
                <div class="row">

                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="ref_number" class="form-label">Ref Number</label>
                            <input type="text" value="{{@$request->ref_number}}" name="ref_number" placeholder="Reference Number" class="form-control" id="ref_number" disabled>
                            <span class="text-danger font-size-11 ml-3">&nbsp;* case sensitive</span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" {{@$request->full_name}} name="full_name" placeholder="Full Name" class="form-control" id="full_name" disabled>
                            <span class="text-danger font-size-11 ml-3">&nbsp;* case sensitive</span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" value="{{@$request->phone}}" name="phone" placeholder="Phone Number" class="form-control" id="ref_number" disabled>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="lead_source" class="form-label">Select Status</label>
                            <select class="form-select" name="lead_status" disabled>
                                <option value="">Select Status</option>
                                <option value="1">Interested</option>
                                <option value="2">Not Interested</option>
                                <option value="3">No Answer</option>
                                <option value="5">Not Contacted</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="lead_source" class="form-label">Lead Source</label>
                            <select class="form-select" name="lead_source" disabled>
                                <option value="">Select Lead Source</option>
                                @if ($lead_source)
                                    @foreach ($lead_source as $source)
                                        <option value="{{ $source->id}}">{{ $source->type_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="agent" class="form-label">Agent</label>
                            <select class="form-select" name="agent_id">
                                <option value="">Select Agent</option>
                                <option value="24">Ahamad Al Zebn</option>
                                <option value="36">Mohammed Khaled Hassan</option>
                                <option value="37">Omar Hamdino Mohamed</option>
                                <option value="38">Roshdy Osama Mosalam</option>

                            </select>
                        </div>
                    </div>


                </div>

            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <button type="submit" class="btn btn-dark w-100">Search</button>
                </div>
            </div>

        </form>
    </div>
</div>
