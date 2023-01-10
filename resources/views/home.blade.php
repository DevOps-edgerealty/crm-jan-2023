
@extends('layout.master')


@section('content')

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->

            <div class="main-content" >

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between mx-auto pt-2">

                                    @if(Auth::user()->user_type == '1')
                                        <span class="mb-sm-0 font-size-16 text-uppercase fw-bolder text-center mx-auto" style="color: #737373; letter-spacing: .2rem;">Administrator</span>
                                    @elseif (Auth::user()->user_type == '2')
                                        <span class="mb-sm-0 font-size-16 text-uppercase fw-bolder text-center mx-auto" style="color: #737373; letter-spacing: .2rem;">Property Consultant</span>
                                    @endif
                                    {{-- <h3 class=" mb-sm-0 font-size-14 ">Welcome Back ! {{Auth::user()->name}}</h3> --}}


                                    {{-- <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>

                                        </ol>
                                    </div> --}}

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->









                        @if (Auth::user()->user_type == '1')

                            <div class="row">

                                <div class="col-xl-5 h-100">


                                    {{-- Welcome Card --}}
                                    @include('home_includes.welcome_card')
                                    {{-- Welcome Card --}}



                                    {{-- Announcements Sector --}}
                                    @include('home_includes.top_agents')
                                    {{-- /Announcements Sector --}}


                                </div>
                                <div class="col-xl-7">
                                    <div class="row">




                                        {{-- Campaign lead details --}}
                                        <div class="col-md-4">
                                            <div class="card mini-stats-wid shadow-sm border" >
                                                <a href="{{URL('leads')}}">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <div class="flex-grow-1">
                                                                <p class="text-muted fw-medium">Campaigns Leads </p>
                                                                <h4 class="mb-0">{{ number_format($dashboard_campaign_lead_count) }}</h4>
                                                            </div>

                                                            <div class="flex-shrink-0 align-self-center">
                                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-dark">
                                                                    <span class="avatar-title" style="background-color: #000 !important;">
                                                                        <i class="bx bxl-facebook font-size-24"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>




                                        {{-- Property lead details --}}
                                        <div class="col-md-4">
                                            <div class="card mini-stats-wid shadow-sm border">
                                                <a href="{{URL('property_listing')}}">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <div class="flex-grow-1">
                                                                <p class="text-muted fw-medium">Property Listing Leads</p>
                                                                <h4 class="mb-0">{{ number_format($dashboard_portal_lead_count)}}</h4>
                                                            </div>

                                                            <div class="flex-shrink-0 align-self-center ">
                                                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                                    <span class="avatar-title rounded-circle bg-primary" style="background-color: #000 !important;">
                                                                        <i class="bx bx-building-house font-size-24"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>




                                        {{-- website lead details --}}
                                        <div class="col-md-4">
                                            <div class="card mini-stats-wid shadow-sm border">
                                                <a href="{{URL('website')}}">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <div class="flex-grow-1">
                                                                <p class="text-muted fw-medium">Website Leads</p>
                                                                <h4 class="mb-0">{{ number_format($dashboard_website_lead_count)}}</h4>
                                                            </div>

                                                            <div class="flex-shrink-0 align-self-center">
                                                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                                    <span class="avatar-title rounded-circle bg-primary" style="background-color: #000 !important;">
                                                                        <i class="bx bxl-wordpress font-size-24"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>




                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            @include('home_includes.adminTargets')
                                        </div>
                                        <div class="col-md-8">
                                            {{-- Apex Charts for Admin --}}
                                            @include('home_includes.adminCharts2')
                                        </div>
                                    </div>







                                </div>
                            </div>
                        @elseif (Auth::user()->user_type == '2')
                            <div class="row">

                                <div class="col-xl-4 px-4">



                                    {{-- Welcome Card --}}
                                    @include('home_includes.welcome_card')
                                    {{-- Welcome Card --}}



                                    {{-- Announcements Sector --}}
                                    {{-- @include('home_includes.announcement') --}}
                                    @include('home_includes.total_income')
                                    {{-- /Announcements Sector --}}


                                </div>
                                <div class="col-xl-8">
                                    <div class="row">



                                        {{-- Campaign lead details --}}
                                        <div class="col-md-4">
                                            <div class="card mini-stats-wid shadow-sm">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <div class="flex-grow-1">
                                                                <p class="text-muted fw-medium">Campaigns Leads </p>
                                                                <h4 class="mb-0">{{ number_format($dashboard_campaign_lead_count)}}</h4>
                                                            </div>

                                                            <div class="flex-shrink-0 align-self-center">
                                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-dark">
                                                                    <span class="avatar-title" style="background-color: #000 !important;">
                                                                        <i class="bx bx-copy-alt font-size-24"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>




                                        {{-- Property lead details --}}
                                        <div class="col-md-4">
                                            <div class="card mini-stats-wid  shadow-sm">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <div class="flex-grow-1">
                                                                <p class="text-muted fw-medium">Property Listing Leads</p>
                                                                <h4 class="mb-0">{{ number_format($dashboard_portal_lead_count)}}</h4>
                                                            </div>

                                                            <div class="flex-shrink-0 align-self-center ">
                                                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                                    <span class="avatar-title rounded-circle bg-primary" style="background-color: #000 !important;">
                                                                        <i class="bx bx-copy-alt font-size-24"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>




                                        {{-- website lead details --}}
                                        <div class="col-md-4">
                                            <div class="card mini-stats-wid shadow-sm">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <div class="flex-grow-1">
                                                                <p class="text-muted fw-medium">Website Leads</p>
                                                                <h4 class="mb-0">{{ number_format($dashboard_website_lead_count)}}</h4>
                                                            </div>

                                                            <div class="flex-shrink-0 align-self-center">
                                                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                                    <span class="avatar-title rounded-circle bg-primary" style="background-color: #000 !important;">
                                                                        <i class="bx bx-copy-alt font-size-24"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>




                                    {{-- Apex Charts for Agent --}}
                                    <div class="row">

                                            {{-- @if (Auth::user()->team_leader == 1)
                                            <div class="col-md-4">
                                                @include('home_includes.team_leader_cards')
                                            </div>
                                            @else
                                            <div class="col-md-4">
                                                @include('home_includes.agents_cards')
                                            </div>
                                            @endif --}}
                                            <div class="col-md-4">
                                                @include('home_includes.agentTargets')
                                            </div>



                                        <div class="col-md-8">
                                            @include('home_includes.agentApex2')
                                        </div>
                                    </div>

                                </div>
                            </div>






                            <div class="row">

                                {{-- Income vs leads for agents --}}
                                @if (isset($no_leaderboard))
                                    @include('stats.agent_statisitcs_view_error')
                                @else
                                    @include('stats.agent_statisitcs_view')
                                @endif

                            </div>
                        @endif


                    </div>





                             </div>
                        </div>
                        <!-- end row -->

                        {{-- <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4"></h4>
                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <thead  style="color: #fff;background-color: #000">
                                                    <tr>

                                                        <th class="align-middle">Announcements</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($announcement as $data)
                                                        <tr>

                                                            <td><b>{{$data->announcements}}</b></td>

                                                        </tr>
                                                    @endforeach





                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table-responsive -->
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <!-- end row -->


                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->




                <!-- end modal -->
                {{-- @if (Auth::user()->user_type == '2')
                    {{dump($campaigns_data)}}
                @endif --}}
                <footer class="footer bg-light">
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
