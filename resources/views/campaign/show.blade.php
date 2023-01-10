
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
                                    <h4 class="mb-sm-0 font-size-18">Campaign</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{URL('')}}">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Campaign</li>
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
                                    <div class="card-body">
                                        <a href="{{URL('/campaign/create_campaign')}}" class="btn btn-dark float-end"><i class="bx bx-filter-alt"> </i> Create Campaign</a>
                                        <h4 class="card-title"></h4>
                                        <p class="card-title-desc mb-5"></p>

                                        <div class="table-rep-plugin">
                                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                <table id="tech-companies-1" class="table table-striped">

                                                    <thead>
                                                        <tr>
                                                            <th>Campaign Ref Id</th>
                                                            <th>Campaign Name</th>
                                                            <th>Platform</th>
                                                            <th>Source</th>
                                                            <th>Campaign Team</th>
                                                            <th>Create Date</th>
                                                            <th>Update Date</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>


                                                    <tbody>
                                                        @foreach ($campaign as $campaigns)
                                                            <tr>
                                                                <td>{{$campaigns->id}}</td>
                                                                <td>{{$campaigns->campaign_name}}</td>
                                                                <td>{{$campaigns->lead_typess->type_name}}</td>
                                                                <td>{{$campaigns->source}}</td>
                                                                @php
                                                                $agents = [];
                                                                    @endphp
                                                                    @if(!empty($campaigns->campaign_agents) && count($campaigns->campaign_agents) > 0)
                                                                        @foreach($campaigns->campaign_agents as $ca)
                                                                            @php
                                                                            $agents [] = $ca->agent->name;
                                                                            @endphp
                                                                        @endforeach



                                                                    @endif
                                                                <td>{{implode(', ', $agents)}}</td>

                                                                <td>{{$campaigns->created_at}}</td>
                                                                <td>{{$campaigns->updated_at}}</td>

                                                                <td>
                                                                    @if ($campaigns->status == 1)
                                                                    <button type="button" class="btn btn-success btn-rounded waves-effect waves-light">Active</button>
                                                                    @else
                                                                    <button type="button" class="btn btn-danger btn-rounded waves-effect waves-light">Deactive</button>
                                                                    @endif
                                                                </td>
                                                                <td><a href="{{url('campaign/edit').'/'. $campaigns->id }}" class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </a></td>
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


@endsection
