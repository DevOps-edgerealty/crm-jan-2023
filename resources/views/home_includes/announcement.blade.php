<div class="card">
    <div class="card-body">
        {{-- <h4 class="card-title mb-4">INFORMATION</h4> --}}
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive m-3">
                    <table class="table align-middle table-nowrap mb-0">
                        <thead   style="color: #fff;background-color: #000">
                            <tr>

                                <th class="align-middle">Announcements</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($announcement as $data)
                                <tr>

                                    <td><b>{{$data->announcements}}</b></td>



                                </tr>
                            @endforeach





                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
