<div class="table-rep-plugin" >

    <div class="table-responsive mb-0" data-pattern="priority-columns">
        <table id="tech-companies-1" class="table table-striped" style="font-size:12px;z-index: 100;">

                <thead>
                    <tr>
                        <th>Ref Number</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Inquiry</th>
                        <th>Portal Name</th>
                        <th>Lead Status</th>
                        <th>Agent Feedback</th>
                        <th>Agent Name</th>
                        <th>Created Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>


            <tbody>
                @foreach ($leads as $lead)
                    <tr>
                        <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $lead->id }}">{{$lead->ref_no}}</a></td>
                        <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $lead->id }}">{{$lead->name}}</a></td>
                        <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $lead->id }}">{{ Str::limit($lead->email, 25) }}</a></td>

                        <td><span class="badge badge-soft-info font-size-12" onclick="this.innerHTML='{{$lead->phone}}'">Click To Show</span> </td>

                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $lead->id }}">
                                {{ Str::limit(@$lead->inquiry, 25) }}
                            </a>
                        </td>
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $lead->id }}">
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
                            @if ($lead->lead_detailss == '')
                                <span class="badge badge-pill badge-soft-warning font-size-14 w-100">Not Contacted</span>
                            @else
                                @if (@$lead->lead_detailss->lead_status == '1')
                                    <span class="badge badge-pill badge-soft-success font-size-14 w-100">Interested</span>
                                @elseif (@$lead->lead_detailss->lead_status == '2')
                                    <span class="badge badge-pill badge-soft-danger font-size-14 w-100">Not Interested</span>
                                @elseif (@$lead->lead_detailss->lead_status == '3')
                                    <span class="badge badge-pill badge-soft-info font-size-14 w-100">No Answer</span>
                                @elseif (@$lead->lead_detailss->lead_status == '4')
                                    <span class="badge badge-pill badge-soft-primary font-size-14 w-100">Contacted</span>
                                @elseif (@$lead->lead_detailss->lead_status == '5')
                                    <span class="badge badge-pill badge-soft-warning font-size-14 w-100">Not Contacted</span>
                                @elseif (@$lead->lead_detailss->lead_status == '6')
                                    <span class="badge badge-pill badge-soft-success font-size-14 w-100">Deal</span>

                                @endif
                            @endif


                        </td>
                        <td>
                            {{ Str::limit(@$lead->lead_detailss->lead_description, 25) }}
                        </td>

                        <td >

                            <img class="rounded-circle avatar-xs" src="{{URL::asset('public/assets/images/users/'.@$lead->users->image)}}" alt="">
                            {{ Str::limit(@$lead->users->name, 15) }}
                        </td>




                        <td>{{date('d-m-Y', strtotime($lead->created_at));}}</td>


                        <td>
                            <a href="{{url('/team/portal_leads/detail').'/'. $lead->id }}" class="btn btn-outline-info btn-sm edit" title="Detail" style="margin-right: 5px">
                                <i class="fas fa-eye"> </i>
                            </a>

                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
</div>
