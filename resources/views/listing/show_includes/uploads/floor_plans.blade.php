<button type="button" class="btn btn-warning waves-effect waves-light w-md btn-block  w-md  btn-sm" data-bs-toggle="modal" data-bs-target="#floor_plan_modal">Floor Plans</button>






















<!-- Vertically centered modal -->
<div id="floor_plan_modal" class="modal fade" tabindex="-1" aria-labelledby="modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-dark text-center" id="floor_plan_modal">Floor Plans</h4>
                <button type="button" class="btn-close bg-warning" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            {{-- <form class="needs-validation was-validated" method="POST" action="" enctype="multipart/form-data"> --}}
                @csrf
                <div class="modal-body border-top border-warning">
                    <div class="card-body m-4">

                        <h4 class="card-title">Upload Floor Plans</h4>
                            <p class="card-title-desc">Drag & drop images to change order. Press CTRL key while selecting files to upload multiple at once
                        </p>

                        <div>
                            <div class="repeater">
                                {{-- <form class="repeater" enctype="multipart/form-data"> --}}
                                <div data-repeater-list="floor_group_a">
                                    <div data-repeater-item="" class="row">
                                        <div class="mb-3 col-lg-5">
                                            <label for="floor_plan_title">Enter Title</label>
                                            <input type="text" id="floor_plan_title" name="floor_plan_title" class="form-control">
                                        </div>

                                        <div class="mb-3 col-lg-6">
                                            <label for="floor_plan_img">Upload Plan</label>
                                            <input type="file" id="floor_plan_img" name="floor_plan_img" class="form-control" accept="image/jpeg, image/jpg">
                                        </div>

                                        <div class="col-lg-1 align-self-center">
                                            <div class="d-grid">
                                                <input data-repeater-delete="" type="button" class="btn btn-danger btn-block mt-3" value="Delete">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <input data-repeater-create type="button" class="btn btn-success btn-sm mt-3 mt-lg-0" value="+ Add another">
                                {{-- </form> --}}
                            </div>
                        </div>

                        {{-- <div class="text-center mt-4">
                            <button type="button" class="btn btn-primary waves-effect waves-light">Send Files</button>
                        </div> --}}
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-lg waves-effect waves-light" data-bs-dismiss="modal">

                                Upload Files

                        </button>
                </div>
            {{-- </form> --}}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>




<script type="text/javascript">


</script>
