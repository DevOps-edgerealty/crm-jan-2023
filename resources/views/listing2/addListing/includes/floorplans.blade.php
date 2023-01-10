<div class="modal-body mt-0 pt-0 border-top shadow-sm">
    <div class="card-body">

        <h2 class="card-title font-size-20">Floor Plans</h2>
            <p class="card-title-desc">
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
                <input data-repeater-create type="button" class="btn btn-outline-primary btn-sm mt-3 mt-lg-0 w-md" value="+ Add More">
                {{-- </form> --}}
            </div>
        </div>

        {{-- <div class="text-center mt-4">
            <button type="button" class="btn btn-primary waves-effect waves-light">Send Files</button>
        </div> --}}
    </div>

</div>
