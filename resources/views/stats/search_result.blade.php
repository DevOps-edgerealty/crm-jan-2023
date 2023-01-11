


<div class="col-lg-9">
    <div class="card" style="height: 460px !important;">

        {{-- Apex Charts --}}
        <div class="card-body" style="position: relative;">
            @if (isset($request->agent))
                <h4>Statistics of agent {{ $agent_name }}</h4>
            @else
                <h4 class="">Overview Current Year with all Leads</h4>
            @endif
            <div id="chart_agent_stats" class="apex-charts" dir="ltr" style="max-width: 100%;  margin: 35px auto; opacity: 0.9;">
            </div>
            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 713px; height: 443px;"></div></div><div class="contract-trigger"></div></div>
        </div>
        {{-- Apex Charts --}}
    </div>
</div>
<div class="col-lg-3">

    <div class="card" style="height: 460px !important;">
        <div class="card-body" >
            <h4>Details</h4>

            {{-- Leads of this year --}}
            <div class="row mt-5">
                <div class="col-sm-6">
                    <p>Leads 2023</p>
                    <h3>{{$dashboard_total_leads_2023}}</h3>
                </div>
                <div class="col-sm-6">
                    <p>Leads 2022</p>
                    @if(isset($dashboard_total_leads_2022))

                        <h3>{{$dashboard_total_leads_2022}}</h3>
                    @else
                        <h3>-</h3>
                    @endif
                    {{-- <p>Rate of Growth</p>
                    <h3>{{ $rog }} %</h3> --}}
                </div>
            </div>



            <div class="row mt-5">

                {{-- Leads of last year --}}
                <div class="col-sm-6">
                    <p>Portal Leads</p>
                    @if(isset($dashboard_portal_lead_count))
                        <h3>{{$dashboard_portal_lead_count}}</h3>
                    @elseif(isset($dashboard_portal_lead_count))
                        <h3>{{$dashboard_portal_lead_count}}</h3>
                    @else
                        <h3>-</h3>
                    @endif
                </div>


                {{-- Campaign leads --}}
                <div class="col-sm-6">
                    <p>Campaign Leads</h3>
                    @if(isset($dashboard_campaign_lead_count))

                        <h3>{{$dashboard_campaign_lead_count}}</h3>
                    @else
                        <h3>-</h3>
                    @endif
                </div>

            </div>



            <div class="row mt-5">

                {{-- Website leads --}}
                <div class="col-sm-6">
                    <p>Website Leads</p>
                    @if(isset($dashboard_website_lead_count))
                        <h3>{{$dashboard_website_lead_count}}</h3>
                    @else
                        <h3>-</h3>
                    @endif
                </div>

                {{-- Portal leads --}}
                <div class="col-sm-6">

                </div>

            </div>
            <p class="mt-3">The above values reflect only those on active leads</p>
        </div>
    </div>
</div>

{{-- {{var_dump($campaign_obj_1[3])}} --}}

<script>

// Apex charts data

    var cData = {{ json_encode($campaign_leads) }};
    var pData = {{ json_encode($portal_leads) }};
    var wData = {{ json_encode($website_leads) }};
    var max = {{ json_encode($max) }};

    console.log(cData);
    console.log(pData);
    console.log(wData);

    var options = {
        series: [{
            name: "Campaign",
            data: cData
        },
        {
            name: "Portal",
            data: pData
        },
        {
            name: 'Website',
            data: wData
        }
        ],
        chart: {
            height: 350,
            type: 'line',
            zoom: {
                enabled: true
            },
        },
        colors: ['#dd2222', '#008000', '#6b00b3'],
        dataLabels: {
        enabled: true
        },
        stroke: {
            width: [4, 2, 2],
            curve: 'straight',
            dashArray: [0, 4, 3]
        },
        title: {
        text: 'Page Statistics',
        align: 'left'
        },
        legend: {
            tooltipHoverFormatter: function(val, opts) {
                return val + ' - ' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + ''
            }
        },
        markers: {
            size: 0,
            hover: {
                sizeOffset: 6
            }
        },
        xaxis: {
            categories: [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',
            ],
        },
        yaxis: {
            title: {
                text: 'Leads'
            },
            min: 0,
            max: max
        },
        tooltip: {
            y: [
                {
                    title: {
                        formatter: function (val) {
                        return val + " leads"
                        }
                    },
                },
                {
                    title: {
                        formatter: function (val) {
                        return val + " leads"
                        }
                    }
                },
                {
                    title: {
                        formatter: function (val) {
                        return val + " leads";
                        }
                    }
                },
            ]
        },
        grid: {
            borderColor: '#f1f1f1',
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart_agent_stats"), options);
    chart.render();

    // APex charts data
</script>
