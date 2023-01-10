<div class="card shadow-sm" style="height: 360px !important;">
    <div class="card-body">
        <h4 class="mb-4">My Target Achieved</h4>
        <div class="text-center">
            <div class="avatar-sm mx-auto mb-4">
                <span class="avatar-title rounded-circle bg-success bg-soft font-size-24">
                    <i class="mdi mdi-currency-usd text-success"></i>
                </span>
            </div>
            <p class="font-16 text-muted"></p>
            <h4 class="mb-3">
                <a href="javascript: void(0);" class="text-dark">
                    Target <span class="text-success fw-bold font-16">
                        @if(isset($target_set))
                            @if(!$target_set->isEmpty())
                                {{ number_format(@$target_set[0]->target) }} <span class="text-dark">AED</span>
                            @else
                                0 sales
                            @endif
                        @else
                            0 sales
                        @endif
                    </span>
                </a>
            </h4>
            <div class="">
                <div class="progress">
                    <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ $achievement_rate }}" aria-valuemin="0" aria-valuemax="100" style="width: {{$achievement_rate}}%"></div>
                </div>
                <p class="text-mute  mt-2">Achieved  <span class="text-success">{{ number_format($achievement_rate, 1, '.', ',')}} %</span></p>
            </div>

            {{-- <p class="text-muted">
                Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus tincidunt.
            </p>
            <a href="javascript: void(0);" class="text-primary font-16">
                Learn more
                <i class="mdi mdi-chevron-right"></i>
            </a> --}}
        </div>
        <div class="row mt-1">
            <div class="col-6">
                <div class="social-source text-center mt-3">
                    <div class="avatar-xs mx-auto mb-3">
                        <span class="avatar-title rounded-circle bg-pink font-size-16">
                            <i class="mdi mdi-page-previous-outline text-white"></i>
                        </span>
                    </div>
                    <h5 class="font-size-15">Last Month</h5>
                    <p class="text-muted mb-0">
                        @if(isset($target_last_month))
                            @if($target_last_month != null)
                                {{ number_format($target_last_month->target) }} sales
                            @else
                                No Target Found
                            @endif
                        @else
                            No Target Found
                        @endif
                    </p>
                </div>
            </div>
            <div class="col-6">
                <div class="social-source text-center mt-3">
                    <div class="avatar-xs mx-auto mb-3">
                        <span class="avatar-title rounded-circle bg-warning font-size-16">
                                <i class="mdi mdi-update text-white"></i>
                            </span>
                    </div>
                    <h5 class="font-size-15">Achieved</h5>
                    <p class="text-muted mb-0">AED {{ number_format($leaderboard_this_month) }}</p>
                </div>
            </div>
        </div>

    </div>
</div>
