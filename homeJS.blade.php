<script type="text/javascript">
    var cData = JSON.parse(`<?php echo $leads_data; ?>`);
    // var campaign_data = JSON.parse(`<?php echo $campaigns_data; ?>`);
    // console.log(campaign_data);
    let lData = [];
    // let campaignData = [];
    let data_months = [];
    // campaign_data.forEach(mobile => {
    //     for (let key in mobile) {
    //         if (`${key}` == 'total_leads')
    //         {
    //             // console.log(`${key}: ${mobile[key]}`);
    //             campaignData.push(`${mobile[key]}`);
    //         }
    //         // console.log(`${key}: ${mobile[key]}`);
    //     }
    // });
    cData.forEach(mobile => {
        for (let key in mobile) {
            if (`${key}` == 'total_leads')
            {
                // console.log(`${key}: ${mobile[key]}`);
                lData.push(`${mobile[key]}`);
            }
            if (`${key}` == 'month')
            {
                // console.log(`${key}: ${mobile[key]}`);
                data_months.push(`${mobile[key]}`);
            }
            // console.log(`${key}: ${mobile[key]}`);
        }
    });
    // console.log(lData);
    // console.log(data_months);
    // console.log(campaignData);

    var options = {
        series: [{
            name: 'Campaign Bar',
            type: 'column',
            data: lData.reverse(),


        },
        // {
        //     name: 'Portal',
        //     type: 'area',
        //     data: campaignData.reverse(),
        // },
        {
            name: 'Campaign Line',
            type: 'line',
            data: lData.reverse(),
        }
        ],
        chart: {
            height: 450,
            type: 'line',
            stacked: false,
        },
        stroke: {
            width: [0, 2, 5],
            curve: 'smooth'
        },
        plotOptions: {
            bar: {
                columnWidth: '50%'
            }
        },

        fill: {
            colors: ['#F1B44C'],
            opacity: [0.35, 1, 1],
            gradient: {
                inverseColors: false,
                shade: 'light',
                type: "vertical",
                opacityFrom: 0.85,
                opacityTo: 0.55,
                stops: [0, 100, 100, 100]
            }
        },
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],

        markers: {
            colors: undefined,
            strokeColors: '#fff',
            strokeWidth: 2,
            strokeOpacity: 0.9,
            strokeDashArray: 0,
            fillOpacity: 1,
            discrete: [],
            shape: "circle",
            radius: 2,
            offsetX: 0,
            offsetY: 0,
            onClick: undefined,
            onDblClick: undefined,
            showNullDataPoints: true,
            hover: {
            size: 4,
            sizeOffset: 3
            }
        },
        xaxis: {
            type: 'integer'
        },
        yaxis: {
            title: {
                text: 'No. of Leads',
            },
            min: 0,
        },
        tooltip: {
            shared: true,
            intersect: false,
            y: {
                formatter: function (y) {
                if (typeof y !== "undefined") {
                    return y.toFixed(0) + " points";
                }
                return y;

                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart_agent"), options);
    chart.render();
</script>
