@extends('layout.master')

@section('content')
<style>
    @page { size: auto;  margin: 5mm; }
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
                                    <h4 class="mb-sm-0 font-size-18">Leaderboard Detail</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{URL('')}}">Home</a></li>
                                            <li class="breadcrumb-item"><a href="{{URL('/leader_board')}}">Leaderboard</a></li>
                                            <li class="breadcrumb-item active">Leaderboard Detail</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-12 d-none d-print-block">
                                <div class=" p-4">

                                    <img class="pt-2 d-inline-block" src="https://www.edgerealty.ae/public/assets/images/logo-black.png" style="height:75px" alt="">

                                    <div class="text-center" style="margin-top: -65px;">
                                        <h6 class="mb-0"><b>  Edge Realty Real Estate </b></h6>
                                        <h6 class="mb-0"><b> Office No, 117 , DNIC Building,Sheikh Zayed Road Dubai</b></h6>
                                        <h6 class="mb-0"><b> Tel:+97143881856,Email: info@edgerealty.ae </b></h6>
                                        <h4 class="mt-3">Sales Net Commission</h4>
                                        <br>
                                    </div>
                                </div>

                            </div>


                            <div class="col-xl-12"></div>
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4 d-print-none">Leaderboard Details</h4>
                                        <h4 class="card-title mb-4 d-none d-print-block">Agent Detail</h4>
                                        <div class="table-rep-plugin mb-3">
                                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                <table id="tech-companies-1" class="table table-striped">
                                                    <tbody>

                                                        <tr>
                                                            <th scope="row">Agent Name :</th>
                                                            <td>{{$leader_board->name}}</td>
                                                            <th scope="row">E-mail :</th>
                                                            <td>{{$leader_board->email}}</td>
                                                            <th scope="row">
                                                                <button class="btn btn-warning">
                                                                    <a href="{{URL('/leader_board/detail/edit_leader/'.$user_id)}}">

                                                                        Edit User Info
                                                                    </a>
                                                                </button>
                                                            </th>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">Total Net Commission </th>
                                                            <td><a href="javascript: void(0);" class="badge badge-soft-success font-size-14 m-1">{{ number_format($leader_net_commision) }} AED</a></td>
                                                            <th scope="row"></th>
                                                            <td></td>
                                                        </tr>


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>




                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                            <div class="col-xl-12">

                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Leaderboard Details</h4>
                                        @if(session()->has('message'))
                                        <div class="col-12">
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <i class="mdi mdi-check-all me-2"></i>
                                                {{ session()->get('message') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="table-rep-plugin mb-5">
                                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                <table id="tech-companies-1" class="table table-striped">
                                                    <thead>
                                                        <tr>

                                                            <td>
                                                                Leaderboard Description
                                                            </td>
                                                            <td>
                                                                Lead Source
                                                            </td>
                                                            <td>
                                                                Sale Value
                                                            </td>
                                                            <td>
                                                                Rent Value
                                                            </td>
                                                            <td>
                                                                Net Commission
                                                            </td>
                                                            <td>
                                                                Date
                                                            </td>
                                                            <td>
                                                                Action
                                                            </td>

                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        {{-- @foreach ($lead_detail as $detail) --}}
                                                        @if (!empty($leader_detail) )
                                                        @foreach ($leader_detail as $leader)
                                                            <tr>

                                                                <td>{{@$leader->leader_detail}}</td>

                                                                @if($leader->lead_source != null)
                                                                    <td>{{@$leader->lead_source}}</td>
                                                                @else
                                                                    <td> No Source Listed </td>
                                                                @endif

                                                                <td>{{@ number_format($leader->sale_value)}}</td>

                                                                <td>{{@ number_format($leader->rent_value)}}</td>

                                                                <td>{{@ number_format($leader->net_commission)}}</td>

                                                                <td>{{date('d-m-Y H:i:s', strtotime($leader->created_at));}}</td>

                                                                <td>
                                                                    <a href="{{url('leader_board/detail/edit').'/'. $leader->id }}" class="btn btn-outline-info btn-sm edit" title="Edit">
                                                                        <i class="fas fa-pencil-alt"> </i>
                                                                    </a> &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <button type="button" class="btn btn-outline-danger btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#delete_modal-{{$leader->id}}">
                                                                        <i class="fas fa-trash"> </i>
                                                                    </button>
                                                                    <!-- Vertically centered modal -->
                                                                    <div id="delete_modal-{{$leader->id}}" class="modal fade" tabindex="-1" aria-labelledby="modal" style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header bg-dark">
                                                                                    <h4 class="modal-title text-light" id="delete_model">Are you sure?</h4>
                                                                                    <button type="button" class="btn-close bg-secondary" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <form class="needs-validation was-validated" method="POST" action="{{url('leader_board/detail/delete').'/'. $leader->id.'/'.$leader->leader_id }}" enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <div class="modal-body">
                                                                                        <div class="row mb-4">
                                                                                            <label for="validationCustom04" class="col-sm-3 col-form-label">Description</label>
                                                                                            <div class="col-sm-9">
                                                                                                <p class="form-control">{{@$leader->leader_detail}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mb-4">
                                                                                            <label for="validationCustom04" class="col-sm-3 col-form-label">Sale Value</label>
                                                                                            <div class="col-sm-9">
                                                                                                <p class="form-control">{{@ number_format($leader->sale_value)}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mb-4">
                                                                                            <label for="validationCustom04" class="col-sm-3 col-form-label">Rent Value</label>
                                                                                            <div class="col-sm-9">
                                                                                                <p class="form-control">{{@ number_format($leader->rent_value)}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mb-4">
                                                                                            <label for="validationCustom04" class="col-sm-3 col-form-label">Commision</label>
                                                                                            <div class="col-sm-9">
                                                                                                <p class="form-control">{{@ number_format($leader->net_commission)}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mb-2">
                                                                                            <label for="validationCustom04" class="col-sm-3 col-form-label">Date</label>
                                                                                            <div class="col-sm-9">
                                                                                                <p class="form-control">{{date('d-m-Y H:i:s', strtotime($leader->created_at));}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <hr class="bg-primary" style="height: 2px;">




                                                                                        <p class="pt-2">You need to be authorized to proceed with this action.</p>

                                                                                            <div class="row">
                                                                                                <div class="col-md-4">
                                                                                                    <div class="mt-2">
                                                                                                        <label for="validationCustom04" class="form-label">Authorization Key</label>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-8">
                                                                                                    <div class="mb-3">
                                                                                                        <input type="password" name="authkey" class="form-control" id="validationCustom04" placeholder="XXXX-XXXX-XXXX-XXXX" required="">
                                                                                                        <div class="invalid-feedback">
                                                                                                            Please provide a valid authorization key.
                                                                                                        </div>
                                                                                                    </div>
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

                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="3" class="text-center">No Record Found</td>
                                                            </tr>

                                                        @endif

                                                        {{-- @endforeach --}}





                                                    {{-- </tbody>
                                                    <tfoot class="d-none d-print-block">
                                                       <tr>
                                                           <td></td>
                                                           <td></td>
                                                           <td></td>
                                                           <td>{{ number_format($leader_net_commision) }} AED</td>
                                                           <td></td>

                                                       </tr>
                                                    </tfoot> --}}
                                                </table>
                                            </div>
                                        </div>
                                        <div class="d-print-none">
                                            <h4 class="card-title mb-4"> Add Leader Detail</h4>
                                            <form method="POST" action="{{url('leader_board/leader_store_detail')}}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row mb-4">
                                                    <label class="col-sm-3 col-form-label">Add Sale Value</label>
                                                    <div class="col-sm-9">

                                                        <input class="form-control" name="sale_value" type="number"  id="sale_value" >

                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label class="col-sm-3 col-form-label">Add Rent Value</label>
                                                    <div class="col-sm-9">

                                                        <input class="form-control" name="rent_value" type="number"  id="rent_value" >

                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label class="col-sm-3 col-form-label">Add Commission</label>
                                                    <div class="col-sm-9">

                                                        <input class="form-control" name="net_commission" type="number"  id="net_commission" required>

                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label class="col-sm-3 col-form-label">Add Lead Source</label>
                                                    <div class="col-sm-9">
                                                        <select id="lead_source" class="form-select" name="lead_source" required>
                                                            <option value="">Select a Lead Source</option>
                                                            <option value="Direct">1 - Direct</option>
                                                            <option value="Referral">2 - Referral</option>
                                                            <option value="Portal-Property Finder">3 - Portal-Property Finder</option>
                                                            <option value="Portal-Dubizzle">4 - Portal-Dubizzle</option>
                                                            <option value="Portal-Bayut">5 - Portal-Bayut</option>
                                                            <option value="A to A">6 - A to A</option>
                                                            <option value="Website">7 - Website</option>
                                                            <option value="Campaign">8 - Campaign</option>
                                                        </select>
                                                        {{-- <input class="form-control" name="lead_source" type="text"  id="lead_source" required> --}}

                                                    </div>
                                                </div>
                                                <input type="hidden" name="leader_id" value="{{$leader_board->id}}" >
                                                <div class="row mb-4">
                                                    <label for="leader_description" class="col-sm-3 col-form-label">Add Description</label>
                                                    <div class="col-sm-9">
                                                    <textarea id="leader_description" class="form-control" name="description" rows="3" required></textarea>

                                                    </div>
                                                </div>
                                                <div class="row justify-content-end">
                                                    <div class="col-sm-9">

                                                        <div>
                                                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>

                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->


                            </div>
                        </div>
                        <!-- end row -->




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


@endsection
