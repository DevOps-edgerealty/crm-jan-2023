
@extends('layout.master')

@section('content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row  mx-5">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Target Management</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{URL('')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="{{URL('users')}}">Staff Accounts</a></li>
                                <li class="breadcrumb-item active">Team Management</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->



            <div class="row mx-5">
                @if(session()->has('message'))
                <div class="col-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-all me-2"></i>
                        {{ session()->get('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>


                @elseif(session()->has('error'))
                <div class="col-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-alert-outline me-2"></i>
                        {{ session()->get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>


                @elseif(session()->has('error-member'))
                <div class="col-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-alert-outline me-2"></i>
                            Validation error - This user ({{ session()->get($user->name) }}) is already assigned to
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>


                @elseif(session()->has('error-team'))
                <div class="col-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-alert-outline me-2"></i>
                            Validation error - Failed to Assign team
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-all me-2"></i>
                            The Team has been created successfully
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-all me-2"></i>
                            The Leader has been assigned successfully
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif
                <div class="col-md-12 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{URL('/users/create-team')}}" class="btn btn-outline-dark float-end mx-2" data-bs-toggle="modal" data-bs-target="#create_team">
                                <i class="bx bx-group"> </i> Create a New Team
                            </a>
                            <h3 class="">Assign Targets for Agents</h3>
                            <p class="card-title-desc mb-5">You can manage your targets for each sales agent from here.</p>

                            <div class="table-rep-plugin">
                                <div class="table-responsive mb-0" data-pattern="priority-columns">
                                    <table id="tech-companies-1" class="table border">
                                        <thead>
                                        <tr class="shadow-sm border">
                                            <th>#</th>
                                            <th>Name</th>
                                            <th class="text-center align-middle">Target for {{ date('F')}} </th>
                                            <th class="text-center align-middle">Achieved</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($agents as $data)
                                            {{-- {{ \Carbon\Carbon::parse(@$data->targets->created_at)->format('m') }} --}}

                                                @if( \Carbon\Carbon::parse(@$data->targets->created_at)->format('m')  == now()->format('m') )
                                                    <tr class="my-auto">
                                                        <form method="POST" action="{{url('/update-targets')}}" enctype="multipart/form-data">
                                                            @csrf
                                                            <td class="w-auto text-center " style="width: 200px !important;">
                                                                <div class="d-flex align-items-center">
                                                                    &nbsp;
                                                                    <div class="avatar-xs me-3">
                                                                        <span class="avatar-title rounded-circle bg-warning bg-soft text-dark font-size-18">
                                                                            {{ $loop->iteration }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <input type="int" value="{{$data->id}}" name="agent_id" hidden/>
                                                            <input type="int" value="{{@$data->targets->id}}" name="id" hidden/>

                                                            @if($data->year != '' || $data->year != null)
                                                                <input type="int" value="{{$data->year}}" name="year" hidden/>
                                                            @else
                                                                <input type="int" value="0" name="year" hidden/>
                                                            @endif

                                                            @if($data->month != '' || $data->month != null)
                                                                <input type="int" value="{{$data->month}}" name="month" hidden/>
                                                            @else
                                                                <input type="int" value="0" name="month" hidden/>
                                                            @endif

                                                            <td class=" align-middle fw-bold" style="width: 400px !important;">
                                                                {{$data->name}}
                                                            </td>

                                                            <td class="text-center align-middle fw-bold">
                                                                @if($data->targets != '')
                                                                    AED &nbsp<input type="number" value="{{ number_format(@$data->targets->target) }}"
                                                                    placeholder="{{ number_format(@$data->targets->target) }}" name="target"
                                                                    class="rounded-pill border-1 border-dark text fs-6"/>
                                                                @else
                                                                    AED &nbsp; <input type="number" value="" placeholder="0" name="target" class="rounded-pill border-1 border-dark text fs-6"/>
                                                                @endif

                                                            </td>

                                                            <td class="text-center align-middle fw-bold">
                                                                @if(count($leaderboard_data) > 0 )
                                                                    @foreach($leaderboard_data as $data2)
                                                                        @if($data2->agent_id == $data->id)
                                                                            @if($data2->totalcommission != '')
                                                                                AED &nbsp; {{ number_format($data2->totalcommission) }}
                                                                            @else
                                                                                AED 0
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    AED 0
                                                                @endif
                                                            </td>

                                                            <td class="text-center align-middle">
                                                                <button type="submit" class="btn btn-outline-secondary mx-1 ">
                                                                    <i class="bx bxs-save"> </i>
                                                                </button>
                                                            </td>

                                                        </form>
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

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>


@endsection
