
                <div class="col-lg-4 ">

                    @include('home_includes.agents_cards')


                </div>


                <div class="col-lg-6">
                    <div class="card">

                        {{-- Apex Charts --}}
                        <div class="card-body" style="position: relative;">
                            <h4 class="card-title mb-4">Total Commission vs Leads Recieved</h4>
                            <div id="chart_agent_stats" class="apex-charts" dir="ltr" style="max-width: 100%;  margin: 35px auto; opacity: 0.9;">
                            </div>
                            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 713px; height: 443px;"></div></div><div class="contract-trigger"></div></div>
                        </div>
                        {{-- Apex Charts --}}
                    </div>

                </div>


                 <div class="col-lg-2">
                    <div class="card" style="min-height: 480px;">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Details</h4>



                            <div class="row mt-5">
                                <div class="col-sm-12">
                                    <p>Total Commission</p>
                                    <h5>0.00 AED </h5>
                                </div>
                            </div>



                            <div class="row mt-5">
                                <div class="col-sm-12">
                                    <p>Total Rent Value</p>
                                    <h5>0.00 AED </h5>
                                </div>

                            </div>



                            <div class="row mt-5">
                                <div class="col-sm-12">
                                    <p>Total Sale Value</p>
                                    <h5>0.00 AED </h5>
                                </div>
                            </div>





                        </div>
                    </div>
                </div>

<script>


    // console.log(cData.reverse);


    var options = {
        series: [{
            name: "Net Commission",
            data: [0,0,0,0,0,0,0,0,0,0,0,0]
        },
        {
            name: 'Leads Recieved',
            data: [0,0,0,0,0,0,0,0,0,0,0,0]
        }
        ],
        chart: {
            height: 350,
            type: 'area',
            toolbar: {
                show: false
            },
            zoom: {
                enabled: true
            },
        },
        colors: ['#8d02eb', '#1f0133'],
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
            curve: 'smooth',
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
            max: 1000
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

