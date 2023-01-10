
@extends('layout.master')

@section('content')

 <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
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
                                            <li class="breadcrumb-item active">Staff Accounts</li>
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

                                        <a href="{{ URL('/team/manage-team') }}" class="btn btn-outline-info float-end mx-2" >
                                            <i class="bx bx-cog"> </i>
                                            Team Management
                                        </a>

                                        <a href="{{URL('/users/create_user')}}" class="btn btn-outline-dark float-end">
                                            <i class="bx bx-user-plus"> </i>
                                            Create a New User
                                        </a>

                                        <a href="{{ URL('/manage-targets') }}" class="btn btn-outline-pink float-end mx-2" >
                                            <i class="bx bx-target-lock text-pink"> </i>
                                            Agent-Target Setting
                                        </a>



                                        <h3 class="">Staff Management</h3>

                                        <p class="card-title-desc mb-5">The best place to manage your staff CRM profiles. Team assigning can be done here with ease.</p>

                                        <div class="table-rep-plugin">
                                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                <table id="tech-companies-1" class="table border">
                                                    <thead>
                                                    <tr class="shadow border">
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Position</th>
                                                        <!--<th>Team Role</th>-->
                                                        <th>Assigned To</th>
                                                        <th>Status</th>
                                                        <th class="text-center">Actions</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach ($user as $users)
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
                                                                <div class="row">
                                                                    <div class="col-md-6" style="width: 100px !important;">
                                                                        <img class="rounded-circle avatar-sm" src="{{URL::asset('public/assets/images/users/'.$users->image)}}" alt="">
                                                                    </div>
                                                                    <div class="col-md-6" style="width: 200px !important;">
                                                                        {{$users->name}}
                                                                    </div>
                                                                </div>
                                                                </td>

                                                                <td class=" align-middle" style="width: 200px !important;">
                                                                    {{$users->email}}
                                                                </td>
                                                                <td class=" align-middle" style="width: 400px !important;">
                                                                    {{$users->position}}
                                                                </td>
                                                                <!--<td class="align-middle" style="width: 200px !important;">-->
                                                                <!--    @if($users->user_type == 1)-->
                                                                <!--        Management-->
                                                                <!--    @elseif ($users->user_type == 2)-->
                                                                <!--        @if($users->team_leader == 1)-->
                                                                <!--            Team Leader-->
                                                                <!--        @else-->
                                                                <!--            Agent-->
                                                                <!--        @endif-->
                                                                <!--    @else-->
                                                                <!--        <span class="text-light">Not Assigned</span>-->
                                                                <!--    @endif-->
                                                                <!--</td>-->
                                                                {{-- <td class="text-center">
                                                                    @if (!empty($users->target))
                                                                        <button type="button" class="btn btn-warning btn-rounded waves-effect waves-light px-5" data-bs-toggle="modal" data-bs-target="#target_modal-{{$users->id}}">{{$users->target}}</button>
                                                                    @else
                                                                        <button type="button" class="btn btn-dark btn-rounded waves-effect waves-light px-5" data-bs-toggle="modal" data-bs-target="#target_modal-{{$users->id}}">Not Assigned</button>
                                                                    @endif

                                                                    <!-- Vertically centered modal -->
                                                                    <div id="target_modal-{{$users->id}}" class="modal fade" tabindex="-1" aria-labelledby="modal" style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header bg-dark">
                                                                                    <h4 class="modal-title text-light" id="target_modal">Agent Target for the month of {{date('M')}}</h4>
                                                                                    <button type="button" class="btn-close bg-secondary" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <form class="needs-validation was-validated" method="POST" action="{{url('users/targets').'/'. $users->id }}" enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <div class="modal-body">
                                                                                        <div class="row mb-4">
                                                                                            <label for="validationCustom04" class="col-sm-3 col-form-label text-left">Target value</label>
                                                                                            <div class="col-sm-9">
                                                                                                <input type="text" class="form-control bg-light" name="target" placeholder="{{$users->target}}"></input>
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                                                                                            <button type="submit" class="btn btn-danger btn-lg waves-effect waves-light">

                                                                                                    Confirm

                                                                                            </button>
                                                                                    </div>
                                                                                </form>
                                                                            </div><!-- /.modal-content -->
                                                                        </div><!-- /.modal-dialog -->
                                                                    </div>

                                                                </td> --}}

                                                                <td class="align-middle">
                                                                    <div class="avatar-group">
                                                                    @if($users->team_leader == 1)
                                                                        @foreach($user as $members)
                                                                            @if($members->team_id == $users->team_id && $members->team_leader == 2)
                                                                            <div class="avatar-group-item">
                                                                                <a href="javascript: void(0);" class="d-inline-block">
                                                                                    <img src="{{URL::asset('public/assets/images/users/'.$members->image)}}" alt="" class="rounded-circle avatar-xs"
                                                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="{{$members->name}}">
                                                                                </a>
                                                                            </div>
                                                                            @endif
                                                                        @endforeach
                                                                    @elseif ($users->team_leader == 2)
                                                                        <button type="button" class="btn btn-dark waves-effect waves-light w-sm py-1"
                                                                            data-bs-toggle="modal" data-bs-target="#assign-to-team-{{$users->id}}">
                                                                            Member
                                                                        </button>
                                                                    @else
                                                                        <button type="button" class="btn btn-outline-dark waves-effect waves-light w-sm py-1"
                                                                            data-bs-toggle="modal" data-bs-target="#assign-to-team-{{$users->id}}">
                                                                            Assign
                                                                        </button>
                                                                    @endif
                                                                    </div>

                                                                    <!-- assign to team -->
                                                                    <div id="assign-to-team-{{$users->id}}" class="modal fade" tabindex="-1" aria-labelledby="modal" style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title" id="target_modal">
                                                                                        Assign <b>{{$users->name}}</b> to a team
                                                                                    </h4>
                                                                                    <button type="button" class="btn-close bg-secondary" data-bs-dismiss="modal" aria-label="Close">
                                                                                    </button>
                                                                                </div>

                                                                                <form class="" required method="POST" action="{{url('users/add-to-team').'/'. $users->id }}" enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <div class="modal-body">
                                                                                        <div class="row mb-4">
                                                                                            <div class="col-sm-12">
                                                                                                <select class="form-select w-100" name="team_id" id="team_leader" required>
                                                                                                    <option value="" >Select team</option>
                                                                                                    <option value="1315@2015" >Remove from team</option>
                                                                                                    @if(@isset($team))
                                                                                                        @foreach($team as $data)
                                                                                                            <option value="{{$data->id}}">{{$data->name}}</option>
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
                                                                </td>

                                                                <td class="align-middle">
                                                                    @if ($users->status == 1)
                                                                        <button type="button" class="btn btn-outline-dark waves-effect waves-light w-sm py-1"
                                                                            data-bs-toggle="modal" data-bs-target="#status-deactivate-{{$users->id}}">
                                                                            Deactivate
                                                                        </button>
                                                                    @else
                                                                        <button type="button" class="btn btn-outline-dark waves-effect waves-light w-sm py-1"
                                                                            data-bs-toggle="modal" data-bs-target="#status-{{$users->id}}">
                                                                            Deactive
                                                                        </button>
                                                                    @endif


                                                                    <!-- Status deactive -->
                                                                    <div id="status-activate-{{$users->id}}" class="modal fade" tabindex="-1" aria-labelledby="modal" style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title" id="target_modal">
                                                                                        Change status of {{$users->name}}
                                                                                    </h4>
                                                                                    <button type="button" class="btn-close bg-secondary" data-bs-dismiss="modal" aria-label="Close">

                                                                                    </button>
                                                                                </div>

                                                                                <form class="needs-validation was-validated" method="POST" action="{{url('users/status/update').'/'. $users->id }}" enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <div class="modal-body">
                                                                                        <div class="row mb-4">
                                                                                            <label for="validationCustom04" class="col-sm-3 col-form-label text-left">
                                                                                                Change status to
                                                                                            </label>
                                                                                            <div class="col-sm-9">
                                                                                                <select class="form-select w-100" name="status" required>
                                                                                                    @if(@isset($users))
                                                                                                        @if($users->status == 1)
                                                                                                            <option value="">Select a Status</option>
                                                                                                            <option value="1" >Active</option>
                                                                                                            <option value="2">Deactive</option>
                                                                                                        @elseif($users->status == 2)
                                                                                                            <option value="">Select a Status</option>
                                                                                                            <option value="1">Active</option>
                                                                                                            <option value="2" >Deactive</option>
                                                                                                        @else
                                                                                                            <option value="">Select a Status</option>
                                                                                                            <option value="1">Active</option>
                                                                                                            <option value="2">Deactive</option>
                                                                                                        @endif
                                                                                                    @else
                                                                                                        <option value="" selected>Select a Status</option>
                                                                                                        <option value="1">Active</option>
                                                                                                        <option value="2">Deactive</option>
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


                                                                    <!-- Status active -->
                                                                    <div id="status-deactivate-{{$users->id}}" class="modal fade" tabindex="-1" aria-labelledby="modal" style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title" id="target_modal">
                                                                                        Change status of {{$users->name}}
                                                                                    </h4>
                                                                                    <button type="button" class="btn-close bg-secondary" data-bs-dismiss="modal" aria-label="Close">

                                                                                    </button>
                                                                                </div>

                                                                                <form class="needs-validation was-validated" method="POST" action="{{url('users/status/update').'/'. $users->id }}" enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <div class="modal-body">
                                                                                        <div class="row mb-4 mx-3">
                                                                                            <h5 class="text-center">Are you sure you want to deactivate this user?</h5>
                                                                                            <input type="text" value="2" class="form-group" hidden>

                                                                                        </div>

                                                                                        <div class="row mb-4 mx-auto ">
                                                                                            <div class="col-sm-5 mx-auto text-center">
                                                                                                <button type="button" class="btn btn-secondary waves-effect waves-light text-center mx-auto">
                                                                                                    No, cancel
                                                                                                </button>
                                                                                            </div>
                                                                                            <div class="col-sm-5 mx-auto">
                                                                                                <button type="submit" class="btn btn-danger  waves-effect waves-light text-center mx-auto">
                                                                                                    Yes, confirm
                                                                                                </button>
                                                                                            </div>


                                                                                        </div>

                                                                                    </div>
                                                                                </form>
                                                                            </div><!-- /.modal-content -->
                                                                        </div><!-- /.modal-dialog -->
                                                                    </div>
                                                                </td>


                                                                <td class="text-center align-middle">
                                                                    <a href="{{url('users/edit').'/'. $users->id }}" class="btn btn-outline-dark btn-sm edit" title="Edit">
                                                                        <i class="fas fa-pencil-alt"></i>
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














            {{-- manage team modal--}}
            <!-- Vertically centered modal -->

            <!-- First modal dialog -->
            <div id="manage_team_1" class="modal fade" tabindex="-1" aria-labelledby="modal" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="target_modal">
                                Manage Team
                            </h4>
                            <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close">

                            </button>
                        </div>

                        <form class="form-control" method="POST" action="{{url('users/manage-team') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="row mb-4">
                                    <label for="team_name" class="col-sm-3 col-form-label text-left">
                                        Team Name
                                    </label>
                                    <div class="col-sm-9">
                                        <select class="form-select w-100" name="team_id" id="team_leader" required>
                                            <option value="">Select team</option>
                                            @if(@isset($team))
                                                @foreach($team as $data)
                                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                                @endforeach
                                            @endisset

                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="team_leader" class="col-sm-3 col-form-label text-left">
                                        Rename Team
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="team_name" placeholder="Enter new team name" class="form-control">
                                    </div>
                                </div>


                                {{-- <div class="row">
                                    <label for="team_leader" class="col-sm-3 col-form-label text-left">
                                        Delete Team
                                    </label>
                                    <div class="col-sm-9">
                                        <select class="form-select w-100" name="team_status" id="team_status" required>
                                            <option value="">Select Status</option>
                                            <option value="1">Delete</option>
                                            <option value="0">Active</option>

                                        </select>
                                    </div>
                                </div> --}}

                                {{-- <div class="row">
                                    <label for="team_leader" class="col-sm-3 col-form-label text-left mt-3">
                                        Team Members
                                    </label>
                                    <div class="col-sm-9">
                                        <div>
                                                <div class="repeater">
                                                    <div data-repeater-list="create_team_group">
                                                        <div data-repeater-item class="row my-3">
                                                            <div class=" col-lg-10 align-middle">
                                                                <select id="team_member" class="form-select align-middle" name="team_member" required>
                                                                    <option value="">Select a Member</option>
                                                                    @if(@isset($users))
                                                                        @foreach($user as $users)
                                                                            <option value="{{$users->id}}">{{$users->name}}</option>
                                                                        @endforeach
                                                                    @endisset

                                                                </select>
                                                            </div>

                                                            <div class="col-lg-2 align-self-center align-middle">
                                                                <div class="d-grid align-middle">
                                                                    <input data-repeater-delete="" type="button" class="btn btn-danger" value="Delete" >

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input data-repeater-create type="button" class="btn btn-success btn-sm mt-3 mt-lg-0 w-md" value="+ Add Another Member">
                                                </div>
                                        </div>
                                    </div>
                                </div> --}}

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-danger waves-effect waves-light">
                                    Confirm
                                </button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>











@endsection

{{-- <style scoped>
.table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th {
   background-color: rgba(128, 215, 255, 0.25) !important;
}
</style> --}}
