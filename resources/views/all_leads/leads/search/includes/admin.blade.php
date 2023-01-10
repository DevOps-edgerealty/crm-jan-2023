<div class="table-rep-plugin" >

    <div class="table-responsive mb-0" data-pattern="priority-columns">
        <table id="tech-companies-1" class="table table-hover" style="font-size:12px;z-index: 100;">

                <thead class="">
                    <tr>
                        <th>REF NO</th>
                        <th class="px-1">NAME</th>
                        <th>EMAIL</th>
                        <th>PHONE</th>
                        <th>LEAD TYPE</th>
                        <th class="px-0">LEAD SOURCE</th>
                        <th>INQUIRY</th>
                        <th>LEAD STATUS</th>
                        <th>AGENT FEEDBACK</th>
                        <th>AGENT NAME</th>
                        <th class="text-left px-2">CREATED DATE</th>
                        <th class="text-left px-2">LAST UPDATED</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>


            <tbody>
                @foreach ($leads as $lead)


                    {{-- Portal Leads --}}
                    @if(substr(@$lead->ref_no, 0, 2) == 'PL')
                    <tr>
                        <td class="px-0"><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-{{ $lead->id }}">{{$lead->ref_no}}</a></td>



                        <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-{{ $lead->id }}">{{$lead->name}}</a></td>
                        <td class="px-0"><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-{{ $lead->id }}" class="px-0">{{ $lead->email}}</a></td>

                        <td><span class="badge badge-soft-info font-size-12" onclick="this.innerHTML='{{$lead->phone}}'">Click To Show</span> </td>
                        <td class="text-left px-0" style="width: 100px;" >
                            <span class="badge badge-pill bg-success font-size-12"><i class="fas fa-house-user text-white"></i></span> Portals

                        </td>

                        <td class="px-0"> <!-- portal name -->
                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-{{ $lead->id }}">
                            @if ($lead->from == 'no-reply23@email.dubizzle.com')
                                Dubbizle
                            @elseif ($lead->from == 'no-reply@propertyfinder.ae')
                                Property finder
                            @elseif ($lead->from == 'noreply@bayut.com')
                                Bayut
                            @endif
                            </a>

                        </td>


                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-{{ $lead->inquiry }}">
                                {{ Str::limit(@$lead->inquiry, 25) }}
                            </a>
                        </td>



                        <td><!-- lead_status -->
                            @if ($lead->lead_detailss == '')
                                <span class="badge badge-pill badge-soft-warning font-size-14">Not Contacted</span>
                            @else
                                @if (@$lead->lead_detailss->lead_status == '1')
                                    <span class="badge badge-pill badge-soft-success font-size-14">Inerested</span>
                                @elseif (@$lead->lead_detailss->lead_status == '2')
                                    <span class="badge badge-pill badge-soft-danger font-size-14">Not Inerested</span>
                                @elseif (@$lead->lead_detailss->lead_status == '3')
                                    <span class="badge badge-pill badge-soft-info font-size-14">No Answer</span>
                                @elseif (@$lead->lead_detailss->lead_status == '4')
                                    <span class="badge badge-pill badge-soft-primary font-size-14">Contacted</span>
                                @elseif (@$lead->lead_detailss->lead_status == '5')
                                    <span class="badge badge-pill badge-soft-warning font-size-14">Not Contacted</span>
                                @elseif (@$lead->lead_detailss->lead_status == '6')
                                    <span class="badge badge-pill badge-soft-success font-size-14">Deal</span>

                                @endif
                            @endif


                        </td>

                        {{-- <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $lead->id }}">{{$lead->lead_status}}</a></td> --}}


                        <td> <!-- agent_feedback -->
                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-{{ $lead->id }}">
                                {{ Str::limit(@$lead->lead_detailss->lead_description, 25) }}
                            </a>
                        </td>

                        <td class="px-1">

                            {{-- <img class="rounded-circle avatar-xs" src="{{URL::asset('assets/images/users/'.@$lead->agent_image_path)}}" alt=""> --}}
                            {{ Str::limit(@$lead->users->name, 15) }}
                        </td>




                        <td class="px-2">{{date('d-m-Y', strtotime($lead->created_at));}}</td>
                        <td class="px-2">{{date('d-m-Y', strtotime($lead->updated_at));}}</td>


                        <td class="px-1">
                            <a href="{{url('property_listing/detail').'/'. $lead->id }}" class="btn btn-outline-info btn-sm edit" title="Detail" style="margin-right: 5px">
                                <i class="fas fa-eye"> </i>
                            </a>
                            <a href="{{url('property_listing_leads/edit').'/'. $lead->id }}" class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                <i class="fas fa-pencil-alt"> </i>
                            </a>
                        </td>
                    </tr>

                    {{-- Campaign Leads --}}
                    @elseif(substr(@$lead->ref_no, 0, 2) == 'CL')
                    <tr>
                        <td class="px-0"><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-clead{{ $lead->id }}">{{$lead->ref_no}}</a></td>



                        <td class="px-1"><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-clead-{{ $lead->id }}">{{$lead->full_name}}</a></td>
                        <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-clead-{{ $lead->id }}">{{ Str::limit($lead->email, 25) }}</a></td>

                        <td><span class="badge badge-soft-info font-size-12" onclick="this.innerHTML='{{$lead->phone}}'">Click To Show</span> </td>

                        <td class="text-left px-0" style="width: 100px;" >
                            <span class="badge badge-pill bg-info font-size-12"><i class="fab fa-facebook text-white"></i></i></span> Campaign
                        </td>

                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-clead-{{ $lead->inquiry }}">
                                {{ Str::limit(@$lead->inquiry, 25) }}
                            </a>
                        </td>

                        <td> <!-- portal name -->
                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-clead-{{ $lead->id }}">
                                {{ Str::limit(@$lead->qualified_question, 10) }}
                            </a>

                        </td>

                        <td>
                            @if ($lead->lead_status == '')
                                <span class="badge badge-pill badge-soft-warning font-size-14 w-100">Not Contacted</span>
                            @else
                                @if (@$lead->lead_status == '1')
                                    <span class="badge badge-pill badge-soft-success font-size-14 w-100">Interested</span>
                                @elseif (@$lead->lead_status == '2')
                                    <span class="badge badge-pill badge-soft-danger font-size-14 w-100">Not Inerested</span>
                                @elseif (@$lead->lead_status == '3')
                                    <span class="badge badge-pill badge-soft-info font-size-14 w-100">No Answer</span>
                                @elseif (@$lead->lead_status == '4')
                                    <span class="badge badge-pill badge-soft-primary font-size-14 w-100">Contacted</span>
                                @elseif (@$lead->lead_status == '5')
                                    <span class="badge badge-pill badge-soft-warning font-size-14 w-100">Not Contacted</span>
                                @elseif (@$lead->lead_status == '6')
                                    <span class="badge badge-pill badge-soft-success font-size-14 w-100">Deal</span>

                                @endif
                            @endif


                        </td>

                        {{-- <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $lead->id }}">{{$lead->lead_status}}</a></td> --}}
                        <td> <!-- agent_feedback -->
                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-clead-{{ $lead->id }}">
                                {{ Str::limit(@$lead->lead_detailss->lead_description, 25) }}
                            </a>
                        </td>

                        <td class="px-1">

                            {{-- <img class="rounded-circle avatar-xs" src="{{URL::asset('assets/images/users/'.@$lead->agent_image_path)}}" alt=""> --}}
                            {{ Str::limit(@$lead->users->name, 15) }}
                        </td>




                        <td class="px-2">{{date('d-m-Y', strtotime($lead->created_at));}}</td>
                        <td class="px-2">{{date('d-m-Y', strtotime($lead->updated_at));}}</td>


                        <td class="px-1">
                            <a href="{{url('leads/detail').'/'. $lead->id }}" class="btn btn-outline-info btn-sm edit" title="Detail" style="margin-right: 5px">
                                <i class="fas fa-eye"> </i>
                            </a>
                            <a href="{{url('leads/edit').'/'. $lead->id }}" class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                <i class="fas fa-pencil-alt"> </i>
                            </a>
                        </td>
                    </tr>


                    {{-- Website Leads --}}
                    @elseif(substr(@$lead->ref_no, 0, 2) == 'WL')
                    <tr>
                        <td class="px-0"><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-wlead-{{ $lead->id }}">{{$lead->ref_no}}</a></td>



                        <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-wlead-{{ $lead->id }}">{{$lead->name}}</a></td>
                        <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-wlead-{{ $lead->id }}">{{ Str::limit($lead->email, 25) }}</a></td>

                        <td><span class="badge badge-soft-info font-size-12" onclick="this.innerHTML='{{$lead->phone}}'">Click To Show</span> </td>

                        <td class="text-left px-0" style="width: 100px;" >
                            <span class="badge badge-pill bg-dark font-size-12"><i class="fas fa-globe-asia text-white"></i></i></span> Website
                        </td>

                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-wlead-{{ $lead->id }}">
                                {{$lead->lead_source}}
                            </a>
                        </td>

                        <td class="px-1"> <!-- portal name -->
                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-wlead-{{ $lead->id }}" class="px-1">
                                {{ Str::limit(@$lead->inquiry, 25) }}
                            </a>
                        </td>

                        <td>
                            @if ($lead->lead_status == '')
                                <span class="badge badge-pill badge-soft-warning font-size-14 w-100">Not Contacted</span>
                            @else
                                @if (@$lead->lead_status == '1')
                                    <span class="badge badge-pill badge-soft-success font-size-14 w-100">Interested</span>
                                @elseif (@$lead->lead_status == '2')
                                    <span class="badge badge-pill badge-soft-danger font-size-14 w-100">Not Inerested</span>
                                @elseif (@$lead->lead_status == '3')
                                    <span class="badge badge-pill badge-soft-info font-size-14 w-100">No Answer</span>
                                @elseif (@$lead->lead_status == '4')
                                    <span class="badge badge-pill badge-soft-primary font-size-14 w-100">Contacted</span>
                                @elseif (@$lead->lead_status == '5')
                                    <span class="badge badge-pill badge-soft-warning font-size-14 w-100">Not Contacted</span>
                                @elseif (@$lead->lead_status == '6')
                                    <span class="badge badge-pill badge-soft-success font-size-14 w-100">Deal</span>

                                @endif
                            @endif


                        </td>

                        {{-- <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $lead->id }}">{{$lead->lead_status}}</a></td> --}}
                        <td> <!-- agent_feedback -->
                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-wlead-{{ $lead->id }}">
                                {{ Str::limit(@$lead->lead_detailss->lead_description, 25) }}
                            </a>
                        </td>

                        <td class="px-1">

                            {{-- <img class="rounded-circle avatar-xs" src="{{URL::asset('assets/images/users/'.@$lead->agent_image_path)}}" alt=""> --}}
                            {{ Str::limit(@$lead->users->name, 15) }}
                        </td>




                        <td class="px-2">{{date('d-m-Y', strtotime($lead->created_at));}}</td>
                        <td class="px-2">{{date('d-m-Y', strtotime($lead->updated_at));}}</td>


                        <td class="px-1">
                            <a href="{{url('website/detail').'/'. $lead->id }}" class="btn btn-outline-info btn-sm detail" title="Detail">
                                <i class="fas fa-eye"> </i>
                            </a>
                            <a href="{{url('website_leads/edit').'/'. $lead->id }}" class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                <i class="fas fa-pencil-alt"> </i>
                            </a>
                        </td>
                    </tr>


                    @endif
                @endforeach

            </tbody>
        </table>
    </div>
</div>


