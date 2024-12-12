<script>
(function() {
    let cardColor, headingColor, axisColor, shadeColor, borderColor;

    cardColor = config.colors.white;
    headingColor = config.colors.headingColor;
    axisColor = config.colors.axisColor;
    borderColor = config.colors.borderColor;

    // Income Chart - Area chart
    // --------------------------------------------------------------------
    const incomeChartEl = document.querySelector('#incomeChart'),
        incomeChartConfig = {
            series: [{
                data: [
                    <?php 
                        for ($i = 1; $i <= 12; $i++) {
                            $__total__ = $__db->queryid(" SELECT COUNT( Id_Rpl_Pendaftaran ) AS Total FROM Tbl_Rpl_Pendaftaran WHERE MONTH(TglDaftar_Rpl_Pendaftaran) = '". $i ."' ");
                            echo $__total__->Total . ',';
                        }
                    ?>
                ]
            }],
            chart: {
                height: 215,
                parentHeightOffset: 0,
                parentWidthOffset: 0,
                toolbar: {
                    show: false
                },
                type: 'area'
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 2,
                curve: 'smooth'
            },
            legend: {
                show: false
            },
            markers: {
                size: 6,
                colors: 'transparent',
                strokeColors: 'transparent',
                strokeWidth: 4,
                discrete: [{
                    fillColor: config.colors.white,
                    seriesIndex: 0,
                    dataPointIndex: 7,
                    strokeColor: config.colors.primary,
                    strokeWidth: 2,
                    size: 6,
                    radius: 8
                }],
                hover: {
                    size: 7
                }
            },
            colors: [config.colors.primary],
            fill: {
                type: 'gradient',
                gradient: {
                    shade: shadeColor,
                    shadeIntensity: 0.6,
                    opacityFrom: 0.5,
                    opacityTo: 0.25,
                    stops: [0, 95, 100]
                }
            },
            grid: {
                borderColor: borderColor,
                strokeDashArray: 3,
                padding: {
                    top: -20,
                    bottom: -8,
                    left: -10,
                    right: 8
                }
            },
            xaxis: {
                categories: [
                    <?php 
                        $months = [];
                        for ($i = 1; $i <= 12; $i++) {
                            $months[] = '"' . date('M', mktime(0, 0, 0, $i, 1)) . '"';
                        }
                        echo implode(', ', $months);
                    ?>,
                ],
                axisBorder: {
                    show: true
                },
                axisTicks: {
                    show: true
                },
                labels: {
                    show: true,
                    style: {
                        fontSize: '16px',
                        colors: axisColor
                    }
                }
            },
            yaxis: {
                labels: {
                    show: true
                },
                min: 10,
                max: 50,
                tickAmount: 4
            }
        };
    if (typeof incomeChartEl !== undefined && incomeChartEl !== null) {
        const incomeChart = new ApexCharts(incomeChartEl, incomeChartConfig);
        incomeChart.render();
    }
})();
</script>