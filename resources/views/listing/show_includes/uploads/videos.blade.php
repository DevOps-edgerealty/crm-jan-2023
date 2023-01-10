<button type="button" class="btn btn-warning waves-effect waves-light  w-md  btn-sm" data-bs-toggle="modal" data-bs-target="#videos_modal">Videos</button>

<!-- Vertically centered modal -->
<div id="videos_modal" class="modal fade" tabindex="-1" aria-labelledby="modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-dark text-center" id="videos_modal">Videos Upload</h4>
                <button type="button" class="btn-close bg-warning" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            {{-- <form class="needs-validation was-validated" method="POST" action="" enctype="multipart/form-data"> --}}
                {{-- @csrf --}}
                <div class="modal-body border-top border-warning">
                    <div class="card">
                        <div class="card-body m-4">

                            {{-- <form class="repeater" enctype="multipart/form-data"> --}}
                            <div class="repeater">
                                <div data-repeater-list="vid_group_a"  id="vid_grp">
                                    <div data-repeater-item="" class="row">
                                        <div class="mb-3 col-lg-3">
                                            <label for="vid_name">Video Title</label>
                                            <input type="text" id="vid_name" name="vid_name" class="form-control" placeholder="">
                                        </div>

                                        <div class="mb-3 col-lg-4">
                                            <label for="vid_file">Video Link</label>
                                            <input type="text" id="vid_file" class="form-control" name="vid_link" placeholder="https://">
                                        </div>

                                        <div class="mb-3 col-lg-4">
                                            <label for="vid_host">Video Host</label>
                                            <select id="vid_host" class="form-select" name="vid_host">
                                                <option value="youtube" selected>YouTube</option>
                                                <option value="vimoeo">Vimeo</option>
                                                <option value="3d_view">3D View</option>
                                                <option value="daily_motion">Daily Motion</option>
                                            </select>
                                        </div>


                                        <div class="col-lg-1 align-self-center">
                                            <div class="d-grid">
                                                <input data-repeater-delete="" type="button" class="btn btn-danger btn-block" value="Delete">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <input data-repeater-create type="button" for="#vid_grp" class="btn btn-success btn-sm mt-3 mt-lg-0" value="+ Add another">
                            </div>
                                {{-- </form> --}}
                        </div>
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
