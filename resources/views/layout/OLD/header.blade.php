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

        <!-- Bootstrap Css -->
        <link href="{{URL::asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{URL::asset('assets/css/bootstrap.min.css')}}"  rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{URL::asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{URL::asset('assets/css/app.min.css')}}"  rel="stylesheet" type="text/css" />


        <script src="https://kit.fontawesome.com/11e38db15a.js" crossorigin="anonymous"></script>


        <!-- Sweet Alert-->
        <link href="{{URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{URL::asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- DataTables -->
        <link href="{{URL::asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{URL::asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <style>
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

    <body data-topbar="light" data-layout="horizontal" style="background-color: #fcfcfc;">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">
            <header id="page-topbar">
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

                    <div class="d-flex">

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="{{URL::asset('assets/images/users/'.Auth::user()->image)}}"
                                    alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{Auth::user()->name}}</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                @if (Auth::user()->id == 1)
                                    <a class="dropdown-item" href="{{URL('profile')}}"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>

                                @else

                                @endif

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{URL('logout')}}"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                            </div>
                        </div>

                    </div>
                </div>
            </header>





        @include('layout.menu')
