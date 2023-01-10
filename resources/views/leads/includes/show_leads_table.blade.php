
{{-- <form method="POST" action="#" enctype="multipart/form-data"> --}}
<form method="POST" action="#" enctype="multipart/form-data">
    @csrf

    @if (Auth::user()->user_type == '1')
    <div class="row gy-3 align-items-center">

        <div class="col-md-auto"><h4 class="card-title">Listings</h4></div>
        <div class="col-md-auto">
            <select class="form-select" name="mass_action">
                <option value="" disabled>Mass Update Action</option>
                <option value="recycle">Recycle</option>
                {{-- <option value="thrash" disabled>Thrash</option> --}}
            </select>
        </div>
        <div class="col-md-auto"><button class="btn btn-block btn-dark" type="submit">Submit</button></div>



    </div>
    @endif



    <hr>

    <div class="row" >
        <div class="col-sm-12">
            <table id="datatable" class="table table-striped dt-responsive nowrap w-100 dataTable no-footer dtr-inline" role="grid" aria-describedby="datatable_info" style="max-width: 100px;">
                <thead>
                    <tr role="row">
                        <th></th>
                        <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 122px;" aria-sort="ascending" aria-label="Id: activate to sort column descending">
                            REF NO.
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 191px;" aria-label="Purpose: activate to sort column ascending">
                            FULL NAME
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 87px;" aria-label="EMAIL: activate to sort column ascending">
                            EMAIL
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 35px;" aria-label="PHONE: activate to sort column ascending">
                            PHONE
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 79px;" aria-label="LEAD SOURCE: activate to sort column ascending">
                            LEAD SOURCE
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 59px;" aria-label="INQUIRY: activate to sort column ascending">
                            INQUIRY
                        </th>
                        <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 122px;" aria-sort="ascending" aria-label="CAMPAIGN: activate to sort column descending">
                            CAMPAIGN
                        </th>
                        <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 122px;" aria-sort="ascending" aria-label="LEAD STATUS: activate to sort column descending">
                            LEAD STATUS
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 191px;" aria-label="AGENT FEEDBACK: activate to sort column ascending">
                            AGENT FEEDBACK
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 87px;" aria-label="AGENT NAME: activate to sort column ascending">
                            AGENT NAME
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 35px;" aria-label="UPDATED DATE: activate to sort column ascending">
                            UPDATED DATE
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 79px;" aria-label="ACTIONS: activate to sort column ascending">
                            ACTIONS
                        </th>

                    </tr>
                </thead>


                <tbody>
                    @foreach ($leads as $listing)
                        <tr class="odd">
                            <td><input class="form-check-input" type="checkbox" id="{{ $listing->id }}" name="lead_checkbox[]" value="{{ $listing->id }}"></td>
                            <td class="sorting_1 dtr-control"><a href="#" data-bs-toggle="modal"data-bs-target=".bs-example-modal-xl-{{ $listing->id }}"> {{$listing->ref_no}}</a></td>
                            <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $listing->id }}"> {{$listing->full_name}}</a></td>
                            <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $listing->id }}"> {{ Str::limit(@$listing->email, 20) }}</a></td>
                            <td><span class="badge badge-soft-info font-size-12" onclick="this.innerHTML='{{$listing->phone}}'">Click To Show</span> </td> <!-- phone -->

                            {{-- <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal3-xl-{{ $listing->id }}">{{$listing->phone}}</a> </td> --}}
                            <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $listing->id }}"> {{$listing->lead_typess->type_name}}</a></td> <!-- lead source -->
                            <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $listing->id }}"> {{Str::limit(@$listing->qualified_question, 10) }}</a></td> <!-- inquiry -->
                            <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $listing->id }}"> {{@$listing->campaigns->campaign_name}}</a></td> <!-- campaign -->


                            <td> <!-- lead_status -->

                                @if ($listing->lead_detailss == '')
                                    <span class="badge badge-pill badge-soft-warning font-size-14">Not Contacted</span>
                                @else
                                    @if (@$listing->lead_detailss->lead_status == '1')
                                        <span class="badge badge-pill badge-soft-success font-size-14">Inerested</span>
                                    @elseif (@$listing->lead_detailss->lead_status == '2')
                                        <span class="badge badge-pill badge-soft-danger font-size-14">Not Inerested</span>
                                    @elseif (@$listing->lead_detailss->lead_status == '3')
                                        <span class="badge badge-pill badge-soft-info font-size-14">No Answer</span>
                                    @elseif (@$listing->lead_detailss->lead_status == '4')
                                        <span class="badge badge-pill badge-soft-primary font-size-14">Contacted</span>
                                    @elseif (@$listing->lead_detailss->lead_status == '5')
                                        <span class="badge badge-pill badge-soft-warning font-size-14">Not Contacted</span>
                                    @elseif (@$listing->lead_detailss->lead_status == '6')
                                        <span class="badge badge-pill badge-soft-success font-size-14">Deal</span>
                                    @endif
                                @endif
                            </td>

                            <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $listing->id }}">
                                {{ Str::limit(@$listing->lead_detailss->lead_description, 23) }}
                            </a></td> <!-- agent_feedback -->

                            <td>

                                @if (@$listing->users->image == '')
                                    <img class="rounded-circle avatar-xs" src="{{URL::asset('public/assets/images/users/20220111103204.jpg')}}" alt="">
                                    {{ Str::limit(@$listing->users->name, 12) }}

                                @else
                                    <img class="rounded-circle avatar-xs" src="{{URL::asset('public/assets/images/users/'.@$listing->users->image)}}" alt="">
                                    {{ Str::limit(@$listing->users->name, 12) }}

                                @endif

                            </td>
                            <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal3-xl-{{ $listing->id }}"> {{date('d-m-Y', strtotime($listing->updated_at));}}</a></td>
                            <td>
                                <a href="{{url('leads/detail').'/'. $listing->id }}" class="btn btn-outline-info btn-sm edit" title="Detail" style="margin-right: 5px">
                                    <i class="fas fa-eye"> </i>
                                </a>
                                <a href="{{url('leads/edit').'/'. $listing->id }}" class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                    <i class="fas fa-pencil-alt"> </i>
                                </a>
                            </td>
                            {{-- <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal3-xl-{{ $listing->id }}"> {{$listing->photos}}</a></td>
                            <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal3-xl-{{ $listing->id }}"> {{$listing->updated_at}}</a></td>
                            <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal3-xl-{{ $listing->id }}"> {{$listing->status}}</a></td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</form>


<script>
    // $().DataTable();
    $(document).ready(function() {
        $('#datatable').DataTable( {
            select: true
        } );
    } );

</script>
