</div>
<!-- END layout-wrapper -->


<!-- Right Sidebar -->
{{-- <div class="right-bar">
    <div data-simplebar class="h-100">
        <div class="rightbar-title d-flex align-items-center px-3 py-4">

            <h5 class="m-0 me-2">Settings</h5>

            <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
        </div>

        <!-- Settings -->
        <hr class="mt-0" />
        <h6 class="text-center mb-0">Choose Layouts</h6>

        <div class="p-4">
            <div class="mb-2">
                <img src="{{URL::asset('public/assets/images/layouts/layout-1.jpg')}}" class="img-thumbnail" alt="layout images">
            </div>

            <div class="form-check form-switch mb-3">
                <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
                <label class="form-check-label" for="light-mode-switch">Light Mode</label>
            </div>

            <div class="mb-2">
                <img src="{{URL::asset('public/assets/images/layouts/layout-2.jpg')}}" class="img-thumbnail" alt="layout images">
            </div>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch">
                <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
            </div>

            <div class="mb-2">
                <img src="{{URL::asset('public/assets/images/layouts/layout-3.jpg')}}" class="img-thumbnail" alt="layout images">
            </div>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch">
                <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
            </div>

            <div class="mb-2">
                <img src="{{URL::asset('public/assets/images/layouts/layout-4.jpg')}}" class="img-thumbnail" alt="layout images">
            </div>
            <div class="form-check form-switch mb-5">
                <input class="form-check-input theme-choice" type="checkbox" id="dark-rtl-mode-switch">
                <label class="form-check-label" for="dark-rtl-mode-switch">Dark RTL Mode</label>
            </div>


        </div>

    </div> <!-- end slimscroll-menu-->
</div> --}}
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>


<!-- JAVASCRIPT -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.2/js/OverlayScrollbars.min.js" integrity="sha512-5UqQ4jRiUk3pxl9wZxAtep5wCxqcoo6Yu4FI5ufygoOMV2I2/lOtH1YjKdt3FcQ9uhcKFJapG0HAQ0oTC5LnOw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>




<script src="{{URL::asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{URL::asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{URL::asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{URL::asset('assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{URL::asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>


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

<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
{{-- <script src="{{URL::asset('public/assets/js/pages/custom.js')}}"></script> --}}





 <!-- Sweet Alerts js -->
 <script src="{{URL::asset('public/assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

 <!-- Sweet alert init js-->
 <script src="{{URL::asset('public/assets/js/pages/sweet-alerts.init.js')}}"></script>

<!-- App js -->
<script src="{{URL::asset('public/assets/js/app.js')}}"></script>

<!-- form advanced init -->
<script src="{{URL::asset('public/assets/js/pages/form-advanced.init.js')}}"></script>
<script>
        $(document).on('change', '.div-toggle', function() {
              var target = $(this).data('target');
              var show = $("option:selected", this).data('show');
              $(target).children().addClass('hide');
              $(show).removeClass('hide');
            });
            $(document).ready(function(){
                $('.div-toggle').trigger('change');
            });
</script>
<script>
    setInterval(function() {
                  window.location.reload();
                }, 1500000);

                function toggle_visibility(id) {
                var e = document.getElementById(id);
                e.style.display = ((e.style.display!='none') ? 'none' : 'block');
                }

</script>
<script>
    $(document).ready(function(){
      $("#flip").click(function(){
        $("#panel").slideToggle("slow");
      });
    });
</script>


</body>

</html>
