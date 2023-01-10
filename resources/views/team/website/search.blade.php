<div class="row mb-5">
    <div class="col-lg-12">
        <form method="GET" action="{{url('team/website/search')}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row d-flex justify-content-center">

                <div class="col-md-6">
                    <input class="form-control" name="search" value="{{@$request->search}}" type="text" value="" placeholder="Search Name" id="example-text-input">
                </div>

                <div class="col-md-2">
                    <div class="mb-3">
                        <select class="form-select" name="agent_id">
                            <option value="">Select Agent</option>
                            @foreach($team_members as $data)
                                <option value="{{$data->id}}">{{$data->name}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <button type="submit" class="btn btn-dark w-100">Search</button>
                </div>
            </div>

        </form>
    </div>
</div>
