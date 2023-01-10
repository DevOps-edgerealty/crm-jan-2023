
<div class="table-rep-plugin" >

    <div class="table-responsive mb-0" data-pattern="priority-columns">
        <table id="tech-companies-1" class="table table-hover table-striped" style="font-size:12px;z-index: 100;">

                <thead class="shadow-sm border">
                    <tr>
                        <th>REF NO</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>PHONE</th>
                        <th>LEAD TYPE</th>
                        <th>LEAD SOURCE</th>
                        <th>INQUIRY</th>
                        <th>LEAD STATUS</th>
                        {{-- <th>AGENT FEEDBACK</th> --}}
                        <th>AGENT NAME</th>
                        @if ($sortedBy == 'created_at')
                            <th class="text-center">CREATED AT</th>

                        @elseif ($sortedBy == 'updated_at')
                            <th class="text-center">UPDATED AT</th>

                        @else
                            <th class="text-center">CREATED AT</th>
                            <th class="text-center">UPDATED AT</th>
                        @endif
                        <th>ACTIONS</th>
                    </tr>
                </thead>


            <tbody>
                @foreach ($leads as $lead)

                    {{-- Portal Leads --}}
                    @if(substr(@$lead->ref_no, 0, 2) == 'PL')
                    <tr>
                        {{-- <td>{{$lead->lead_detailss[]}}</td> --}}
                        <td class="px-0"><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-a-{{ $lead->id }}">{{$lead->ref_no}}</a></td>



                        <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-a-{{ $lead->id }}">
                            @if(empty($lead->name))
                                Not Available
                            @else
                                {{$lead->name}}
                            @endif
                        </a></td>
                        <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-a-{{ $lead->id }}">
                            @if(empty($lead->name))
                                no-email@edgerealty.ae
                            @else
                                {{ Str::limit($lead->email, 25) }}
                            @endif
                        </a></td>

                        <td><span class="badge badge-soft-info font-size-12" onclick="this.innerHTML='{{$lead->phone}}'">Click To Show</span> </td>
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


                        {{-- lead status --}}
                        <td>
                            @if ($lead->lead_status == null)
                                <span class="badge badge-pill badge-soft-warning font-size-14 w-100">Not Contacted </span>

                            @else
                                @if (@$lead->lead_status == '1')
                                    <span class="badge badge-pill badge-soft-success font-size-14 w-100">Interested</span>


                                @elseif (@$lead->lead_status == '2')
                                    <span class="badge badge-pill badge-soft-danger font-size-14 w-100">Not Interested</span>


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


                        <td class="px-1">
                            {{ Str::limit(@$lead->users->name, 15) }}
                        </td>


                        @if ($sortedBy == 'created_at')
                            <td class="px-2">{{$lead->created_at}}</td>
                        @elseif ($sortedBy == 'updated_at')
                            <td class="px-2">{{$lead->updated_at}}</td>
                        @else
                            <td class="px-2">{{$lead->created_at}}</td>
                            <td class="px-2">{{$lead->updated_at}}</td>
                        @endif


                        <td class="px-1">
                            <a href="{{url('property_listing/detail').'/'. $lead->id }}" class="btn btn-outline-info btn-sm edit" title="Detail" style="margin-right: 5px">
                                <i class="fas fa-eye"> </i>
                            </a>
                            <a href="{{url('property_listing_leads/edit').'/'. $lead->id }}" class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                <i class="fas fa-pencil-alt"> </i>
                            </a>
                            <a href="{{url('old_plead_change_date').'/'. $lead->id }}" class="btn btn-outline-success btn-sm edit" title="Edit">
                                <i class="fas fa-eye"> </i>
                            </a>
                        </td>
                    </tr>







                    {{-- Campaign leads --}}
                    @elseif(substr(@$lead->ref_no, 0, 2) == 'CL')
                    <tr>
                        <td class="px-0"><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-clead-a-{{ $lead->id }}">{{$lead->ref_no}}</a></td>



                        <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-clead-a-{{ $lead->id }}">
                            @if(empty($lead->full_name))
                                Not Available
                            @else
                                {{$lead->full_name}}
                            @endif
                        </a></td>
                        <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-clead-a-{{ $lead->id }}">
                            @if(empty($lead->name))
                                no-email@edgerealty.ae
                            @else
                                {{ Str::limit($lead->email, 25) }}
                            @endif
                        </a></td>

                        <td><span class="badge badge-soft-info font-size-12" onclick="this.innerHTML='{{$lead->phone}}'">Click To Show</span> </td>

                        <td class="text-left px-0" style="width: 100px;" >
                            <span class="badge badge-pill bg-info font-size-12"><i class="fab fa-facebook text-white"></i></i></span> Campaign
                        </td>


                        <td> <!-- lead source -->
                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-clead-a-{{ $lead->id }}">
                                {{Str::limit(@$lead->qualified_question, 10) }}
                            </a>

                        </td>

                        {{-- inquiry --}}
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-clead-a-{{ $lead->inquiry }}">
                                {{@$lead->campaigns->campaign_name}}
                                {{-- {{ Str::limit(@$lead->inquiry, 25) }} --}}
                            </a>
                        </td>



                        <td> <!-- lead_status -->

                                @if ($lead->status == null)
                                    <span class="badge badge-pill badge-soft-warning font-size-14 w-100">Not Contacted</span>

                                @else
                                    @if (@$lead->lead_status == '1')
                                        <span class="badge badge-pill badge-soft-success font-size-14 w-100">Interested</span>

                                    @elseif (@$lead->lead_status == '2')
                                        <span class="badge badge-pill badge-soft-danger font-size-14 w-100">Not Interested</span>

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
                        {{-- <td> <!-- agent_feedback -->
                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-clead-a-{{ $lead->id }}">
                                {{ Str::limit(@$lead->lead_detailss->lead_description, 23) }}
                            </a>
                        </td> --}}

                        <td class="px-1">

                            @if (@$lead->users->image == '')
                                <img class="rounded-circle avatar-xs" src="{{URL::asset('assets/images/users/20220111103204.jpg')}}" alt="">
                                {{ Str::limit(@$lead->users->name, 12) }}

                            @else
                                {{-- <img class="rounded-circle avatar-xs" src="{{URL::asset('assets/images/users/'.@$listing->users->image)}}" alt=""> --}}
                                {{ Str::limit(@$lead->users->name, 12) }}

                            @endif

                        </td>




                        @if ($sortedBy == 'created_at')
                            <td class="px-2">{{$lead->created_at}}</td>
                        @elseif ($sortedBy == 'updated_at')
                            <td class="px-2">{{$lead->updated_at}}</td>
                        @else
                            <td class="px-2">{{$lead->created_at}}</td>
                            <td class="px-2">{{$lead->updated_at}}</td>
                        @endif


                        <td class="px-1">
                            <a href="{{url('leads/detail').'/'. $lead->id }}" class="btn btn-outline-info btn-sm edit" title="Detail" style="margin-right: 5px">
                                <i class="fas fa-eye"> </i>
                            </a>
                            <a href="{{url('leads/edit').'/'. $lead->id }}" class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                <i class="fas fa-pencil-alt"> </i>
                            </a>
                            <a href="{{url('old_clead_change_date').'/'. $lead->id }}" class="btn btn-outline-success btn-sm edit" title="Edit">
                                <i class="fas fa-eye"> </i>
                            </a>
                        </td>
                    </tr>






                    {{-- Website leads --}}
                    @elseif(substr(@$lead->ref_no, 0, 2) == 'WL')
                    <tr>
                        <td class="px-0"><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-wlead-a-{{ $lead->id }}">{{$lead->ref_no}}</a></td>



                        <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-wlead-a-{{ $lead->id }}">
                            @if(empty($lead->name))
                                Not Available
                            @else
                                {{$lead->name}}
                            @endif
                        </a></td>
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-wlead-a-{{ $lead->id }}">
                                @if(empty($lead->name))
                                    no-email@edgerealty.ae
                                @else
                                    {{ Str::limit($lead->email, 25) }}
                                @endif
                            </a>
                        </td>

                        <td><span class="badge badge-soft-info font-size-12" onclick="this.innerHTML='{{$lead->phone}}'">Click To Show</span> </td>

                        <td class="text-left px-0" style="width: 100px;" >
                            <span class="badge badge-pill bg-dark font-size-12"><i class="fas fa-globe-asia text-white"></i></i></span> Website
                        </td>

                        <td> <!-- portal name -->
                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-wlead-a-{{ $lead->id }}">
                            @if ($lead->source == 'no-reply23@email.dubizzle.com')
                                Dubbizle
                            @elseif ($lead->source == 'no-reply@propertyfinder.ae')
                                Property finder
                            @elseif ($lead->source == 'noreply@bayut.com')
                                Bayut
                            @else
                                {{$lead->source}}
                            @endif
                            </a>

                        </td>

                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-wlead-a-{{ $lead->inquiry }}">
                                {{ Str::limit(@$lead->inquiry, 25) }}
                            </a>
                        </td>







                        <td><!-- lead_status -->
                            @if ($lead->lead_detailss == null)
                                <span class="badge badge-pill badge-soft-warning font-size-14 w-100">Not Contacted</span>
                            @else
                                @if (@$lead->lead_status == '1')
                                    <span class="badge badge-pill badge-soft-success font-size-14 w-100">Interested</span>
                                @elseif (@$lead->lead_status == '2')
                                    <span class="badge badge-pill badge-soft-danger font-size-14 w-100">Not Interested</span>
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
                        {{-- <td > <!-- agent_feedback -->
                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-wlead-a-{{ $lead->id }}">
                                {{ Str::limit(@$lead->lead_detailss->lead_description, 20) }}
                            </a>
                        </td> --}}

                        <td class="px-1">
                            {{-- <img class="rounded-circle avatar-xs" src="{{URL::asset('public/assets/images/users/'.@$lead->users->image)}}" alt=""> --}}
                            {{ Str::limit(@$lead->users->name, 12) }}
                        </td>




                        @if ($sortedBy == 'created_at')
                            <td class="px-2">{{$lead->created_at}}</td>
                        @elseif ($sortedBy == 'updated_at')
                            <td class="px-2">{{$lead->updated_at}}</td>
                        @else
                            <td class="px-2">{{$lead->created_at}}</td>
                            <td class="px-2">{{$lead->updated_at}}</td>
                        @endif


                        <td class="px-1">
                            <a href="{{url('website/detail').'/'. $lead->id }}" class="btn btn-outline-info btn-sm detail" title="Detail">
                                <i class="fas fa-eye"> </i>
                            </a>
                            <a href="{{url('website_leads/edit').'/'. $lead->id }}" class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                <i class="fas fa-pencil-alt"> </i>
                            </a>
                            <a href="{{url('old_wlead_change_date').'/'. $lead->id }}" class="btn btn-outline-success btn-sm edit" title="Edit">
                                <i class="fas fa-eye"> </i>
                            </a>
                        </td>
                    </tr>


                    @endif
                @endforeach

            </tbody>
        </table>
    </div>
</div>


{{-- Portal --}}
@foreach ($pleads as $lead)
<div class="modal fade bs-example-modal-xl-plead-a-{{ $lead->id }}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Lead Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-rep-plugin">
                                <div class="table-responsive mb-0" data-pattern="priority-columns">
                                    <table id="tech-companies-1" class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Refrence Number :</th>
                                                <td>{{$lead->ref_no}}</td>
                                            </tr>
                                            <tr>
                                                <th>Inquiry</th>
                                                <td>{{$lead->inquiry}}</td>
                                            </tr>
                                            <tr>
                                                <th>Portal</th>
                                                <td>
                                                    @if ($lead->from == 'no-reply23@email.dubizzle.com')
                                                        Dubbizle
                                                    @elseif ($lead->from == 'no-reply@propertyfinder.ae')
                                                        Property finder
                                                    @elseif ($lead->from == 'noreply@bayut.com')
                                                        Bayut
                                                    @endif
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Full Name :</th>
                                                <td>{{$lead->name}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Mobile :</th>
                                                <td>{{$lead->phone}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">E-mail :</th>
                                                <td>{{$lead->email}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Agent Name :</th>
                                                <td>{{@$lead->users->name}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Location :</th>
                                                <td>{{$lead->location}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Property Detail :</th>
                                                <td>{{$lead->property_detail}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Property Location :</th>
                                                <td>{{$lead->property_location}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Last Update</th>
                                                <td>{{@$lead->lead_detailss->lead_description}}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>







                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
@endforeach



{{-- Campaign --}}
@foreach ($cleads as $lead)
    <div class="modal fade bs-example-modal-xl-clead-a-{{ $lead->id }}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Lead Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-rep-plugin mb-3">
                                <div class="table-responsive mb-0" data-pattern="priority-columns">
                                    <table id="tech-companies-1" class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Refrence Number :</th>
                                                <td>{{$lead->ref_no}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Campaign :</th>
                                                <td>{{$lead->campaigns->campaign_name}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Agent Name :</th>
                                                <td>{{@$lead->users->name}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Qualified Question :</th>
                                                <td>{{$lead->qualified_question}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Lead Source :</th>
                                                <td>{{$lead->lead_typess->type_name}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Full Name :</th>
                                                <td>{{$lead->full_name}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Mobile :</th>
                                                <td>{{$lead->phone}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Preferred Contact Number :</th>
                                                <td> {{$lead->preferred_number}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">E-mail :</th>
                                                <td>{{$lead->email}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Agent Feedback :</th>
                                                <td>{{@$lead->lead_detailss->lead_description}}</td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>






                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endforeach



{{-- Website --}}
@foreach ($wleads as $lead)
    <div class="modal fade bs-example-modal-xl-wlead-a-{{ $lead->id }}" tabindex="-1" role="dialog" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Lead Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-rep-plugin">
                                <div class="table-responsive mb-0" data-pattern="priority-columns">
                                    <table id="tech-companies-1" class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Refrence Number :</th>
                                                <td>{{$lead->ref_no}}</td>
                                            </tr>
                                            <tr>
                                                <th>Inquiry</th>
                                                <td>{{$lead->inquiry}}</td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Full Name :</th>
                                                <td>{{$lead->name}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Mobile :</th>
                                                <td>{{$lead->phone}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">E-mail :</th>
                                                <td>{{$lead->email}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Agent Name :</th>
                                                <td>{{@$lead->users->name}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Last Update:</th>
                                                <td>{{@$lead->lead_detailss->lead_description}}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endforeach



