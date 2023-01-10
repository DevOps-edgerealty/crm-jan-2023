<div class="table-responsive mb-0" data-pattern="priority-columns">
    <table id="tech-companies-1" class="table table-striped" style="font-size:12px;z-index: 100;">

        <thead>
        <tr>
            <th>Ref Number</th>
            <th style="width: 180px">Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Lead Source</th>
            <th>Inquiry</th>
            <th>Campaign</th>
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
                    <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $lead->id }}"> {{$lead->ref_no}}</a></td>
                    <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $lead->id }}"> {{$lead->full_name}}</a></td>
                    <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $lead->id }}"> {{$lead->email}}</a></td>
                    <td><span class="badge badge-soft-info font-size-12" onclick="this.innerHTML='{{$lead->phone}}'">Click To Show</span> </td>
                    <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $lead->id }}"> {{$lead->lead_typess->type_name}}</a></td>
                    <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $lead->id }}"> {{$lead->qualified_question}}</a></td>
                    <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $lead->id }}"> {{@$lead->campaigns->campaign_name}}</a></td>
                    <td>
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
                    <td >

                        {{ Str::limit(@$lead->lead_detailss->lead_description, 23) }}
                    </td>
                    <td>

                        @if (@$lead->users->image == '')
                            <img class="rounded-circle avatar-xs" src="{{URL::asset('public/assets/images/users/20220111103204.jpg')}}" alt="">
                            {{ Str::limit(@$lead->users->name, 12) }}

                        @else
                            <img class="rounded-circle avatar-xs" src="{{URL::asset('public/assets/images/users/'.@$lead->users->image)}}" alt="">
                            {{ Str::limit(@$lead->users->name, 12) }}

                        @endif

                    </td>
                    <td>{{date('d-m-Y', strtotime($lead->created_at));}}</td>


                    <td>
                        <a href="{{url('team/detail').'/'. $lead->id }}" class="btn btn-outline-info btn-sm edit" title="Detail" style="margin-right: 5px">
                            <i class="fas fa-eye"> </i>
                        </a>
                        {{-- <a href="{{url('leads/edit').'/'. $lead->id }}" class="btn btn-outline-secondary btn-sm edit" title="Edit">
                            <i class="fas fa-pencil-alt"> </i>
                        </a> --}}
                    </td>
                </tr>

            @endforeach


        </tbody>

    </table>
</div>
