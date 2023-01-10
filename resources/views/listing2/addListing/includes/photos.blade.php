<div class="modal-body mt-0 pt-0 shadow-sm">
    <div class="card-body">

        <h2 class="card-title  font-size-20">Images</h2>
        <p class="card-title-desc">A minimum of 10 photos are required to make a listing. Follow the requirements given below.
        </p>
        <p class="font-size-16 mb-0 pb-0 mt-4">INSTRUCTIONS</p>
        <ul class="font-size-12 mt-0 pt-0">
            <li>No footers and with extra details</li>
            <li>Images must have <b class="text-danger">.jpg</b> file extensions</li>
            <li>Images are not collages, duplications or include people</li>
            <li>A watermark is subtle and represents your company logo</li>
            <li>Images must have <b class="text-danger">Width 800px</b> and <b class="text-danger">Height 600px</b> in Landscape mode</li>
            <li>Images must be genuine with respect to the property, showing interior and exterior views</li>
        </ul>
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

                        </div>
                    </div>
                    <input data-repeater-create type="button" class="btn btn-outline-primary btn-sm mt-3 mt-lg-0 w-md" value="+ Add More">
                </div>
                {{-- </form> --}}
        </div>


        {{-- <div class="text-center mt-4">
            <button type="button" class="btn btn-primary waves-effect waves-light">Send Files</button>
        </div> --}}
    </div>

</div>

