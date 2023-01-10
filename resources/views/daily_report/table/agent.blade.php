{{-- <div class="row mb-4">
    <div class="col-lg-12">
        <div class="float-end">
            <button class="btn btn-dark " style="background-color: black;" type="button" data-bs-toggle="modal" data-bs-target="#create_report_modal_agent">
                + Add Report
            </button>
        </div>
    </div>
</div> --}}
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



                        {{-- ACTIONS --}}
                        <td >
                            <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-plead-a-{{ $data->id }}" class="btn btn-outline-info btn-sm" title="View" style="margin-right: 5px">
                                <i class="fas fa-eye"> </i>
                            </a>
                        </td>
                    </tr>

                @endforeach

            </tbody>
        </table>
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






{{--
<!-- Modal -->
<div id="create_report_modal_agent" class="modal fade" tabindex="-1" aria-labelledby="modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg">
        <div class="modal-content">
            <div class="modal-header p-4">
                <h4 class="modal-title" id="target_modal">
                    Create a New Report
                </h4>
                <button type="button" class="btn-close bg-secondary" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>

            <div class="modal-body p-4">
                <form method="POST" action="{{url('daily-report/store')}}" enctype="multipart/form-data">
                @csrf
                    <div class="row mb-4 mt-1">
                        <div class="col-md-6">
                            <label for="inputName" class="form-label">Client Name</label>
                            <input type="text" class="form-control" name="name" id="inputName" placeholder="Tom Cruise" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputPhone" class="form-label">Client Phone</label>
                            <input type="text" class="form-control" name="phone" id="inputPhone" placeholder="+971 123 4567" required>
                        </div>
                    </div>


                    <div class="row my-4">
                        <div class="col-md-6">
                            <label for="inputEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="inputEmail" placeholder="tomcruise@gmail.com">
                        </div>
                        <div class="col-md-6">
                            <label for="inputLocation" class="form-label">Location</label>
                            <input type="text" class="form-control" name="location" id="inputLocation" placeholder="No. 34, Bay Avenue, Business Bay, Dubai" required>
                        </div>
                    </div>


                    <div class="row my-4">
                        <div class="col-md-6">
                            <label for="inputReason" class="form-label">Reason</label>
                            <select class="form-select" aria-label="Reason" id="reasonTypeAgent" name="reason" required>
                                <option selected>Select the Reason</option>
                                <option value="1">Developer</option>
                                <option value="2">Viewing</option>
                                <option value="4">Office</option>
                                <option value="3">Other</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="inputOther" class="form-label">Other</label>
                            <input type="text" class="form-control" id="inputOther" name="others" disabled>
                        </div>
                    </div>


                    <div class="row my-4">
                        <div class="col-md-6">
                            <label for="inputTime" class="form-label">Time of Occurance</label>
                            <input type="time" class="form-control" id="inputTime" name="time" required>
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
</div>


<script>
window.onload=function()
{
    document.getElementById("reasonType").onchange=function()
    {
        if(this.options[this.selectedIndex].value==2)
        {
            document.getElementById("inputOther").disabled=true;
        }
        else if(this.options[this.selectedIndex].value==1)
        {
            document.getElementById("inputOther").disabled=true;
        }
        else if(this.options[this.selectedIndex].value==3)
        {
            document.getElementById("inputOther").disabled=false;
            document.getElementById("inputOther").required=true;
        }
        else if(this.options[this.selectedIndex].value==4)
        {
            document.getElementById("inputOther").disabled=false;
            document.getElementById("inputOther").required=true;
        }
    }


}
</script> --}}
