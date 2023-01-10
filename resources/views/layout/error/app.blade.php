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

    <body data-topbar="light" data-layout="horizontal">


        <main class="py-4">
            @yield('content')
        </main>

        <!-- JAVASCRIPT -->
        <script src="{{URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{URL::asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{URL::asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{URL::asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{URL::asset('assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{URL::asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


        <!-- dashboard init -->
        <script src="{{URL::asset('assets/js/pages/dashboard.init.js')}}"></script>

        <!-- Required datatable js -->
        <script src="{{URL::asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{URL::asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <!-- Buttons examples -->
        <script src="{{URL::asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{URL::asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{URL::asset('assets/libs/jszip/jszip.min.js')}}"></script>
        <script src="{{URL::asset('assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
        <script src="{{URL::asset('assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
        <script src="{{URL::asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{URL::asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{URL::asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
        <script src="{{URL::asset('assets/libs/select2/js/select2.min.js')}}"></script>

        <!-- Responsive examples -->
        <script src="{{URL::asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{URL::asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

        <!-- Datatable init js -->
        <script src="{{URL::asset('assets/js/pages/datatables.init.js')}}"></script>

        {{-- <script src="{{URL::asset('public/assets/js/pages/custom.js')}}"></script> --}}





        <!-- Sweet Alerts js -->
        <script src="{{URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

        <!-- Sweet alert init js-->
        <script src="{{URL::asset('assets/js/pages/sweet-alerts.init.js')}}"></script>

        <!-- App js -->
        <script src="{{URL::asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>

        <script src="{{URL::asset('assets/libs/jquery.repeater/jquery.repeater.min.js')}}"></script>

        <script src="{{URL::asset('assets/js/pages/form-repeater.int.js')}}"></script>

        <script src="{{URL::asset('assets/js/app.js')}}"></script>

        <!-- form advanced init -->
        <script src="{{URL::asset('assets/js/pages/form-advanced.init.js')}}"></script>



    </body>

</html>

