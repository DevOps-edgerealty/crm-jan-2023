



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
    <div class="col-12 px-0 mx-0">
        <div class="">
            <div class="">


                <div class="table-rep-plugin">
                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                        <table id="tech-companies-1" class="table table-striped ">
                            <thead>
                                <tr>
                                    <th class="px-1">Ref Number</th>
                                    <th class="px-1">Full Name</th>
                                    <th class="px-1">Email</th>
                                    <th class="px-1">Phone</th>
                                    <th>Lead Type</th>
                                    <th>Lead Source</th>
                                    <th>Inquiry</th>
                                    {{-- <th>Agent Name</th> --}}
                                    <th>Agent Feedback</th>
                                    <th>Agent</th>
                                    <th class="px-1">Recycled By</th>
                                    <th class="px-1">Created At</th>
                                    <th class="px-1">Updated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leads as $lead)

                                     {{-- Portal Leads --}}
                                    @if(substr(@$lead->ref_no, 0, 2) == 'PL')
                                    <tr>
                                        <td class="px-0"><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-a-{{ $lead->id }}">{{$lead->ref_no}}</a></td>



                                        <td class="px-1"><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-a-{{ $lead->id }}">
                                        @if(empty($lead->name))
                                            Not Available
                                        @else
                                            {{$lead->name}}
                                        @endif
                                        </a></td>
                                        <td class="px-1"><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-a-{{ $lead->id }}">
                                        @if(empty($lead->email))
                                            no-email@edgerealty.ae
                                        @else
                                            {{ Str::limit($lead->email, 25) }}
                                        @endif
                                        </a></td>

                                        <td class="px-1"><span class="badge badge-soft-info font-size-12" onclick="this.innerHTML='{{$lead->phone}}'">Click To Show</span> </td>
                                        <td class="text-left px-0" style="width: 100px;" >
                                            <span class="badge badge-pill bg-success font-size-12"><i class="fas fa-house-user text-white"></i></span> Portals

                                        </td>
                                        <td> <!-- portal name -->
                                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-a-{{ $lead->id }}">
                                            @if ($lead->from == 'no-reply23@email.dubizzle.com')
                                                Dubbizle
                                            @elseif ($lead->from == 'no-reply@propertyfinder.ae')
                                                Property finder
                                            @elseif ($lead->from == 'noreply@bayut.com')
                                                Bayut
                                            @else
                                                {{$lead->from}}
                                            @endif
                                            </a>

                                        </td>
                                        <td>
                                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-a-{{ $lead->inquiry }}">
                                                {{ Str::limit(@$lead->inquiry, 25) }}
                                            </a>
                                        </td>

                                        {{-- <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $lead->id }}">{{$lead->lead_status}}</a></td> --}}
                                        <td> <!-- agent_feedback -->
                                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-a-{{ $lead->id }}">
                                                {{ Str::limit(@$lead->lead_detailss->lead_description, 25) }}
                                            </a>
                                        </td>

                                        <td class="px-1">

                                            <img class="rounded-circle avatar-xs" src="{{URL::asset('public/assets/images/users/'.@$lead->users->image)}}" alt="">
                                            {{ Str::limit(@$lead->users->name, 15) }}
                                        </td>


                                        <td>
                                            @if(@$lead->userss->name == null)
                                                management
                                            @else
                                                {{ Str::limit(@$lead->userss->name, 15) }}
                                            @endif
                                        </td>


                                        <td class="px-2 text-center">{{date('d-m-Y', strtotime($lead->created_at));}}</td>
                                        <td class="px-2 text-center">{{date('d-m-Y', strtotime($lead->updated_at));}}</td>


                                        <td class="px-1 text-center">
                                            <a href="{{url('property_listing/detail').'/'. $lead->id }}" class="btn btn-outline-info btn-sm Transfer" title="Details">
                                                <i class="fas fa-eye"> </i>
                                            </a>
                                            <a href="{{url('property_listing_leads/transfer/'.$lead->id)}}" class="btn btn-outline-secondary btn-sm Transfer" title="Transfer">
                                                <i class="fas fa-sync"> </i>
                                            </a>
                                        </td>
                                    </tr>







                                    {{-- Campaign leads --}}
                                    @elseif(substr(@$lead->ref_no, 0, 2) == 'CL')
                                    <tr>
                                        <td class="px-0"><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-clead-a-{{ $lead->id }}">{{$lead->ref_no}}</a></td>



                                        <td class="px-1"><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-clead-a-{{ $lead->id }}">
                                        @if(empty($lead->full_name))
                                            Not Available
                                        @else
                                            {{$lead->full_name}}
                                        @endif
                                        </a></td>
                                        <td class="px-1"><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-clead-a-{{ $lead->id }}">
                                        @if(empty($lead->email))
                                            no-email@edgerealty.ae
                                        @else
                                            {{ Str::limit($lead->email, 25) }}
                                        @endif
                                        </a></td>

                                        <td class="px-1"><span class="badge badge-soft-info font-size-12" onclick="this.innerHTML='{{$lead->phone}}'">Click To Show</span> </td>

                                        <td class="text-left px-0" style="width: 100px;" >
                                            <span class="badge badge-pill bg-info font-size-12"><i class="fab fa-facebook text-white"></i></i></span> Campaign
                                        </td>
                                        <td> <!-- portal name -->
                                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-clead-a-{{ $lead->id }}">
                                                {{Str::limit(@$lead->qualified_question, 10) }}
                                            </a>

                                        </td>

                                        <td>
                                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-clead-a-{{ $lead->inquiry }}">
                                                {{@$lead->campaigns->campaign_name}}
                                            </a>
                                        </td>

                                        {{-- <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $lead->id }}">{{$lead->lead_status}}</a></td> --}}
                                        <td> <!-- agent_feedback -->
                                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-clead-a-{{ $lead->id }}">
                                                {{ Str::limit(@$lead->lead_detailss->lead_description, 23) }}

                                            </a>
                                        </td>

                                        <td class="px-1">

                                            @if (@$lead->users->image == '')
                                                <img class="rounded-circle avatar-xs" src="{{URL::asset('assets/images/users/20220111103204.jpg')}}" alt="">
                                                {{ Str::limit(@$lead->users->name, 12) }}

                                            @else
                                                <img class="rounded-circle avatar-xs" src="{{URL::asset('assets/images/users/'.@$listing->users->image)}}" alt="">
                                                {{ Str::limit(@$lead->users->name, 12) }}

                                            @endif

                                        </td>

                                        <td>
                                            @if(@$lead->userss->name == null)
                                                management
                                            @else
                                                {{ Str::limit(@$lead->userss->name, 15) }}
                                            @endif
                                        </td>


                                        <td class="px-2 text-center">{{date('d-m-Y', strtotime($lead->created_at));}}</td>
                                        <td class="px-2 text-center">{{date('d-m-Y', strtotime($lead->updated_at));}}</td>


                                        <td class="px-1 text-center">
                                            <a href="{{url('leads/detail').'/'. $lead->id }}" class="btn btn-outline-info btn-sm Transfer" title="Details">
                                                <i class="fas fa-eye"> </i>
                                            </a>


                                            <a href="{{('leads/transfer/'.$lead->id)}}" class="btn btn-outline-secondary btn-sm Transfer" title="Transfer">
                                                <i class="fas fa-sync"> </i>
                                            </a>
                                        </td>
                                    </tr>






                                    {{-- Website leads --}}
                                    @elseif(substr(@$lead->ref_no, 0, 2) == 'WL')
                                    <tr>
                                        <td class="px-0"><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-wlead-a-{{ $lead->id }}">{{$lead->ref_no}}</a></td>



                                        <td class="px-1"><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-wlead-a-{{ $lead->id }}">
                                        @if(empty($lead->name))
                                            Not Available
                                        @else
                                            {{$lead->name}}
                                        @endif
                                        </a></td>
                                        <td class="px-1"><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-wlead-a-{{ $lead->id }}">
                                        @if(empty($lead->email))
                                            no-email@edgerealty.ae
                                        @else
                                            {{ Str::limit($lead->email, 25) }}
                                        @endif
                                        </a></td>

                                        <td class="px-1"><span class="badge badge-soft-info font-size-12" onclick="this.innerHTML='{{$lead->phone}}'">Click To Show</span> </td>

                                        <td class="text-left px-0" style="width: 100px;" >
                                            <span class="badge badge-pill bg-dark font-size-12"><i class="fas fa-globe-asia text-white"></i></i></span> Website
                                        </td>

                                        <td> <!-- Lead Source -->
                                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-wlead-a-{{ $lead->id }}">
                                                {{@$lead->source}}
                                            </a>

                                        </td>

                                        <td>
                                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-wlead-a-{{ $lead->inquiry }}">
                                                {{ Str::limit(@$lead->inquiry, 25) }}
                                            </a>
                                        </td>

                                        {{-- <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $lead->id }}">{{$lead->lead_status}}</a></td> --}}
                                        <td class="px-1"> <!-- agent_feedback -->
                                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-wlead-a-{{ $lead->id }}">
                                                {{ Str::limit(@$lead->lead_detailss->lead_description, 20) }}
                                            </a>
                                        </td>

                                        <td class="px-1">
                                            <img class="rounded-circle avatar-xs" src="{{URL::asset('public/assets/images/users/'.@$lead->users->image)}}" alt="">
                                            {{ Str::limit(@$lead->users->name, 12) }}
                                        </td>

                                        <td>
                                            @if(@$lead->userss->name == null)
                                                management
                                            @else
                                                {{ Str::limit(@$lead->userss->name, 15) }}
                                            @endif
                                        </td>

                                        <td class="px-2 text-center">{{date('d-m-Y', strtotime($lead->created_at));}}</td>
                                        <td class="px-2 text-center">{{date('d-m-Y', strtotime($lead->updated_at));}}</td>


                                        <td class="px-1 text-center">
                                            <a href="{{URL('website/detail').'/'. $lead->id }}" class="btn btn-outline-info btn-sm Transfer" title="Details">
                                                <i class="fas fa-eye"> </i>
                                            </a>
                                            <a href="{{URL('website_leads/transfer/'.$lead->id)}}" class="btn btn-outline-secondary btn-sm Transfer" title="Transfer">
                                                <i class="fas fa-sync"> </i>
                                            </a>
                                        </td>
                                    </tr>


                                    @endif
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end col -->


</div> <!-- end row -->

