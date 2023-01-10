
@extends('layout.master')

@section('content')

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
                                    <h4 class="mb-sm-0 font-size-18">Leaderboard</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{URL('')}}">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Leaderboard</li>
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
                            @elseif(session()->has('error'))
                            <div class="col-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-alert-outline me-2"></i>
                                    {{ session()->get('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                            @endif
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        @if (Auth::user()->user_type == '1')
                                            <a href="{{URL('/leader_board/create_leader')}}" class="btn btn-dark float-end"  data-bs-toggle="modal" data-bs-target="#add_leader">
                                                <i class="bx bx-filter-alt"> </i> Add New Leader
                                            </a>
                                        @endif
                                        <h4 class="card-title">Leaderboard Ranking</h4>
                                        <p class="card-title-desc mb-5"></p>
                                        @if (Auth::user()->user_type == '1')
                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap table-hover border">
                                                <thead class="table-white shadow-sm">
                                                    <tr>
                                                        <th scope="col">Rank</th>
                                                        <th scope="col" span="1" style="width: 4%;">Agents</th>
                                                        <th scope="col" ></th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($leader_board as $data)
                                                        <tr>
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
                                                            <td>
                                                                <div>
                                                                    @foreach($agents as $agent)
                                                                        @if($agent->id == $data->agent_id)
                                                                            <img class="rounded-circle avatar-sm" src="{{URL::asset('public/assets/images/users/'.$agent->image)}}" alt="">
                                                                        @endif
                                                                    @endforeach
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <h5 class="font-size-14 mb-1"><a href="{{url('leader_board/detail').'/'. $data->id }}" class="text-dark">{{$data->name}}</a></h5>
                                                                <p class="text-muted mb-0">{{$data->office}}</p>
                                                            </td>

                                                            <td>
                                                                <div>
                                                                    <a href="javascript: void(0);" class="badge badge-soft-success text-secondary font-size-14 m-1">
                                                                                {{ number_format($data->totalcommission) }} AED

                                                                                {{-- {{ $leader_board }} --}}

                                                                        {{-- @foreach($leader_board as $data2)
                                                                            @if($data2->agent_id == $data->agent_id)

                                                                                @if ($data2->totalcommission == '')
                                                                                    0 AED
                                                                                @else
                                                                                    {{ number_format($data->totalcommission) }} AED
                                                                                @endif
                                                                            @endif
                                                                        @endforeach --}}




                                                                    </a>

                                                                </div>
                                                            </td>

                                                            <td>
                                                                <ul class="list-inline font-size-20 contact-links mb-0">

                                                                    <li class="list-inline-item px-2">
                                                                        <a href="{{url('leader_board/detail').'/'. $data->id }}" title="View Profile"><i class="bx bx-user-circle"></i></a> |
                                                                        <a href="#" class="pe-auto" title="Edit Agent Info" data-bs-toggle="modal" data-bs-target="#delete_leader-{{$data->id}}">
                                                                            <i class="bx bx-trash"></i>
                                                                        </a>
                                                                        {{-- <a href="{{URL('/leader_board/detail/edit_leader/'.$data->id)}}" title="Edit Agent Info" ><i class="bx bx-edit"></i></a> --}}
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    @endforeach


                                                </tbody>
                                            </table>
                                        </div>
                                        @else
                                        <div class="table-responsive">
                                            <table class="table table-hover table-striped">
                                                <thead class="table-white shadow-sm ">
                                                    <tr>
                                                        <th></th>
                                                        <th scope="col">Rank</th>
                                                        <th></th>
                                                        <th scope="col" span="1" style="width: 4%;">Agents</th>
                                                        <th scope="col" ></th>
                                                        {{-- <th scope="col">Amount</th> --}}
                                                        <th scope="col">Office</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($leader_board as $data)
                                                        <tr>
                                                            <td></td>
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
                                                            <td></td>
                                                            <td>
                                                                <div>
                                                                    @foreach($agents as $agent)
                                                                        @if($agent->id == $data->agent_id)
                                                                            <img class="rounded-circle avatar-sm" src="{{URL::asset('public/assets/images/users/'.$agent->image)}}" alt="">
                                                                        @endif
                                                                    @endforeach
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <h5 class="font-size-14 mb-1"><a href="" class="text-dark">{{$data->name}}</a></h5>
                                                            </td>
                                                            <td>
                                                                <p class="text-muted mb-0">{{$data->office}}</p>
                                                            </td>

                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                        @endif

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->





                <!-- new leaderboard modal -->
                <div id="add_leader" class="modal fade" tabindex="-1" aria-labelledby="modal" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="target_modal">
                                    New Leader
                                </h4>
                                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close">

                                </button>
                            </div>

                            <form class="form-control" method="POST" action="{{url('leader_board/store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="row mb-4">
                                        <label for="team_name" class="col-sm-3 col-form-label text-left">
                                            Select the leader
                                        </label>
                                        <div class="col-sm-9">
                                            {{-- <input type="text" class="form-control bg-white" name="team_name" placeholder="Enter a name for the Team"></input> --}}
                                            <select class="form-select w-100" name="agent" required>
                                                <option value="">Select an agent</option>
                                                    @if ($agents!=null)
                                                        @foreach ($agents as $agent)
                                                            <option value="{{ $agent->id}}">{{ $agent->name }}</option>
                                                        @endforeach
                                                    @endif
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-dark waves-effect" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="submit" class="btn btn-dark waves-effect waves-light">
                                        Confirm
                                    </button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>



                <!-- delete leaderboard modal -->
                @foreach($leader_board as $data)
                    <div id="delete_leader-{{$data->id}}" class="modal fade" tabindex="-1" aria-labelledby="modal" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md">
                            <div class="modal-content">
                                <div class="modal-header bg-dark">
                                    <h4 class="modal-title text-white" id="target_modal">
                                        Delete Leader?
                                    </h4>
                                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close">

                                    </button>
                                </div>

                                <form class="form-control" method="POST" action="{{url('leader_board/delete/'.$data->id)}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row mb-">

                                            <label class="col-sm-12 col-form-label font-size-16 fw-bolder text-center">
                                                Are you sure you want to delete?
                                            </label>
                                            <label class="col-sm-12 col-form-label font-size-24 text-center">
                                                {{ $data->name }}
                                            </label>
                                            <label class="col-sm-12 col-form-label font-size-10 text-center">
                                                This will remove the agent from the leadboard only
                                            </label>

                                        </div>

                                    </div>
                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-outline-dark waves-effect" data-bs-dismiss="modal">
                                            Cancel
                                        </button>
                                        <button type="submit" class="btn btn-danger waves-effect waves-light">
                                            Delete!
                                        </button>
                                    </div>
                                </form>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
                @endforeach



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


@endsection
