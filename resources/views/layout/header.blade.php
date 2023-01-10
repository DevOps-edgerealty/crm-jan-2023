<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Dashboard | Edge CRM</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{-- <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" /> --}}
        <!--<meta http-equiv="refresh" content="300">-->
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{URL::asset('public/assets/images/favicon.png')}}">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap" rel="stylesheet">

        <!-- Bootstrap Css -->
        <link href="{{URL::asset('assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{URL::asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{URL::asset('assets/css/bootstrap.min.css')}}"  rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{URL::asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{URL::asset('assets/css/app.min.css')}}"  rel="stylesheet" type="text/css" />


        <script src="https://kit.fontawesome.com/11e38db15a.js" crossorigin="anonymous"></script>


        <!-- Sweet Alert-->
        <link href="{{URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{URL::asset('assets/libs/toastr/build/toastr.min.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{URL::asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- DataTables -->
        <link href="{{URL::asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{URL::asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <style>
            body {
                font-family: 'Poppins', sans-serif !important;
            }
            .logo-color {
                background-color: #000 !important;

            }

            @media (max-width: 600px) {
                .logo-color {
                    background-color: #fff !important;

                }
            }
            .menu-button {
                    display: none !important;

                }
            @media (max-width: 600px) {
                .menu-button {
                    display: contents !important;

                }
            }
            .mega_hover:hover {
                color: #fff;
            }
        </style>

    </head>

    <body data-topbar="light" data-layout="horizontal" style="background-color: #f5f5f5;">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">
            {{-- <header id="page-topbar" style="background-image: URL('{{asset('assets/images/bg/bg1.jpg')}}'); background-size:cover;"> --}}
            <header id="page-topbar" style="background-color:white;">
                <div class="navbar-header">
                    <div class="d-flex">


                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="{{URL('')}}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{URL::asset('assets/images/logo-black.png')}}" alt="" height="52">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{URL::asset('assets/images/logo-black.png')}}" alt="" height="60">
                                </span>
                            </a>

                            <a href="{{URL('')}}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{URL::asset('assets/images/logo-black.png')}}" alt="" height="52">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{URL::asset('assets/images/logo-black.png')}}" alt="" height="60">
                                </span>
                            </a>
                        </div>
                        <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                    </div>




                    {{-- <div class="d-none d-lg-block">

                        <div class="navbar navbar-expand-lg navbar-light">

                            <div class="container-fluid">

                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                                        <li class="nav-item mx-3">
                                            <a class="nav-link dropdown-toggle arrow-none fw-bold " style="color: white;" href="{{URL('')}}" id="topnav-dashboard" role="button">
                                                <i class="bx bx-home-circle me-2"></i><span key="t-dashboards">
                                                    Dashboards
                                                </span>
                                            </a>
                                        </li>

                                        @if (Auth::user()->user_type == '1')
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle arrow-none fw-bold mx-3" href="#" id="topnav-pages" role="button" data-bs-toggle="dropdown"  style="color: white;">
                                                <i class="bx bx-shopping-bag me-2"></i><span key="t-apps">Marketing Apps</span> <div class="arrow-down"></div>
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                                <a href="{{URL('all_leads')}}" class="dropdown-item fw-bold " key="t-chat"  style="color: #737373;">
                                                    <i class="bx bx-customize me-2"></i>
                                                    All Leads
                                                </a>
                                                <a href="{{URL('all_recycle')}}" class="dropdown-item fw-bold " key="t-chat" style="color: #737373;">
                                                    <i class="bx bx-trash me-2"></i>
                                                    Recycle
                                                </a>
                                                <a href="{{URL('all_temporary')}}" class="dropdown-item fw-bold " key="t-chat" style="color: #737373;">
                                                    <i class="bx bx-time me-2"></i>
                                                    Temporary
                                                </a>
                                                <a href="{{URL('annoucments')}}" class="dropdown-item  fw-bold" key="t-tui-calendar" style="color: #737373;">
                                                    <i class="bx bx-user-voice me-2"></i>
                                                    Announcment
                                                </a>
                                                <a href="{{URL('campaign')}}" class="dropdown-item  fw-bold" key="t-full-calender" style="color: #737373;">
                                                    <i class="bx bxl-telegram me-2"></i>
                                                    Campaign Setup
                                                </a>
                                            </div>
                                        </li>
                                        @else
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle arrow-none fw-bold  mx-3" href="#" id="topnav-pages" role="button" data-bs-toggle="dropdown" style="color: white;">
                                                    <i class="bx bx-shopping-bag me-2"></i><span key="t-apps">Marketing Apps</span> <div class="arrow-down"></div>
                                                </a>

                                                <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                                    <a href="{{URL('all_leads')}}" class="dropdown-item fw-bold " key="t-chat" style="color: #737373;">
                                                        <i class="bx bx-customize me-2"></i>
                                                        My Leads
                                                    </a>
                                                    <a href="{{URL('all_recycle')}}" class="dropdown-item fw-bold " key="t-chat" style="color: #737373;">
                                                        <i class="bx bx-trash me-2"></i>
                                                        Recycled Leads
                                                    </a>
                                                </div>
                                            </li>
                                        @endif

                                        <li class="nav-item  mx-3">
                                            <a class="nav-link dropdown-toggle arrow-none  fw-bold" href="{{URL('leader_board')}}" id="topnav-pages" role="button" style="color: white;">
                                                <i class="bx bx-trending-up me-2"></i><span key="t-apps">
                                                    Leaderboard
                                                </span>
                                            </a>
                                        </li>

                                        @if (Auth::user()->team_leader == '1')
                                        <li class="nav-item  mx-3">
                                            <a class="nav-link dropdown-toggle arrow-none  fw-bold" href="{{URL('team')}}" id="topnav-pages" role="button" style="color: white;">
                                                <i class="bx bx-cog me-2"></i><span key="t-apps">
                                                    Team Leads
                                                </span>
                                            </a>
                                        </li>
                                        @endif

                                        @if (Auth::user()->user_type == '1')
                                        <li class="nav-item  mx-3">
                                            <a class="nav-link dropdown-toggle arrow-none  fw-bold" href="{{URL('users')}}" id="topnav-pages" role="button" style="color: white;">
                                                <i class="bx bxs-user-plus me-2"></i><span key="t-apps">Staff</span>
                                            </a>
                                        </li>
                                        @endif

                                </div>
                            </div>

                        </div>

                    </div> --}}


                    {{-- <div>
                        @if ( App\Models\Models\Users::find(Auth::user()->id)->unreadNotifications->count() != 0 )
                            <div class="alert alert-primary" role="alert">
                                A simple primary alert—check it out!
                            </div>
                        @else

                        @endif
                    </div> --}}




                    <div class="d-flex">
                        <div class="dropdown d-inline-block">

                            <div class="">
                            </div>


                            {{-- notification bell --}}
                            <div class="dropdown d-inline-block">
                                <button type="button" class="btn header-item noti-icon waves-effect my-auto" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >

                                    {{-- notification count --}}
                                    @if ( App\Models\Models\Users::find(Auth::user()->id)->unreadNotifications->count() != 0 )
                                        <i class="bx bx-bell bx-tada"></i>
                                        Notifications
                                        <span class="badge bg-danger rounded-pill">
                                            {{ App\Models\Models\Users::find(Auth::user()->id)->unreadNotifications->count() }}
                                        </span>
                                    @else
                                        <i class="bx bx-bell"></i>
                                        Notifications
                                        <span class="badge bg-danger rounded-pill text-white">
                                            0
                                        </span>
                                    @endif


                                </button>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0  " aria-labelledby="page-header-notifications-dropdown"
                                >
                                    <div class="p-3">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="m-0" key="t-notifications">
                                                    Notifications
                                                </h6>
                                            </div>
                                            <div class="col-auto">
                                                <a href="{{ URL('clear-notifications') }}" class="small" key="t-view-all"> Clear All</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-simplebar="init" style="max-height: 230px;">
                                        <div class="simplebar-wrapper" style="margin: 0px;">
                                            <div class="simplebar-height-auto-observer-wrapper">
                                                <div class="simplebar-height-auto-observer">
                                                </div>
                                            </div>
                                            <div class="simplebar-mask">
                                                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                    <div class="simplebar-content-wrapper" style="height: auto; overflow: hidden;">
                                                        <div class="simplebar-content" style="padding: 0px;">

                                                            {{-- show when notification is true --}}
                                                            @if ( App\Models\Models\Users::find(Auth::user()->id)->unreadNotifications->count() != 0 )

                                                                @foreach ( App\Models\Models\Users::find(Auth::user()->id)->unreadNotifications as $notification )
                                                                    @if ( substr(@$notification->data['lead']['ref_no'], 0, 2) == 'PL')
                                                                        <a href="{{ URL('all_leads') }}" class="text-reset notification-item">
                                                                            <div class="d-flex">
                                                                                <div class="avatar-xs me-3">

                                                                                    <span class="avatar-title bg-success rounded-circle font-size-16">
                                                                                        <i class="bx bx-home-circle"></i>
                                                                                    </span>

                                                                                </div>
                                                                                <div class="flex-grow-1">
                                                                                    <h6 class="mb-1" key="t-your-order">
                                                                                        {{ $notification->data['lead']['name'] }}
                                                                                    </h6>
                                                                                    <div class="font-size-12 text-muted">
                                                                                        <p class="mb-1" key="t-grammer">
                                                                                            {{ $notification->data['lead']['inquiry'] }}
                                                                                        </p>
                                                                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i>
                                                                                        <span key="t-min-ago">
                                                                                            {{ \Carbon\Carbon::parse($notification->data['lead']['created_at'])->diffForHumans() }}
                                                                                        </span></p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </a>

                                                                    @elseif (substr(@$notification->data['lead']['ref_no'], 0, 2) == 'CL')
                                                                        <a href="{{ URL('all_leads') }}" class="text-reset notification-item">
                                                                            <div class="d-flex">
                                                                                <div class="avatar-xs me-3">

                                                                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                                                        <i class="bx bxl-facebook-circle"></i>
                                                                                    </span>

                                                                                </div>
                                                                                <div class="flex-grow-1">
                                                                                    <h6 class="mb-1" key="t-your-order">
                                                                                        {{ $notification->data['lead']['full_name'] }}
                                                                                    </h6>
                                                                                    <div class="font-size-12 text-muted">
                                                                                        <p class="mb-1" key="t-grammer">
                                                                                            {{ $notification->data['lead']['qualified_question'] }}
                                                                                        </p>
                                                                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i>
                                                                                        <span key="t-min-ago">
                                                                                            {{ \Carbon\Carbon::parse($notification->data['lead']['created_at'])->diffForHumans() }}
                                                                                        </span></p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    @elseif (substr(@$notification->data['lead']['ref_no'], 0, 2) == 'WL')
                                                                        <a href="{{ URL('all_leads') }}" class="text-reset notification-item">
                                                                            <div class="d-flex">
                                                                                <div class="avatar-xs me-3">

                                                                                    <span class="avatar-title bg-black rounded-circle font-size-16">
                                                                                        <i class="bx bx-globe"></i>
                                                                                    </span>
                                                                                </div>
                                                                                <div class="flex-grow-1">
                                                                                    <h6 class="mb-1" key="t-your-order">
                                                                                        {{ $notification->data['lead']['name'] }}
                                                                                    </h6>
                                                                                    <div class="font-size-12 text-muted">
                                                                                        <p class="mb-1" key="t-grammer">
                                                                                            {{ $notification->data['lead']['inquiry'] }}
                                                                                        </p>
                                                                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i>
                                                                                        <span key="t-min-ago">
                                                                                            {{ \Carbon\Carbon::parse($notification->data['lead']['created_at'])->diffForHumans() }}
                                                                                        </span></p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    @endif
                                                                @endforeach


                                                            {{-- show when notifications are false --}}
                                                            @else
                                                                <a href="javascript: void(0);" class="text-reset notification-item bg-secondary">
                                                                    <div class="d-flex">
                                                                        <div class="avatar-xs me-3">

                                                                            <span class="avatar-title bg-secondary rounded-circle font-size-16">
                                                                                <i class="bx bxs-bell-ring"></i>
                                                                            </span>

                                                                        </div>
                                                                        <div class="flex-grow-1">
                                                                            <div class="font-size-12 text-muted">
                                                                                <p class="mb-1" key="t-grammer">
                                                                                    You have no new leads yet
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="simplebar-placeholder" style="width: 0px; height: 0px;">
                                        </div>
                                    </div>
                                    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                        <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;">
                                        </div>
                                    </div>
                                    <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                        <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;">
                                        </div>
                                    </div>
                                    </div>
                                        <div class="p-2 border-top d-grid">
                                            <a class="btn btn-sm btn-link font-size-14 text-center" href="{{ URL('all_leads') }}">
                                                <i class="mdi mdi-arrow-right-circle  me-1"></i>
                                                <span key="t-view-more">View Leads..</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>


                                {{-- users name --}}
                                <button type="button" class="btn  waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img class="rounded-circle header-profile-user " src="{{ URL::asset('public/assets/images/users/'.Auth::user()->image) }}" alt="Header Avatar">
                                    <span class="d-none d-xl-inline-block ms-1 text-dark" key="t-henry">
                                        {{Auth::user()->name}}
                                    </span>
                                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                                </button>

                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    @if (Auth::user()->user_type == 1)
                                        <a class="dropdown-item" href="{{URL('profile')}}"><i class="bx bx-user font-size-16 align-middle me-1"></i>
                                            <span key="t-profile" class="text-dark">
                                                Profile
                                            </span></a>
                                        <div class="dropdown-divider"></div>
                                    @else

                                    @endif

                                    <a class="dropdown-item text-danger" href="{{URL('logout')}}"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                                </div>
                            </div>

                        </div>
                    </div>
            </header>


            {{-- <script>
                ( document ).ready(function() {
                    if ({{ json_encode($ctoast) }} || {{ json_encode($ctoast) }} == 1)
                    {
                        $('#clead').css('display', 'block');
                    }
                    else {
                         $('#clead').css('display', 'none');
                    }
                });
            </script> --}}





        {{-- <div class="d-md-none"> --}}
            @include('layout.menu')
        {{-- </div> --}}

