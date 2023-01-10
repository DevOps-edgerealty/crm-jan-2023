
<div class="card shadow-sm row border border px-2 " style="height: 225px !important;">
    <div class="card-body">
        <h4 class="card-title mb-2">Earnings</h4>

        <div class="row">
            <div class="col-sm-6">
                <p class="text-muted my-2">Earnings This Month</p>

                @isset($rog_commission_last_month)
                    <h3>AED {{number_format($total_net_commission_this_month)}}</h3>
                    <p class="text-muted d-md-block d-lg-block d-none"><span class="text-success me-2 "> {{ $rog_commission_this_month }}% <i class="mdi mdi-arrow-up"></i> </span> From previous period</p>
                @else
                    <h3>AED {{number_format($total_net_commission_this_month)}}</h3>
                    <p class="text-muted d-md-block d-lg-block d-none"><span class="text-success me-2"> 0% <i class="mdi mdi-arrow-up"></i> </span> From previous period</p>
                @endisset
                <div class="mt-0 ">
                    @if ($leader_detail_count === 0)
                        <a href="#" class="btn bg-black text-white waves-effect waves-light btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="You have no deals" disabled>My History <i class="mdi mdi-arrow-right ms-1"></i></a>
                    @else
                        <a href="{{ url('/my-earnings')}}" class="btn bg-black text-white waves-effect waves-light btn-sm" >History <i class="mdi mdi-arrow-right ms-1"></i></a>
                    @endif
                </div>

            </div>
            <div class="col-sm-6">

                <p class="text-muted my-2">Last Month</p>
                @isset($rog_commission_last_month)
                    <h3>AED {{number_format($total_net_commission_last_month)}}</h3>
                    {{-- <p class="text-muted"><span class="text-success me-2"> {{ $rog_commission_last_month }}% <i class="mdi mdi-arrow-up"></i> </span> From previous period</p> --}}
                @else
                    <h3>AED {{number_format($total_net_commission_last_month)}}</h3>
                    {{-- <p class="text-muted"><span class="text-success me-2"> 0% <i class="mdi mdi-arrow-up"></i> </span> From previous period</p> --}}
                @endisset

            </div>
        </div>
    </div>
</div>
