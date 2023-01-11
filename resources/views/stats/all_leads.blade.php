


<div class="col-lg-9">
    <div class="card" style="height: 460px !important;">
        {{-- Apex Charts --}}
        <div class="card-body" style="position: relative;">
            <h4 class="">Overview Current Year with all Leads</h4>
            <div id="chart_agent_stats" class="apex-charts" dir="ltr" style="max-width: 100%;  margin: 35px auto; opacity: 0.9;">
            </div>
            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 713px; height: 443px;"></div></div><div class="contract-trigger"></div></div>
        </div>
        {{-- Apex Charts --}}

    </div>
</div>
<div class="col-lg-3">
    <div class="card" style="height: 460px !important;">
        <div class="card-body">
            <h4>Details</h4>
            <div class="row mt-5">
                <div class="col-sm-6">
                    <p>Leads {{\Carbon\Carbon::now()->format('Y')}}</p>
                    {{-- {{var_dump($total_leads)}} --}}
                    <h3>{{$dashboard_total_leads_2023}}</h3>
                </div>
                <div class="col-sm-6">
                    <p>Leads {{\Carbon\Carbon::now()->subYear()->format('Y')}}</p>
                    <h3>{{$dashboard_total_leads_2022}}</h3>
                    {{-- <p>Rate of Growth {{\Carbon\Carbon::now()->format('M, Y')}}</p>
                    <h3>{{ $rog }} %</h3> --}}
                </div>
            </div>




            <div class="row mt-5">
                <div class="col-sm-6">
                    <p>Portal Leads</p>
                    <h3>{{$dashboard_portal_lead_count}}</h3>
                </div>
                <div class="col-sm-6">
                    <p>Campaign Leads</h3>
                    <h3>{{$dashboard_campaign_lead_count}}</h3>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-sm-6">
                    <p>Website Leads</p>
                    <h3>{{$dashboard_website_lead_count}}</h3>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
            <p class="mt-3">The above values reflect only those on active leads</p>
        </div>
    </div>
</div>
{{-- {{var_dump($campaign_leads)}} --}}
<script>

// Apex charts data
    var options2 = {
        series: [
        {
            name: "High - 2013",
            data: [28, 29, 33, 36, 32, 32, 33, 28, 29, 33, 36, 32, 32, 33]
        },
        {
            name: "Low - 2013",
            data: [12, 11, 14, 18, 17, 13, 13, 15, 20, 17, 34, 22, 33, 44,]
        }
        ],
        chart: {
            height: 350,
            type: 'line',
            dropShadow: {
                enabled: true,
                color: '#000',
                top: 18,
                left: 7,
                blur: 10,
                opacity: 0.2
            },
            toolbar: {
                show: false
            }
        },
        colors: ['#c71f1f', '#404040'],
        dataLabels: {
            enabled: true,
        },
        stroke: {
        curve: 'smooth'
        },
        title: {
        text: '',
        align: 'left'
        },
        grid: {
        borderColor: '#e7e7e7',
        row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
        },
        },
        markers: {
            size: 1
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            title: {
                text: 'Month'
            }
        },
        yaxis: {
            title: {
                text: 'Leads'
            },
            min: 5,
            max: 60
        },
        legend: {
            position: 'top',
            horizontalAlign: 'right',
            floating: true,
            offsetY: -25,
            offsetX: -5
        }
    };


    var cData = {{ json_encode($campaign_leads) }};
    var pData = {{ json_encode($portal_leads) }};
    var wData = {{ json_encode($website_leads) }};
    var max = {{ json_encode($max) }};
    // console.log(cData.reverse);


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
            height: 287,
            type: 'line',
            zoom: {
                enabled: true
            },
        },
        colors: ['#dd2222', '#008000', '#6b00b3'],
        theme: {
        monochrome: {
            enabled: false,
            color: '#255aee',
            shadeTo: 'dark',
            shadeIntensity: 0.65
            }
        },
        dataLabels: {
        enabled: true
        },
        stroke: {
            width: [4, 4, 4],
            curve: 'straight',
            dashArray: [0, 0, 0]
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
