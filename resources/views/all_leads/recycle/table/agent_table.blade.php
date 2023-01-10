



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
                            <thead class="shadow-sm border">
                                <tr>
                                    <th>Ref Number</th>     
                                    {{-- <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone</th> --}}
                                    <th>Lead Type</th>
                                    <th>Lead Source</th>
                                    <th>Inquiry</th>
                                    {{-- <th>Agent Name</th> --}}
                                    <th>Agent Feedback</th>
                                    {{-- <th>Agent</th> --}}
                                    <th>Actions</th>
                                </tr>
                            </thead>



                            <tbody>
                                @foreach ($leads as $lead)

                                     {{-- Portal Leads --}}
                                    @if(substr(@$lead->ref_no, 0, 2) == 'PL')
                                    <tr>
                                        <td class="px-0"><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-a-{{ $lead->id }}">{{$lead->ref_no}}</a></td>

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
                                                {{ @$lead->inquiry }}
                                            </a>
                                        </td>

                                        {{-- <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $lead->id }}">{{$lead->lead_status}}</a></td> --}}
                                        <td> <!-- agent_feedback -->
                                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-a-{{ $lead->id }}">
                                                {{ @$lead->lead_detailss->lead_description }}
                                            </a>
                                        </td>

                                        <td class="px-1 text-center">

                                            <a href="{{url('property_listing_leads/transfer/'.$lead->id)}}" class="btn btn-outline-secondary btn-sm Transfer" title="Transfer">
                                                <i class="fas fa-sync"> </i>
                                            </a>
                                        </td>
                                    </tr>







                                    {{-- Campaign leads --}}
                                    @elseif(substr(@$lead->ref_no, 0, 2) == 'CL')
                                    <tr>
                                        <td class="px-0"><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-clead-a-{{ $lead->id }}">{{$lead->ref_no}}</a></td>

                                        <td class="text-left px-0" style="width: 100px;" >
                                            <span class="badge badge-pill bg-info font-size-12"><i class="fab fa-facebook text-white"></i></i></span> Campaign
                                        </td>

                                        <td> <!-- portal name -->
                                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-clead-a-{{ $lead->id }}">
                                                {{@$lead->campaigns->campaign_name}}
                                            </a>
                                        </td>

                                        <td>
                                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-clead-a-{{ $lead->inquiry }}">
                                                {{ @$lead->inquiry }}
                                            </a>
                                        </td>

                                        {{-- <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $lead->id }}">{{$lead->lead_status}}</a></td> --}}
                                        <td> <!-- agent_feedback -->
                                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-clead-a-{{ $lead->id }}">
                                                {{ @$listing->lead_detailss->lead_description }}
                                            </a>
                                        </td>


                                        <td class="px-1 text-center">


                                            <a href="{{('leads/transfer/'.$lead->id)}}" class="btn btn-outline-secondary btn-sm Transfer" title="Transfer">
                                                <i class="fas fa-sync"> </i>
                                            </a>
                                        </td>
                                    </tr>






                                    {{-- Website leads --}}
                                    @elseif(substr(@$lead->ref_no, 0, 2) == 'WL')
                                    <tr>
                                        <td class="px-0"><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-wlead-a-{{ $lead->id }}">{{$lead->ref_no}}</a></td>

                                        <td class="text-left px-0" style="width: 100px;" >
                                            <span class="badge badge-pill bg-dark font-size-12"><i class="fas fa-globe-asia text-white"></i></i></span> Website
                                        </td>

                                        <td> <!-- portal name -->
                                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-wlead-a-{{ $lead->id }}">
                                                {{@$lead->source}}
                                            </a>
                                        </td>

                                        <td>
                                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-wlead-a-{{ $lead->inquiry }}">
                                                {{ @$lead->inquiry }}
                                            </a>
                                        </td>

                                        <td class="px-1"> <!-- agent_feedback -->
                                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-wlead-a-{{ $lead->id }}">
                                                {{ @$lead->lead_detailss->lead_description }}
                                            </a>
                                        </td>

                                        <td class="px-1 text-center">
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
