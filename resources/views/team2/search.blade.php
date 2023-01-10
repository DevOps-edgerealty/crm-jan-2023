<div class="row mb-5">
    <div class="col-lg-12">
        <form method="GET" action="{{url('team/search')}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row d-flex justify-content-center">
                <label for="example-text-input" class="col-md-1 offset-md-2 col-form-label">Search</label>

                <div class="col-md-4">
                    <input class="form-control" name="search" value="{{@$request->search}}" type="text" value="" placeholder="Search" id="example-text-input">
                    {{-- <a id="flip" class="float-end mt-2 fw-bold  text-decoration-underline" style="color: #000" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"> Advance Search <i class="bx bx-search-alt-2"></i></a> --}}
                </div>

                            <label for="agent" class="col-md-1 offset-md-1 col-form-label">Agent</label>


                <div class="col-md-2">
                        <div class="mb-3">
                            <select class="form-select" name="agent_id">
                                <option value="">Select Agent</option>
                                <option value="24">Ahamad Al Zebn</option>
                                <option value="36">Mohammed Khaled Hassan</option>
                                <option value="37">Omar Hamdino Mohamed</option>
                                <option value="38">Roshdy Osama Mosalam</option>

                            </select>
                        </div>
                    </div>

            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <button type="submit" class="btn btn-dark w-100" style="background-color: #000">Search</button>
                </div>
            </div>

        </form>
    </div>
</div>
