<button type="button" class="btn btn-warning waves-effect waves-light  w-md  btn-sm" data-bs-toggle="modal" data-bs-target="#portal_modal">Portal</button>
{{-- <button class="btn btn-dark btn-sm text-light form-control w-md float-left"  id="addPortals" onclick="addPortals()">Portals</button> --}}






















<!-- Vertically centered modal -->
<div id="portal_modal" class="modal fade" tabindex="-1" aria-labelledby="modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-dark text-center" id="portal_modal">Portal Modal</h4>
                <button type="button" class="btn-close bg-warning" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            {{-- <form class="needs-validation was-validated" method="POST" action="" enctype="multipart/form-data"> --}}
                {{-- @csrf --}}
                <div class="modal-body border-top border-warning">
                    <div class="row m-4">
                        <div class="form-check col-md-3">
                            <input class="form-check-input" type="checkbox" id="bayut" name="bayut" value="1">
                            <label class="form-check-label" for="bayut">
                                Bayut
                            </label>
                        </div>
                        <div class="form-check col-md-3">
                            <input class="form-check-input" type="checkbox" id="propertyfinder" name="propertyfinder" value="2">
                            <label class="form-check-label" for="propertyfinder">
                                Property Finder
                            </label>
                        </div>

                        <div class="form-check col-md-3">
                            <input class="form-check-input" type="checkbox" id="dubizzle" name="dubizzle" value="3">
                            <label class="form-check-label" for="dubizzle">
                                Dubizzle
                            </label>
                        </div>
                        <div class="form-check  col-md-3">
                            <input class="form-check-input" type="checkbox" id="generic" name="generic" value="4">
                            <label class="form-check-label" for="generic">
                                Generic
                            </label>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-dismiss="modal">

                                Confirm

                        </button>
                </div>
            {{-- </form> --}}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>




<script type="text/javascript">


</script>
