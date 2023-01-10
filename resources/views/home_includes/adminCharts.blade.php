{{-- Apex Charts for Admin --}}
<div class="card shadow-sm">
    <div class="card-body" style="position: relative;">
        <h4 class="">Overview Current Year with all Leads</h4>
        <div id="chart_admin" class="apex-charts" dir="ltr" style="max-width: 100%;  margin: 35px auto; opacity: 0.9;">
        </div>
        <div class="resize-triggers"><div class="expand-trigger"><div style="width: 713px; height: 443px;"></div></div><div class="contract-trigger"></div></div>
    </div>
</div>
{{-- Apex Charts for Admin --}}



<script type="text/javascript">

    // Data variables for Admin
    var camData = {{ json_encode($campaign_leads) }};
    var pData = {{ json_encode($portal_leads) }};
    var wData = {{ json_encode($website_leads) }};
    var max = {{ json_encode($max) }};
    // -Data variables for Admin


    // Charts for Admin
    var options_admin = {
        series: [{
            name: "Campaign",
            data: camData
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
    // -Charts for Admin


    var chartAdmin = new ApexCharts(document.querySelector("#chart_admin"), options_admin);
    chartAdmin.render();
</script>
