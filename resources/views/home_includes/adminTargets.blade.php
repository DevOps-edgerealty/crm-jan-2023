<div class="card shadow-sm"  style="height: 385px;">
    <div class="card-body">
        <h4 class="mb-4">Target Goals</h4>
        <div class="text-center">
            <div class="avatar-sm mx-auto mb-4">
                <span class="avatar-title rounded-circle bg-black bg-soft font-size-24">
                    <i class="mdi mdi-target-account text-white"></i>
                </span>
            </div>
            <p class="font-16 text-muted"></p>
            <h4 class="mb-1">
                <a href="javascript: void(0);" class="text-dark">
                    Target <span class="text-danger fw-bold font-16"> {{ number_format($target_total) }} AED </span>
                </a>
            </h4>
            <p class="my-0 py-0 mb-4">month of {{ now()->format('M, Y') }} </p>
            <div class="">
                <div class="progress">
                    <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ $achievement_rate2 }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $achievement_rate2 }}%"></div>
                </div>
                <p class="text-mute mt-2">Achieved
                    @if(isset($achievement_rate2))
                        <span class="text-success">{{ number_format($achievement_rate2, 1, '.', ',')}} %</span>
                    @else
                        0 %
                    @endif
                </p>
            </div>

            {{-- <p class="text-muted">
                Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus tincidunt.
            </p>
            <a href="javascript: void(0);" class="text-primary font-16">
                Learn more
                <i class="mdi mdi-chevron-right"></i>
            </a> --}}
        </div>
        <div class="row mt-0">
            <div class="col-6">
                <div class="social-source text-center mt-3">
                    <div class="avatar-xs mx-auto mb-3">
                        <span class="avatar-title rounded-circle bg-dark font-size-16">
                            <i class="mdi mdi-calendar-arrow-left text-white"></i>
                        </span>
                    </div>
                    <h5 class="font-size-15">
                        @if(isset($target_total_last_month))
                            AED {{ number_format($target_total_last_month) }}
                        @else
                            No Target Found
                        @endif
                    </h5>
                    <p class="text-muted mb-0">Target Last Month  </p>
                </div>
            </div>
            <div class="col-6 px-0">
                <div class="social-source text-center mt-3">
                    <div class="avatar-xs mx-auto mb-3">
                        <span class="avatar-title rounded-circle bg-success font-size-16">
                                <i class="mdi mdi-calendar text-white"></i>
                            </span>
                    </div>
                    <h5 class="font-size-15">
                        @if(isset($leaderboard_total))
                            AED {{ number_format($leaderboard_total) }}
                        @else
                            No Target Found
                        @endif
                    </h5>
                    <p class="text-muted mb-0">Last Month  </p>
                </div>
            </div>
        </div>

    </div>
</div>
