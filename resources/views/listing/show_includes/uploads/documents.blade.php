<button type="button" class="btn btn-warning waves-effect waves-light  w-md  btn-sm" data-bs-toggle="modal" data-bs-target="#document_modal">Documents</button>






















<!-- Vertically centered modal -->
<div id="document_modal" class="modal fade" tabindex="-1" aria-labelledby="modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-dark text-center" id="document_modal">Documents</h4>
                <button type="button" class="btn-close bg-warning" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            {{-- <form class="needs-validation was-validated" method="POST" action="" enctype="multipart/form-data"> --}}
                @csrf
                <div class="modal-body border-top border-warning">
                    <div class="card-body m-4">

                        <h4 class="card-title">Upload Documents</h4>
                            <p class="card-title-desc">Drag & drop images to change order. Press CTRL key while selecting files to upload multiple at once.
                        </p>

                        <div>
                            {{-- <form class="repeater" enctype="multipart/form-data"> --}}
                            <div class="repeater">

                                <div data-repeater-list="docx_group_a" id="docx_grp">
                                    <div data-repeater-item="" class="row">
                                        <div class="mb-3 col-lg-5">
                                            <label for="document_name">Enter Title</label>
                                            <input type="text" id="document_file" name="document_name" class="form-control">
                                        </div>

                                        <div class="mb-3 col-lg-6">
                                            <label for="document_photo">Upload Document</label>
                                            <input type="file" id="document_file" name="document_file" class="form-control" accept=".pdf">
                                        </div>

                                        <div class="col-lg-1 align-self-center">
                                            <div class="d-grid">
                                                <input data-repeater-delete="" type="button" class="btn btn-danger btn-block mt-3" value="Delete">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input data-repeater-create type="button" for="#docx_grp" class="btn btn-outline-primary btn-sm mt-3 mt-lg-0" value="+ Add More">
                            </div>
                            {{-- </form> --}}

                        </div>

                        <ul class="mt-3 font-size-12">
                            <li>Each document must be less than 32 MB of size</li>
                            <li>Should only contain .pdf or .png file extensions</li>
                            <li>If the above requirements are not met, the contents will not be displayed</li>
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
