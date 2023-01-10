
<div class="row mb-5">
    <div class="col-lg-12">
        <form method="GET" action="{{url('/all_leads/search')}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row">
                <label for="example-text-input" class="col-md-1 offset-md-2 col-form-label">Search</label>
                <div class="col-md-4">
                    <input class="form-control mt-1" name="search" type="text" value="{{@$request->search}}" placeholder="Search Name" id="example-text-input">
                </div>

                <div class="col-md-2">
                    <div class="mb-3 mt-1">
                        {{-- <label for="lead_type" class="form-label">Lead Type</label> --}}
                        <select class="form-select" name="lead_type" id="lead_type" >
                            @if( isset($request->lead_type) )
                                @if($request->lead_type == 1)
                                    <option value="1" selected>All Leads</option>
                                    <option value="2">Campaign</option>
                                    <option value="3">Portal</option>
                                    <option value="4">Website</option>

                                @elseif($request->lead_type == 2)
                                    <option value="1" >All Leads</option>
                                    <option value="2" selected>Campaign</option>
                                    <option value="3">Portal</option>
                                    <option value="4">Website</option>

                                @elseif($request->lead_type == 3)
                                    <option value="1" >All Leads</option>
                                    <option value="2">Campaign</option>
                                    <option value="3" selected>Portal</option>
                                    <option value="4">Website</option>

                                @elseif($request->lead_type == 4)
                                    <option value="1" >All Leads</option>
                                    <option value="2">Campaign</option>
                                    <option value="3">Portal</option>
                                    <option value="4" selected>Website</option>
                                @endif
                            @else
                                <option value="1" selected>All Leads</option>
                                <option value="2">Campaign</option>
                                <option value="3">Portal</option>
                                <option value="4">Website</option>
                            @endif

                        </select>
                    </div>
                    <a id="flip"  class="float-end mt-2 fw-bold  text-decoration-underline" style="color: #000" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center">Advance Search</a>
                </div>

            </div>
            <div id="panel">
                <div class="row d-flex justify-content-center">
                    {{-- <div class="d-flex justify-content-center"> --}}


                        <div class="col-md-2 mx-3">
                            <div class="mb-3">
                                {{-- <label for="ref_number" class="form-label">Ref Number</label> --}}
                                <input type="text" value="{{@$request->ref_number}}" name="ref_number" placeholder="Reference Number" class="form-control " style="height: 30px;" id="ref_number">
                            </div>
                        </div>

                        <div class="col-md-2 mx-3">
                            <div class="mb-3">
                                {{-- <label for="" class="form-label">Phone Number</label> --}}
                                <input type="text" value="{{@$request->phone}}" name="phone" placeholder="Phone Number" class="form-control"  style="height: 30px;" id="phone">
                            </div>
                        </div>


                        <div class="col-md-2 mx-3">
                            <div class="mb-3">
                                {{-- <label for="email" class="form-label">Email</label> --}}
                                <input type="text" value="{{@$request->email}}" name="email" placeholder="Email" class="form-control" style="height: 30px;" id="email">
                            </div>
                        </div>




                        {{-- Lead Source --}}
                        <div class="col-md-2 mx-3">
                            <div class="mb-3">
                                {{-- <label for="lead_source" class="form-label" id="lead_source_label">Portal Name</label> --}}
                                <select class="form-select" name="lead_source" id="lead_source"  style="height: 30px; padding-top: 2px !important; padding-bottom: 0px !important;" disabled>
                                    <option value="" id="dis-option1" >Select Portal</option>

                                    @if( isset($request->lead_source) )

                                        @foreach ($portals as $portal)
                                            @if($portal->email == $request->lead_source)
                                                <option value="{{ $portal->email}}" selected>{{ $portal->portal_name }}</option>
                                            @else
                                                <option value="{{ $portal->email}}">{{ $portal->portal_name }}</option>
                                            @endif
                                        @endforeach

                                    @elseif($portals)

                                        @foreach ($portals as $portal)
                                            <option value="{{ $portal->email}}">{{ $portal->portal_name }}</option>
                                        @endforeach

                                    @endif


                                </select>
                                <small id="portal1" class="text-danger">choose a different lead type</small>

                            </div>
                        </div>










                    {{-- </div> --}}


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

                </div>

                <div class="row d-flex justify-content-center">
                    {{-- <div class="d-flex justify-content-center"> --}}



                        {{-- Campaign --}}
                        <div class="col-md-2 mx-3">
                            <div class="mb-">
                                {{-- <label for="campaign-select" class="form-label" id="lead_source_label">Campaign Name</label> --}}
                                <select class="form-select" name="campaigns" id="campaign-select" style="height: 30px; padding-top: 2px !important; padding-bottom: 0px !important;" disabled>
                                    <option value="" id="campaign-option">Select Campaign</option>

                                    @if( isset($request->campaigns) )
                                        @foreach ($campaigns as $campaign)
                                            @if($campaign->campaign_name == $request->campaigns)
                                                <option value="{{ $campaign->id}}" selected>{{ $campaign->campaign_name }}</option>
                                            @else
                                                <option value="{{ $campaign->id}}">{{ $campaign->campaign_name }}</option>
                                            @endif
                                        @endforeach

                                    @elseif ($campaigns)

                                        @foreach ($campaigns as $campaign)
                                            <option value="{{ $campaign->id}}">{{ $campaign->campaign_name }}</option>
                                        @endforeach

                                    @endif
                                </select>
                                <small id="campaign1" class="text-danger">choose a different lead type</small>

                            </div>
                        </div>


                        {{-- Lead Status --}}
                        <div class="col-md-2 mx-3">
                            <div class="mb-3">
                                {{-- <label for="lead_source" class="form-label">Select Status</label> --}}
                                <select class="form-select" name="lead_status" style="height: 30px; padding-top: 2px !important; padding-bottom: 0px !important;">
                                    @if( isset($request->lead_status) )
                                        @if($request->lead_status == 1)
                                            <option value="">Lead Status</option>
                                            <option value="1" selected>Interested</option>
                                            <option value="2">Not Interested</option>
                                            <option value="3">No Answer</option>
                                            <option value="5">Not Contacted</option>

                                        @elseif($request->lead_status == 2)
                                            <option value="">Lead Status</option>
                                            <option value="1">Interested</option>
                                            <option value="2" selected>Not Interested</option>
                                            <option value="3">No Answer</option>
                                            <option value="5">Not Contacted</option>

                                        @elseif($request->lead_status == 3)
                                            <option value="">Lead Status</option>
                                            <option value="1">Interested</option>
                                            <option value="2">Not Interested</option>
                                            <option value="3" selected>No Answer</option>
                                            <option value="5">Not Contacted</option>

                                        @elseif($request->lead_status == 5)
                                            <option value="">Lead Status</option>
                                            <option value="1">Interested</option>
                                            <option value="2">Not Interested</option>
                                            <option value="3">No Answer</option>
                                            <option value="5" selected>Not Contacted</option>
                                        @endif
                                    @else
                                        <option value="" selected>Select Status</option>
                                        <option value="">Lead Status</option>
                                        <option value="1">Interested</option>
                                        <option value="2">Not Interested</option>
                                        <option value="3">No Answer</option>
                                        <option value="5">Not Contacted</option>
                                    @endif
                                </select>
                            </div>
                        </div>




                        <div class="col-md-2 mx-3">
                            <div class="mb-3">
                                {{-- <label for="lead_type" class="form-label">Sort by</label> --}}
                                <select class="form-select" name="sort_by" style="height: 30px; padding-top: 2px !important;  padding-bottom: 0px !important;">

                                    @if( isset($request))

                                        @if($request->sort_by == 1)
                                            <option value="1" selected>Sort by Last Created</option>
                                            <option value="2">Sort by Last Updated</option>

                                        @elseif($request->sort_by == 2)
                                            <option value="1">Sort by Last Created</option>
                                            <option value="2" selected>Sort by Last Updated</option>

                                        @elseif($request->sort_by == 3)
                                            <option value="1">Sort by Last Created</option>
                                            <option value="2">Sort by Last Updated</option>

                                        @elseif($request->sort_by == 4)
                                            <option value="1">Sort by Last Created</option>
                                            <option value="2">Sort by Last Updated</option>

                                        @else
                                            <option value="1" selected>Sort by Last Created</option>
                                            <option value="2">Sort by Last Updated</option>
                                        @endif
                                    @else
                                            <option value="1" selected>Sort by Last Created</option>
                                            <option value="2">Sort by Last Updated</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    {{-- </div> --}}
                </div>
            </div>


            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <button type="submit" class="btn btn-dark w-100" style="background-color: #000">Search</button>
                </div>
            </div>


        </form>
    </div>
</div>


<script>
window.onload=function()
{
    document.getElementById("lead_type").onchange=function()
    {
        if(this.options[this.selectedIndex].value==2)
        {
            document.getElementById("lead_source").disabled=true;
            document.getElementById("portal1").hidden=false;

            document.getElementById("campaign-select").disabled=false;
            document.getElementById("campaign1").hidden=true;
        }
        else if(this.options[this.selectedIndex].value==1)
        {
            document.getElementById("lead_source").disabled=true;
            document.getElementById("portal1").hidden=false;

            document.getElementById("campaign-select").disabled=true;
            document.getElementById("campaign1").hidden=false;

        }
        else if(this.options[this.selectedIndex].value==4)
        {
            document.getElementById("lead_source").disabled=true;
            document.getElementById("portal1").hidden=false;

            document.getElementById("campaign-select").disabled=true;
            document.getElementById("campaign1").hidden=false;

            document.getElementById("website-select").disabled=false;
            document.getElementById("website1").hidden=true;

        }
        else if(this.options[this.selectedIndex].value==3)
        {
            document.getElementById("lead_source").disabled=false;
            document.getElementById("portal1").hidden=true;

            document.getElementById("campaign-select").disabled=true;
            document.getElementById("campaign1").hidden=false;

        }
    }


}
</script>
