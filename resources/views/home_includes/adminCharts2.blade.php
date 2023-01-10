{{-- Apex Charts for Admin --}}
<div class="card shadow-sm border">
    <div class="card-body" style="position: relative;">
        <h4 class="fw-bold" style="color: #000">Lead Stretch as of {{date('M Y')}}</h4>
        <div id="chart_admin" class="apex-charts" dir="ltr" style="max-width: 100%;  margin: 35px auto; opacity: 0.9;">
        </div>
        <div class="resize-triggers"><div class="expand-trigger"><div style="width: 713px; height: 443px;"></div></div><div class="contract-trigger"></div></div>
    </div>
</div>
{{-- Apex Charts for Admin --}}



<script type="text/javascript">

    // Data variables for Admin
    var camData = {{ json_encode($campaign_leads_2023) }};
    var pData = {{ json_encode($portal_leads_2023) }};
    var wData = {{ json_encode($website_leads_2023) }};
    var max = {{ json_encode($max) }};
    // -Data variables for Admin


     var options_admin = {
        chart: {
            foreColor: '#fff'
        },
        colors: [ '#003f5c','#bc5090', '#ffa600'],
        series: [
            {
                name: "Portal",
                data: pData
            },


            {
                name: 'Website',
                data: wData
            },
            {
                name: "Campaign",
                data: camData
            },
        ],
        chart: {
            type: 'bar',
            height: 250,
            stacked: true,
            foreColor: '#000',
            toolbar: {
                show: true
            },
            zoom: {
                enabled: true,
            }
        },
        responsive: [{
          breakpoint: 480,
          options: {
            legend: {
              position: 'bottom',
              offsetX: -10,
              offsetY: 0
            }
          }
        }],
        plotOptions: {
          bar: {
            horizontal: false,
            borderRadius: 3,
            columnWidth: 45,
          },
        },
        xaxis: {
            categories: [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',
            ],
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
        legend: {
          position: 'right',
          offsetY: 40
        },
        fill: {
          opacity: 1
        }
    };

    var chartAdmin = new ApexCharts(document.querySelector("#chart_admin"), options_admin);
    chartAdmin.render();
</script>
