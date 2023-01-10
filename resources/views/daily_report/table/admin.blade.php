
<div class="table-rep-plugin" >

    <div class="table-responsive mb-0" data-pattern="priority-columns">
        <table id="tech-companies-1" class="table table-hover " style="font-size:12px;z-index: 100;">

                <thead class="shadow-sm border">
                    <tr>
                        <th>Date</th>
                        <th>NAME</th>
                        <th>PHONE</th>
                        <th>EMAIL</th>
                        <th>REASON</th>
                        <th>TIME</th>
                        <th>LOCATION</th>
                        <th>AGENT</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>


            <tbody class="px-2">
                @foreach ($daily_reports as $data)

                    <tr class="px-2">
                        {{-- DATE --}}
                        <td class="px-3">
                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-a-{{ $data->id }}">
                                {{$data->created_at->format('j F, Y')}}
                            </a>
                        </td>


                        {{-- NAME --}}
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-a-{{ $data->id }}">
                                {{ $data->name }}
                            </a>
                        </td>


                        {{-- PHONE --}}
                        <td>
                            <span class="badge badge-soft-info font-size-12" onclick="this.innerHTML='{{ $data->phone }}'">
                                Click To Show
                            </span>
                        </td>


                        {{-- EMAIL --}}
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-a-{{ $data->id }}">
                                {{ $data->email }}
                            </a>
                        </td>



                        {{-- REASON --}}
                        <td>
                        @if(!empty($data->reason))
                            @if($data->reason == '1')
                                <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-a-{{ $data->id }}">
                                    Developer
                                </a>
                            @elseif ($data->reason == '2')
                                <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-a-{{ $data->id }}">
                                    Viewing
                                </a>
                            @elseif($data->reason == '4')
                                <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-a-{{ $data->id }}">
                                    Office
                                </a>
                            @elseif($data->reason == '3')
                                <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-a-{{ $data->id }}">
                                    {{ Str::limit(@$data->others, 25) }}
                                </a>
                            @endif
                        @endif
                        </td>



                        {{-- TIME --}}
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-a-{{ $data->id }}">
                                {{-- {{ $data->time->date("h:i:sa")}} --}}
                                {{\Carbon\Carbon::createFromFormat('H:i:s',$data->time)->format('h:i a')}}
                            </a>
                        </td>




                        {{-- LOCATION --}}
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-a-{{ $data->id }}">
                                {{ Str::limit(@$data->location, 25) }}
                            </a>
                        </td>



                        {{-- AGENT NAME --}}
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-a-{{ $data->id }}">
                                {{ Str::limit(@$data->daily_reports->name, 25) }}
                            </a>
                        </td>



                        {{-- ACTIONS --}}
                        <td >
                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-a-{{ $data->id }}" class="btn btn-outline-info btn-sm" title="Detail" style="margin-right: 5px">
                                <i class="fas fa-eye"> </i>
                            </a>&nbsp;&nbsp;

                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-a-update-{{ $data->id }}" class="btn btn-outline-secondary btn-sm" title="Detail" style="margin-right: 5px">
                                <i class="fas fa-pencil-alt"> </i>
                            </a>&nbsp;&nbsp;

                            <a href="#" data-bs-toggle="modal" data-bs-target=".delete-{{ $data->id }}" class="btn btn-outline-danger btn-sm" title="Detail" style="margin-right: 5px">
                                <i class="fas fa-trash"> </i>
                            </a>
                        </td>


                        @foreach ($daily_reports as $data)
                        <div class="modal fade delete-{{ $data->id }}" tabindex="-5" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header p-4">
                                            <h4 class="modal-title" id="delete_modal">
                                                Delete Report
                                            </h4>
                                            <button type="button" class="btn-close bg-secondary" data-bs-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <form method="POST" action="{{url('daily-reports/delete/'.$data->id)}}" enctype="multipart/form-data">
                                        @csrf
                                            <div class="modal-body p-4">
                                                <div class="row mb-4 mt-1">
                                                    <div class="col-md-12 x-auto">
                                                        <p class="text-center">Are you sure you want to delete this record?</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer mx-auto">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </div>
                                        </form>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </div>
                        @endforeach
                    </tr>

                @endforeach

            </tbody>
        </table>
        {!! $daily_reports->appends($_GET)->links() !!}
        {{ $daily_reports->firstItem() }} - {{ $daily_reports->lastItem() }} Total Daily Reports {{$daily_reports->total()}}
    </div>
</div>


@foreach ($daily_reports as $data)
<div class="modal fade bs-example-modal-xl-plead-a-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Report Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-rep-plugin">
                                <div class="table-responsive mb-0" data-pattern="priority-columns">
                                    <table id="tech-companies-1" class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Date :</th>
                                                <td>Created on the {{$data->created_at->format('j F, Y')}}</td>
                                            </tr>
                                            <tr>
                                                <th>Reason</th>
                                                <td>
                                                    @if(!empty($data->reason))
                                                        @if($data->reason == '1')
                                                            Developer
                                                        @elseif ($data->reason == '2')
                                                            Viewing
                                                        @elseif ($data->reason == '4')
                                                            Office
                                                        @elseif($data->reason == '3')
                                                            {{ $data->others }}
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Time</th>
                                                <td>
                                                    {{\Carbon\Carbon::createFromFormat('H:i:s',$data->time)->format('h:i a')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Client Name</th>
                                                <td>
                                                    {{ $data->name }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Phone :</th>
                                                <td>{{$data->phone}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">E-mail :</th>
                                                <td>{{$data->email}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Agent Name :</th>
                                                <td>{{@$data->daily_reports->name}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Location :</th>
                                                <td>{{$data->location}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
@endforeach



@foreach ($daily_reports as $data)
<div class="modal fade bs-example-modal-xl-plead-a-update-{{ $data->id }}" tabindex="-2" role="dialog" aria-labelledby="myExtraLargeModalLabe3" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header p-4">
                    <h4 class="modal-title" id="update_modal">
                        Update Report
                    </h4>
                    <button type="button" class="btn-close bg-secondary" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <div class="modal-body p-4">
                    <form method="POST" action="{{url('daily-reports/update')}}" enctype="multipart/form-data">
                    @csrf
                        <input type="text" class="form-control" name="id" id="inputId" value="{{ $data->id }}" hidden>


                        <div class="row mb-4 mt-1">
                            <div class="col-md-6">
                                <label for="inputName" class="form-label">Client Name</label>
                                <input type="text" class="form-control" name="name" id="inputName" value="{{ $data->name }}" >
                            </div>
                            <div class="col-md-6">
                                <label for="inputPhone" class="form-label">Client Phone</label>
                                <input type="text" class="form-control" name="phone" id="inputPhone" value="{{ $data->phone }}" >
                            </div>
                        </div>


                        <div class="row my-4">
                            <div class="col-md-6">
                                <label for="inputEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="inputEmail" value="{{ $data->email }}">
                            </div>
                            <div class="col-md-6">
                                <label for="inputLocation" class="form-label">Location</label>
                                <input type="text" class="form-control" name="location" id="inputLocation" value="{{ $data->location }}">
                            </div>
                        </div>


                        <div class="row my-4">
                            <div class="col-md-6">
                                <label for="inputReason" class="form-label">Reason</label>
                                <select class="form-select" aria-label="Reason" id="reasonTypeUpdate-{{ $data->id }}" name="reason">
                                    @if($data->reason == '1')
                                        <option value="1" selected>Developer</option>
                                        <option value="2">Viewing</option>
                                        <option value="4">Office</option>
                                        <option value="3">Other</option>
                                    @elseif($data->reason == '2')
                                        <option value="1" >Developer</option>
                                        <option value="2" selected>Viewing</option>
                                        <option value="4">Office</option>
                                        <option value="3">Other</option>
                                    @elseif($data->reason == '3')
                                        <option value="1" >Developer</option>
                                        <option value="2">Viewing</option>
                                        <option value="4">Office</option>
                                        <option value="3" selected>Other</option>
                                    @elseif($data->reason == '4')
                                        <option value="1" >Developer</option>
                                        <option value="2">Viewing</option>
                                        <option value="4" selected>Office</option>
                                        <option value="3" >Other</option>
                                    @endif
                                </select>
                            </div>

                            @if($data->reason == '3')
                                <div class="col-md-6">
                                    <label for="inputOtherUpdate" class="form-label">Other</label>
                                    <input type="text" class="form-control" id="inputOtherUpdate" name="others" value="{{ $data->others }}">
                                </div>
                            @else
                                <div class="col-md-6">
                                    <label for="inputOtherUpdate" class="form-label">Other</label>
                                    <input type="text" class="form-control" id="inputOtherUpdate" name="others" >
                                </div>
                            @endif
                        </div>


                        <div class="row my-4">
                            <div class="col-md-6">
                                <label for="inputTime" class="form-label">Time of Occurance</label>
                                <input type="time" class="form-control" id="inputTime" name="time" value="{{ $data->time }}" required>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary w-100" style="margin-top: 26px !important;">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
@endforeach




