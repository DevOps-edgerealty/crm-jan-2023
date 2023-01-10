
@extends('layout.master')

@section('content')


<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row  mx-5">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Staff Accounts</h4>

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
                            <h3 class="">Team Management</h3>
                            <p class="card-title-desc mb-5">You can manage your teams here by updating, deleting and creating.</p>

                            <div class="table-rep-plugin">
                                <div class="table-responsive mb-0" data-pattern="priority-columns">
                                    <table id="tech-companies-1" class="table border">
                                        <thead>
                                        <tr class="shadow border">
                                            <th>#</th>
                                            <th>Name</th>
                                            <th class="text-center align-middle">Team Leader</th>
                                            <th class="text-center align-middle">Created At</th>
                                            <th class="text-center align-middle" >Updated At</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($team as $data)
                                                <tr class="my-auto">
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
                                                    <td class=" align-middle" style="width: 400px !important;">
                                                        {{$data->name}}
                                                    </td>

                                                    <td class="text-center align-middle">
                                                        @foreach($users as $data2)
                                                            @if($data2->team_id == $data->id && $data2->team_leader == 1)
                                                                {{$data2->name}}
                                                            @endif
                                                        @endforeach
                                                    </td>

                                                    <td class="text-center align-middle" style="width: 400px !important;">
                                                        {{$data->created_at}}
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        {{ $data->updated_at}}
                                                    </td>


                                                    <td class="text-center align-middle">
                                                        <a href="#" class="btn btn-outline-dark mx-2" data-bs-toggle="modal" data-bs-target="#edit_team_{{$data->id}}">
                                                            <i class="bx bx-pencil"> </i> Edit
                                                        </a>
                                                        <a href="#" class="btn btn-outline-danger mx-2  " data-bs-toggle="modal" data-bs-target="#delete_team_{{$data->id}}">
                                                            <i class="bx bx-trash"> </i>
                                                        </a>
                                                    </td>
                                                </tr>
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




    <!-- new team modal -->
    <div id="create_team" class="modal fade" tabindex="-1" aria-labelledby="modal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="target_modal">
                        New Team
                    </h4>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>

                <form class="form-control" method="POST" action="{{url('users/create-team') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-4">
                            <label for="team_name" class="col-sm-3 col-form-label text-left">
                                Team Name
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control bg-white" name="team_name" placeholder="Enter a name for the Team"></input>
                            </div>
                        </div>

                        <div class="row">
                            <label for="team_leader" class="col-sm-3 col-form-label text-left">
                                Team Leader
                            </label>
                            <div class="col-sm-9">
                                <select class="form-select w-100" name="team_leader" id="team_leader" required>
                                    <option value="">Select a Team Leader</option>
                                    @if(@isset($users))
                                        @foreach($users as $data)
                                            @if($data->team_leader == 1)
                                                <option value="{{$data->id}}" class="bg-dark text-white" disabled >{{$data->name}} (assigned)</option>
                                            @else
                                                <option value="{{$data->id}}">{{$data->name}} </option>
                                            @endif
                                        @endforeach
                                    @endisset

                                </select>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">
                            Close
                        </button>
                            <button type="submit" class="btn btn-danger btn-lg waves-effect waves-light">
                                Confirm
                            </button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


    {{-- Edit Team --}}
    @foreach($team as $data)
        <div id="edit_team_{{$data->id}}" class="modal fade" tabindex="-1" aria-labelledby="modal" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="target_modal">
                            Edit Team
                        </h4>
                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>

                    <form method="POST" action="{{url('team/update-team/'.$data->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row mb-4">

                                <label for="team_name" class="col-sm-3 col-form-label text-left">
                                    Team Name
                                </label>

                                <div class="col-sm-9">

                                    <input type="text" value="{{ $data->name }}" class="form-control bg-white" name="team_name" placeholder="{{ $data->name }}"></input>

                                </div>

                            </div>

                            <div class="row">

                                <label for="team_leader" class="col-sm-3 col-form-label text-left">
                                    Team Leader
                                </label>

                                <div class="col-sm-9">

                                    <select class="form-select w-100" name="team_leader" id="team_leader" required>

                                        <option value=""></option>

                                        @if(@isset($users))

                                            @foreach($users as $data3)

                                                @if($data3->team_id == $data->id && $data3->team_leader == 1 )

                                                    <option selected value="{{$data3->id}}"hidden>
                                                        {{$data3->name}}2
                                                    </option>

                                                    <option selected value="{{$data3->id}}" >
                                                        {{$data3->name}}
                                                    </option>



                                                    {{-- <input type="text" name="olde_leader" value="{{$data->id}}" hidden class="hidden"> --}}

                                                @else

                                                    <option value="{{$data3->id}}">
                                                        {{$data3->name}}
                                                    </option>

                                                @endif

                                            @endforeach

                                        @endisset

                                    </select>
                                </div>
                            </div>

                            @if(@isset($users))

                                @foreach($users as $data3)

                                    @if($data3->team_id == $data->id && $data3->team_leader == 1 )

                                        <input type="text" name="old_leader" value="{{$data3->id}}" hidden class="hidden">

                                    @endif

                                @endforeach

                            @endisset


                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success  waves-effect waves-light">
                                Submit
                            </button>
                            <button type="button" class="btn btn-outline-secondary waves-effect" data-bs-dismiss="modal">
                                Close
                            </button>

                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    @endforeach






    {{-- Delete Team --}}
    @foreach($team as $data)
        <div id="delete_team_{{$data->id}}" class="modal fade" tabindex="-1" aria-labelledby="modal" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header bg-white">
                        <h4 class="modal-title text-dark" id="target_modal">
                            Delete Team
                        </h4>
                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>

                    <form class="form-control" method="POST" action="{{url('team/delete-team/'.$data->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row mb-">

                                <label class="col-sm-12 col-form-label font-size-16 text-center">
                                    Confirm to delete
                                </label>
                                <label class="col-sm-12 col-form-label font-size-24 text-center">
                                    {{ $data->name }}
                                </label>
                            </div>

                        </div>

                        @if(@isset($users))

                            @foreach($users as $data3)

                                @if($data3->team_id == $data->id && $data3->team_leader == 1 )

                                    <input type="text" name="old_leader" value="{{$data3->id}}" hidden class="hidden">

                                @endif

                            @endforeach

                        @endisset
                        <div class="modal-footer mx-auto text-center">

                            <button type="submit" class="btn btn-danger waves-effect waves-light mx-auto">
                                Delete!
                            </button>

                            <button type="button" class="btn btn-outline-secondary waves-effect mx-auto" data-bs-dismiss="modal">
                                Cancel
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




@endsection
