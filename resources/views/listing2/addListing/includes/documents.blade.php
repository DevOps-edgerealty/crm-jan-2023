<div class="modal-body mt-0 pt-0 shadow-sm">
    <div class="card-body">

        <h2 class="card-title  font-size-20">Documents</h2>
        {{-- <p class="card-title-desc">A minimum of 10 photos are required to make a listing. Follow the requirements given below.</p> --}}
        <p class="font-size-16 mb-0 pb-0 mt-4">INSTRUCTIONS</p>
        <ul class="font-size-12 mt-0 pt-0">
            <li>Each document must be less than 32 MB of size</li>
            <li>Should only contain .pdf or .png file extensions</li>
            <li>If the above requirements are not met, the contents will not be displayed</li>
        </ul>
        <div>
            {{-- <form class="repeater" enctype="multipart/form-data"> --}}
                <div class="repeater">
                    <div data-repeater-list="img_group_a">
                        <div data-repeater-item class="row">
                            <div class="mb-3 col-lg-5">
                                <label for="other_img_name">Document Title</label>
                                <input type="text" id="other_img_name" name="photo_other_title" class="form-control" placeholder="">
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label for="other_img_file">Document</label>
                                <input type="file" id="document_file" name="document_file" class="form-control" accept=".pdf">
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

