<div class="my-3">

<div class="card shadow-sm border " style="height: 385px;">
    <div class="card-body ">
        <span class="card-title mb-4 fw-bold font-size-18" style="color: #000">Team Members</span>
        <a href="{{ url('/leader_board') }}" class="btn btn-sm btn-dark text-right" style="background-color: black">View More</a>


        <div class="table-responsive my-auto align-middle">
            <table class="table align-middle table-nowrap">
                <tbody>
                    @foreach ($leader_board_dashboard as $data)
                    <tr>
                        <td style="width: 50px;">
                            <img src="{{URL::asset('public/assets/images/users/'.@$data->image)}}" class="rounded-circle avatar-xs" alt="">
                        </td>
                        <td>
                            <h5 class="font-size-14 m-0">
                                <a href="javascript: void(0);" class="text-dark">{{$data->name}}</a>
                            </h5>
                        </td>
                        <td>
                            <div>
                                <a href="javascript: void(0);" class="badge bg-success bg-opacity-10 text-success font-size-13">
                                    @if ($data->totalcommission == '')
                                        0 AED
                                    @else
                                        {{ number_format($data->totalcommission) }} AED
                                    @endif
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
