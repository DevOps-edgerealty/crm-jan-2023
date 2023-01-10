<button type="button" class="btn btn-warning waves-effect waves-light w-md btn-sm " data-bs-toggle="modal" data-bs-target="#photos_modal">Photos</button>









<!-- Vertically centered modal -->
<div id="photos_modal" class="modal fade" tabindex="-1" aria-labelledby="modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-dark text-center" id="photos_modal">Photos</h4>
                <button type="button" class="btn-close bg-warning" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            {{-- <form class="needs-validation was-validated" method="POST" action="" enctype="multipart/form-data"> --}}
                @csrf
                <div class="modal-body border-top border-warning">
                    <div class="card-body m-4">

                        <h4 class="card-title">Upload Photos</h4>
                        <p class="card-title-desc">Press CTRL key while selecting images to upload multiple images at once (JPEG/Png, Min 800x600)
                            The images highlighted with a yellow border are low quality images.
                        </p>

                        <div>
                            {{-- <form class="repeater" enctype="multipart/form-data"> --}}
                                <div>
                                    <div class="row">
                                        <div class="mb-3 col-lg-5">
                                            <label for="name_main">Main Image Title</label>
                                            <input type="text" id="name_main" name="photo_main_title" class="form-control" placeholder="">
                                        </div>

                                        <div class="mb-3 col-lg-6">
                                            <label for="photo_main">Main Image</label>
                                            <input type="file" id="photo_main" name="photo_main_file" class="form-control" accept="image/jpeg, image/jpg">
                                        </div>

                                    </div>

                                    <hr>

                                </div>
                                <div class="repeater">
                                    <div data-repeater-list="img_group_a">
                                        <div data-repeater-item class="row">
                                            <div class="mb-3 col-lg-5">
                                                <label for="other_img_name">Other Image Title</label>
                                                <input type="text" id="other_img_name" name="photo_other_title" class="form-control" placeholder="">
                                            </div>

                                            <div class="mb-3 col-lg-6">
                                                <label for="other_img_file">Other Image</label>
                                                <input type="file" id="other_img_file" name="photo_other_img" class="form-control" accept="image/jpeg, image/jpg">
                                            </div>

                                            <div class="col-lg-1 align-self-center">
                                                <div class="d-grid">
                                                    <input data-repeater-delete="" type="button" class="btn btn-danger btn-block mt-3" value="Delete" >
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <input data-repeater-create type="button" class="btn btn-success btn-sm mt-3 mt-lg-0 w-md" value="+ Add Another">
                                </div>
                                {{-- </form> --}}
                        </div>
                        <p class="font-size-16 mb-0 pb-0 mt-4">INSTRUCTIONS</p>
                        <ul class="font-size-12 mt-0 pt-0">
                            <li>No footers and with extra details</li>
                            <li>Images must have <b class="text-danger">.jpg</b> file extensions</li>
                            <li>Rename the images based on <b class="text-danger">unique</b> numbers</li>
                            <li>Images are not collages, duplications or include people</li>
                            <li>A watermark is subtle and represents your company logo</li>
                            <li>Images must have <b class="text-danger">Width 800px</b> and <b class="text-danger">Height 600px</b> in Landscape mode</li>
                            <li>Images must be genuine with respect to the property, showing interior and exterior views</li>
                        </ul>

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
