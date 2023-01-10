@if (Auth::user()->user_type == '2')

    <div class="row" style="font-family: 'Montserrat', sans-serif !important;">

        <div class="card overflow-hidden bg-black shadow-sm">
            <div class=" bg-soft">
                <div class="row">
                    <div class="col-7 d-none d-lg-block">
                        <div class="text-white p-3">
                            <h5 class="text-white">Welcome Back !</h5>
                            <p class="">Customer Relationship Management</p>
                        </div>
                    </div>
                    <div class="col-5 align-self-end d-none d-lg-block">
                        <img src="{{URL::asset('public/assets/images/logo-white.png')}}" alt=""  class="img-fluid px-5 mb-4 pt-3 ">
                    </div>

                    <div class="col-9 d-lg-none">
                        <div class="text-white p-3">
                            <h5 class="text-white">Welcome Back !</h5>
                            <p class="">Edge Realty - CRM</p>
                        </div>
                    </div>
                    <div class="col-3 align-self-end d-lg-none my-auto align-middle">
                        <img src="{{URL::asset('public/assets/images/logo-white.png')}}" alt=""  class="img-fluid my-auto align-middle">
                    </div>
                </div>
            </div>
            <div class="card-body bg-white rounded-top pt-0">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="avatar-md profile-user-wid mb-4">

                                <img src="{{URL::asset('public/assets/images/users/'.Auth::user()->image)}}" alt="" class="img-thumbnail rounded-circle mt-0" style="padding: 2px !important;"/>

                        </div>
                        <h5 class="font-size-14 text-truncate text-dark pt-1">{{Auth::user()->name}}</h5>
                        <p class="text-muted mb-0 text-truncate">Property Consultant</p>
                    </div>

                    <div class="col-sm-8">
                        <div class="pt-4">

                            <div class="row">
                                <div class="col-6">
                                    <h5 class="font-size-15">{{$leader_detail_count}}</h5>
                                    {{-- <p class="text-muted mb-0">Deals</p> --}}
                                    <a href="{{URL('/my_deals')}}" class="btn btn-sm bg-black text-white rounded mb-0 shadow-sm">View my Deals</a>
                                </div>
                                <div class="col-6">
                                    <h5 class="font-size-15">AED {{number_format($total_net_commission_1)}}</h5>
                                    <p class="text-muted mb-0">Total Commission</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                {{-- <a href="{{URL('my-statistics')}}" class="btn bg-black text-white waves-effect waves-light btn-sm">View Statistics <i class="mdi mdi-arrow-right ms-1"></i></a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@else
    <div class="row overflow-hidden">

        {{-- <div class="row"> --}}
            <div class="col-md-6 mx-auto">
                    <div class="card bg-black mini-stats-wid  rounded shadow-sm mb-2 mx-auto border">
                        <a href="{{URL('all_leads')}}">

                            <div class="card-body ">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="fw-medium text-white">Total Leads</p>
                                        <h4 class="mb-0 text-white">{{ number_format($dashboard_total_leads_2023)}} <span class="font-size-12 text-secondary"></span></h4>
                                    </div>

                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-dark border">
                                            <span class="avatar-title" style="background-color: #000 !important;">
                                                <i class="mdi mdi-apps font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                {{-- </div> --}}
                {{-- <div class="bg-white bg-hard mt-2 ms-2 rounded">
                    <div class="row">
                        <div class="col-8">
                            <div class="text-light p-3">
                                <h3 class="text-dark">Welcome Back !</h3>
                                <p>Dashboard</p>
                            <h5 class="font-size-14 text-truncate text-dark pt-1">{{Auth::user()->name}}</h5>
                        </div>
                        </div>
                        <div class="col-4 align-self-end">
                            <img src="{{URL::asset('public/assets/images/chat.svg')}}" alt="welcome-image" class="img-fluid pe-2" style="height: 100px !important;">
                        </div>
                    </div>
                </div>





                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="avatar-md profile-user-wid mb-1">
                                <img src="{{URL::asset('public/assets/images/users/'.Auth::user()->image)}}" alt="" class="img-thumbnail rounded-circle">
                                <img src="{{URL::asset('public/assets/images/users/profile.png')}}" alt="" class="img-thumbnail rounded-circle">
                                <img src="{{URL::asset('public/assets/images/users/'.Auth::user()->image)}}" alt="" class="img-thumbnail rounded-circle mt-2" style="padding: 0px !important;">
                            </div>
                            <h5 class="font-size-15 text-truncate">{{Auth::user()->name}}</h5>
                        </div>
                    </div>
                </div> --}}
            </div>


            <div class="col-md-6 mx-auto">
                {{-- <div class="row w-100"> --}}
                    <div class="card bg-black mini-stats-wid m-0  rounded shadow-sm mb-2 border">
                        <a href="{{URL('statistics')}}">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">

                                        <p class="fw-medium text-white">Statistics </p>
                                        <h4 class="mb-0 text-white">{{ number_format($agent_count)}} <span class="font-size-12 text-secondary">registered agents</span> </h4>
                                    </div>

                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-dark border">
                                            <span class="avatar-title" style="background-color: #000 !important;">
                                                <i class="mdi mdi-account-group-outline font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                {{-- </div> --}}

            </div>
        {{-- </div> --}}








    </div>
@endif
