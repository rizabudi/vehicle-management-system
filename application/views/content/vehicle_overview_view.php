<div class="content col-sm-9 col-lg-10" style="padding: 0px;position: fixed;right: 0px;bottom: 0px;top:0px;">
    <div class="ext-container">
        <div class="col-sm-9 col-lg-10 ext-tabs-body ext-fixed-content">
            <div class="col-md-6 ext-no-padding ext-no-padding">
                <div class="ext-panel-header">Vehicle Utilization<span class="ext ext-close"></span><span class="ext ext-maxsimize"></span></div>
                <div class="ext-panel-body">
                    <div id="pie_chart"></div>

                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-6 ext-no-padding ext-no-padding-last">
                <div class="ext-panel-header">Vehicle Age<span class="ext ext-close"></span><span class="ext ext-maxsimize"></span></div>
                <div class="ext-panel-body">
                    <div id="stack_chart"></div>

                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="clearfix"></div>
            <br>

            <div class="col-md-4 ext-no-padding ext-no-padding">
                <div class="ext-panel-header">Vehicle Healthy<span class="ext ext-close"></span><span class="ext ext-maxsimize"></span></div>
                <div class="ext-panel-body">
                    <div id="health_chart"></div>

                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="col-md-4 ext-no-padding ext-no-padding">
                <div class="ext-panel-header">Vehicle Speed Average<span class="ext ext-close"></span><span class="ext ext-maxsimize"></span></div>
                <div class="ext-panel-body">
                    <div id="gauge_chart"></div>

                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="col-md-4 ext-no-padding ext-no-padding-last">
                <div class="ext-panel-header">Vehicle Ontime Delivery<span class="ext ext-close"></span><span class="ext ext-maxsimize"></span></div>
                <div class="ext-panel-body">
                    <div id="ontime_chart"></div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/ajax/inaframework/helper.js"></script>

<script src="<?php echo base_url(); ?>assets/js/plugins/highchart/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/highchart/highcharts-more.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/highchart/modules/solid-gauge.src.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/highchart/modules/exporting.js"></script>
<script type="text/javascript">
    $(function() {
        Highcharts.setOptions({
            colors: ['#3366cc', '#dc3912', '#ff9900', '#109618', '#990099'],
            chart: {
                style: {
                    fontFamily: 'Arial'
                }
            },
            exporting: {enabled: false}
        });

        $('#pie_chart').highcharts({
            chart: {
                plotBackgroundColor: "#ededed",
                backgroundColor: "#ededed",
                plotBorderWidth: null,
                plotShadow: false,
                marginBottom: 100
            },
            title: {
                text: 'Vehicle Utilization'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            legend: {
                layout: 'horizontal',
                align: 'left',
                verticalAlign: 'bottom',
                floating: true,
                x: 0,
                y: 0,
                itemWidth: 150,
                itemStyle: {
                    color: '#000000',
                    fontWeight: 'normal',
                    fontSize: '11px',
                    padding: '5px'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false,
                    },
                    showInLegend: true
                }
            },
            series: [{
                    type: 'pie',
                    name: 'Browser share',
                    data: [
                        ['On Delivery - Moving', 35.0],
                        ['On Delivery - Stoping', 26.8],
                        ['Returning from Delivery', 8.5],
                        ['Idle - Moving', 6.2],
                        ['Idle - Parking', 10.7]
                    ]
                }]
        });

        Highcharts.setOptions({
            colors: ['#dc3912', '#ff9900', '#109618'],
            chart: {
                style: {
                    fontFamily: 'Arial'
                }
            }
        });

        $('#stack_chart').highcharts({
            chart: {
                type: 'bar',
                plotBackgroundColor: "#ededed",
                backgroundColor: "#ededed",
                plotBorderWidth: null,
                plotShadow: false,
                marginBottom: 100
            },
            legend: {
                layout: 'horizontal',
                align: 'left',
                verticalAlign: 'bottom',
                floating: true,
                itemStyle: {
                    color: '#000000',
                    fontWeight: 'normal',
                    fontSize: '11px',
                    padding: '5px'
                }
            },
            title: {
                text: 'Vehicle Age'
            },
            xAxis: {
                categories: ['Idle', 'On Delivery']
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total Years'
                }
            },
            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },
            series: [{
                    name: 'Above 5 Year',
                    data: [5, 3]
                }, {
                    name: '2 to 5 Year',
                    data: [2, 2]
                }, {
                    name: 'Under 2 Year',
                    data: [3, 4]
                }]
        });

        Highcharts.setOptions({
            colors: ['#dc3912', '#ff9900', '#109618'],
            chart: {
                style: {
                    fontFamily: 'Arial'
                }
            }
        });

        $('#health_chart').highcharts({
            chart: {
                type: 'column',
                plotBackgroundColor: "#ededed",
                backgroundColor: "#ededed",
                plotBorderWidth: null,
                plotShadow: false,
                marginBottom: 100
            },
            legend: {
                layout: 'horizontal',
                align: 'left',
                verticalAlign: 'bottom',
                floating: true,
                itemStyle: {
                    color: '#000000',
                    fontWeight: 'normal',
                    fontSize: '11px',
                    padding: '5px'
                }
            },
            title: {
                text: 'Vehicle Healty'
            },
            xAxis: {
                categories: ['Idle', 'On Delivery']
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total Years'
                }
            },
            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },
            series: [{
                    name: 'Need Routine Maintenance',
                    data: [5, 3]
                }, {
                    name: 'Need Part Replacement',
                    data: [2, 2]
                }, {
                    name: 'Health',
                    data: [3, 4]
                }]
        });

        $('#gauge_chart').highcharts({
            chart: {
                type: 'gauge',
                plotBackgroundColor: "#ededed",
                backgroundColor: "#ededed",
                plotBorderWidth: null,
                plotShadow: false,
            },
            title: {
                text: 'Average Speed'
            },
            pane: {
                startAngle: -150,
                endAngle: 150,
                background: [{
                        backgroundColor: {
                            linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
                            stops: [
                                [0, '#FFF'],
                                [1, '#333']
                            ]
                        },
                        borderWidth: 0,
                        outerRadius: '109%'
                    }, {
                        backgroundColor: {
                            linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
                            stops: [
                                [0, '#333'],
                                [1, '#FFF']
                            ]
                        },
                        borderWidth: 1,
                        outerRadius: '107%'
                    }, {
                        // default background
                    }, {
                        backgroundColor: '#DDD',
                        borderWidth: 0,
                        outerRadius: '105%',
                        innerRadius: '103%'
                    }]
            },
            // the value axis
            yAxis: {
                min: 0,
                max: 200,
                minorTickInterval: 'auto',
                minorTickWidth: 1,
                minorTickLength: 10,
                minorTickPosition: 'inside',
                minorTickColor: '#666',
                tickPixelInterval: 30,
                tickWidth: 2,
                tickPosition: 'inside',
                tickLength: 10,
                tickColor: '#666',
                labels: {
                    step: 2,
                    rotation: 'auto'
                },
                title: {
                    text: 'km/h'
                },
                plotBands: [{
                        from: 0,
                        to: 120,
                        color: '#55BF3B' // green
                    }, {
                        from: 120,
                        to: 160,
                        color: '#DDDF0D' // yellow
                    }, {
                        from: 160,
                        to: 200,
                        color: '#DF5353' // red
                    }]
            },
            series: [{
                    name: 'Speed',
                    data: [80],
                    tooltip: {
                        valueSuffix: ' km/h'
                    }
                }]

        },
        // Add some life
        function(chart) {
            if (!chart.renderer.forExport) {
                setInterval(function() {
                    var point = chart.series[0].points[0],
                            newVal,
                            inc = Math.round((Math.random() - 0.5) * 20);

                    newVal = point.y + inc;
                    if (newVal < 0 || newVal > 200) {
                        newVal = point.y - inc;
                    }

                    point.update(newVal);

                }, 3000);
            }
        });

        var gaugeOptions = {
            chart: {
                type: 'solidgauge'
            },
            title: null,
            pane: {
                center: ['50%', '85%'],
                size: '80%',
                startAngle: -90,
                endAngle: 90,
                background: {
                    backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
                    innerRadius: '60%',
                    outerRadius: '100%',
                    shape: 'arc'
                }
            },
            tooltip: {
                enabled: false
            },
            // the value axis
            yAxis: {
                stops: [
                    [0.3, '#DF5353'], // green
                    [0.5, '#DDDF0D'], // yellow
                    [0.9, '#55BF3B'] // red
                ],
                lineWidth: 0,
                minorTickInterval: null,
                tickPixelInterval: 400,
                tickWidth: 0,
                title: {
                    y: -70
                },
                labels: {
                    y: 16
                }
            },
            plotOptions: {
                solidgauge: {
                    dataLabels: {
                        y: -30,
                        borderWidth: 0,
                        useHTML: true
                    }
                }
            }
        };

        $('#ontime_chart').highcharts(Highcharts.merge(gaugeOptions, {
            chart: {
                plotBackgroundColor: "#ededed",
                backgroundColor: "#ededed",
                plotBorderWidth: null,
                plotShadow: false,
            },
            yAxis: {
                min: 0,
                max: 100,
                title: {
                    text: 'Ontime Delivery'
                }
            },
            credits: {
                enabled: false
            },
            series: [{
                    name: '',
                    data: [80],
                    dataLabels: {
                        format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                                ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
                                '<span style="font-size:12px;color:silver"> % Ontime</span></div>'
                    },
                    tooltip: {
                        valueSuffix: ' % Ontime'
                    }
                }]

        }));
        
    });
</script>
