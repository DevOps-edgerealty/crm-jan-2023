
@extends('layout.master')

@section('content')
<style>
    thead input {
        width: 100%;
    }

    .watermark{

        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 0;
        margin-top: 350px;
        color: #a1a1a1;
        font-size: 5rem;
        font-weight: 700;
        display: grid;
        justify-content: center;
        align-content: center;
        opacity: 0.2;
        transform: rotate(-30deg);

    }


    #panel {

    display: none;
    }
</style>

 <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Campaign Leads</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{URL('')}}">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Campaign Leads</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->



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

                            <div class="col-12">
                                <div class="card">
                                    <div class="row">
                                        <div class="watermark">{{Auth::user()->name}}</div>
                                    </div>
                                    <div class="card-body" style="position: relative">

                                        {{-- <input type = "button" value = "Print" onclick = "window.print()" /> --}}






                                        {{-- If User is an Admin --}}
                                        @if (Auth::user()->user_type == '1')

                                            <div class="row">
                                                <div class="col-lg-12 mb-3">

                                                    <a href="{{URL('/leads/create_leads')}}" class="btn btn-dark float-end"><i class="bx bx-filter-alt"> </i> Create Lead</a>

                                                </div>
                                                {{-- <div class="col-lg-4">
                                                    <form action="{{ URL('import') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <label for="">Excel Import</label>
                                                        <input type="file" name="file" class="form-control mb-2">
                                                        <input type="submit" class="btn btn-dark">

                                                    </form>
                                                </div> --}}
                                            </div>


                                            <p class="card-title-desc mb-2"></p>
                                            {{-- <h4 class="card-title mb-3">Search</h4> --}}






                                            {{-- Search bar --}}
                                            <div class="row mb-5">
                                                <div class="col-lg-12">
                                                    <form method="GET" action="{{url('leads/search')}}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="mb-3 row">
                                                            <label for="example-text-input" class="col-md-1 offset-md-2 col-form-label">Search</label>

                                                            <div class="col-md-6">
                                                                <input class="form-control" name="search" value="{{@$request->search}}" type="text" value="" placeholder="search" id="example-text-input">
                                                                <a id="flip" class="float-end mt-2 fw-bold  text-decoration-underline" style="color: #000" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"> Advance Search <i class="bx bx-search-alt-2"></i></a>
                                                            </div>

                                                        </div>
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
                                                                        <label for="lead_source" class="form-label">Select Status</label>
                                                                        <select class="form-select" name="lead_status">
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
                                                                        <select class="form-select" name="lead_source">
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
                                                                        <label for="lead_source" class="form-label">Select Campaign</label>
                                                                        <select class="form-select" name="campaigns">
                                                                            <option value="">Select Campaign</option>
                                                                            @if ($campaigns)
                                                                                @foreach ($campaigns as $campaign)
                                                                                    <option value="{{ $campaign->id}}">{{ $campaign->campaign_name }}</option>
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

                                                                {{--
                                                                <div class="col-md-2">
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

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 offset-md-3">
                                                                <button type="submit" class="btn btn-dark w-100">Search</button>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                            {{-- /Search bar --}}






                                            {{-- Data table --}}
                                            {{-- @include('leads.includes.show_leads_table') --}}
                                            <div class="table-rep-plugin" >

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
                                                                            <span class="badge badge-pill badge-soft-warning font-size-14 w-100">Not Contacted</span>
                                                                        @else
                                                                            @if (@$lead->lead_detailss->lead_status == '1')
                                                                                <span class="badge badge-pill badge-soft-success font-size-14 w-100">Inerested</span>
                                                                            @elseif (@$lead->lead_detailss->lead_status == '2')
                                                                                <span class="badge badge-pill badge-soft-danger font-size-14 w-100">Not Inerested</span>
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
                                                                        <a href="{{url('leads/detail').'/'. $lead->id }}" class="btn btn-outline-info btn-sm edit" title="Detail" style="margin-right: 5px">
                                                                            <i class="fas fa-eye"> </i>
                                                                        </a>
                                                                        <a href="{{url('leads/edit').'/'. $lead->id }}" class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                                                            <i class="fas fa-pencil-alt"> </i>
                                                                        </a>
                                                                    </td>
                                                                </tr>

                                                            @endforeach


                                                        </tbody>

                                                    </table>
                                                </div>
                                            </div>
                                            {{-- DATA TABLE --}}

                                            @foreach ($leads as $lead)
                                                <div class="modal fade bs-example-modal-xl-{{ $lead->id }}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">

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

                                        @else

                                        <div class="row mb-3">
                                            <div class="col-lg-12">
                                                <form method="GET" action="{{url('leads/search_agent')}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-1 offset-md-2 col-form-label">Search</label>
                                                        <div class="col-md-6">
                                                            <input class="form-control" name="search" type="text" value="" placeholder="search" id="example-text-input">

                                                            <a id="flip" class=" float-end mt-2 fw-bold  text-decoration-underline" style="color: #000" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-form">Advance Search</a>
                                                        </div>

                                                    </div>
                                                    <div id="panel">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="row">

                                                                    <div class="col-md-2">
                                                                        <div class="mb-3">
                                                                            <label for="ref_number" class="form-label">Ref Number</label>
                                                                            <input type="text" value="{{@$request->ref_number}}" name="ref_number" class="form-control" id="ref_number">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="mb-3">
                                                                            <label for="full_name" class="form-label">Full Name</label>
                                                                            <input type="text" {{@$request->full_name}} name="full_name" class="form-control" id="full_name">
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
                                                                            <label for="lead_source" class="form-label">Select Status</label>
                                                                            <select class="form-select" name="lead_status">
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
                                                                            <select class="form-select" name="lead_source">
                                                                                <option value="">Select Lead Source</option>
                                                                                @if ($lead_source)
                                                                                    @foreach ($lead_source as $source)
                                                                                        <option value="{{ $source->id}}">{{ $source->type_name }}</option>
                                                                                    @endforeach
                                                                                @endif
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <input type="hidden"  name="agent" value="{{Auth::user()->id}}">


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

                                        <div class="table-rep-plugin" >
                                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                <table id="tech-companies-1" class="table table-striped" style="font-size:12px">
                                                    <thead>
                                                    <tr>
                                                        <th>Ref Number</th>
                                                        <th>Campaign</th>
                                                        <th>Full Name</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Lead Status</th>
                                                        <th>Agent Feedback</th>
                                                        <th>Created Date</th>
                                                        <th>Detail</th>

                                                    </tr>
                                                    </thead>


                                                    <tbody>
                                                        @foreach ($leads as $lead)
                                                            <tr>
                                                                <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $lead->id }}">{{$lead->ref_no}}</a></td>
                                                                <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $lead->id }}">{{@$lead->campaigns->campaign_name}}</a></td>
                                                                <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $lead->id }}">{{$lead->full_name}}</a></td>
                                                                <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $lead->id }}">{{$lead->email}}</a></td>
                                                                <td><span class="badge badge-soft-info font-size-12" onclick="this.innerHTML='{{$lead->phone}}'">Click To Show</span> </td>

                                                                <td>
                                                                    @if ($lead->lead_detailss == '')
                                                                        <span class="badge badge-pill badge-soft-warning font-size-14 w-100">Not Contacted</span>
                                                                    @else
                                                                        @if (@$lead->lead_detailss->lead_status == '1')
                                                                            <span class="badge badge-pill badge-soft-success font-size-14 w-100">Inerested</span>
                                                                        @elseif (@$lead->lead_detailss->lead_status == '2')
                                                                            <span class="badge badge-pill badge-soft-danger font-size-14 w-100">Not Inerested</span>
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

                                                                    {{ Str::limit(@$lead->lead_detailss->lead_description, 40) }}
                                                                </td>
                                                                <td>{{date('d-m-Y', strtotime($lead->created_at));}}</td>

                                                                <td>
                                                                    <a href="{{url('leads/detail').'/'. $lead->id }}" class="btn btn-outline-info btn-sm edit" title="Detail">
                                                                        <i class="fas fa-eye"> </i>
                                                                    </a>

                                                                </td>

                                                            </tr>
                                                        @endforeach


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        @foreach ($leads as $lead)

                                            <div class="modal fade bs-example-modal-xl-{{ $lead->id }}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
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

                                        @endif
                                        {!! $leads->appends($_GET)->links() !!}
                                        {{ $leads->firstItem() }} - {{ $leads->lastItem() }} Total Leads {{$leads->total()}}


                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © Edge Realty.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Design & Develop by Edge Realty
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->
            <script>
             $(document).ready(function(){
                $("#flip").click(function(){
                    $("#panel").slideToggle("slow");
                });
            });
            $().DataTable();
            </script>


@endsection


