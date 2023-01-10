<div class="modal-body mt-0 pt-0 border-top shadow-sm">
    <div class="card-body">

        <h2 class="card-title font-size-20">Videos</h2>
            <p class="card-title-desc">
        </p>

        <div>
            <div class="repeater">
                {{-- <form class="repeater" enctype="multipart/form-data"> --}}
                <div data-repeater-list="vid_group_a"  id="vid_grp">
                    <div data-repeater-item="" class="row">
                        <div class="mb-3 col-lg-3">
                            <label for="vid_name">Video Title</label>
                            <input type="text" id="vid_name" name="vid_name" class="form-control" placeholder="">
                        </div>

                        <div class="mb-3 col-lg-4">
                            <label for="vid_file">Video Link</label>
                            <input type="text" id="vid_file" class="form-control" name="vid_link" placeholder="https://www.">
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
                <input data-repeater-create type="button" class="btn btn-outline-primary btn-sm mt-3 mt-lg-0 w-md" value="+ Add More">
                {{-- </form> --}}
            </div>
        </div>

        {{-- <div class="text-center mt-4">
            <button type="button" class="btn btn-primary waves-effect waves-light">Send Files</button>
        </div> --}}
    </div>

</div>
