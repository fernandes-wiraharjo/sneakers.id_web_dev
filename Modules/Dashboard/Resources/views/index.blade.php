<x-base-layout>
    <x-slot name="styles">
        {{-- <link rel="stylesheet" href="{{ mix('css/custom.css') }}"> --}}
    </x-slot>
    <x-slot name="title">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Dashboard   Summary</h1>
    </x-slot>
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body pt-6">
             <!--begin::Row-->
             <div class="row gy-5 g-xl-8">
                <!--begin::Col-->
                <div class="col-xxl-6">
                    {{ theme()->getView('dashboard::partials._panel-1', $panel_1) }}
                </div>
                <div class="col-xxl-6">
                    {{ theme()->getView('dashboard::partials._panel-2', $panel_2) }}
                </div>
             </div>
             <div class="row gy-5 g-xl-8">
                {{ theme()->getView('dashboard::partials._panel-3', $panel_3) }}
             </div>
            <!--begin::Row-->
            <div class="row gy-5 g-xl-8">
                <!--begin::Col-->
                {{-- <div class="col-xxl-4">
                    {{ theme()->getView('dashboard::partials._panel-4', array('class' => 'card-xxl-stretch')) }}
                </div> --}}
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xxl-6">
                    {{ theme()->getView('dashboard::partials._panel-5', $panel_5) }}
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xxl-6">
                    {{ theme()->getView('dashboard::partials._panel-6', array('class' => 'card-xxl-stretch-50 mb-5 mb-xl-8', 'chartColor' => 'primary', 'chartHeight' => '150px')) }}

                    {{ theme()->getView('dashboard::partials._panel-7', array('class' => 'card-xxl-stretch-50 mb-5 mb-xl-8', 'chartColor' => 'primary', 'chartHeight' => '175px')) }}
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Card body-->
        <div class="row gy-5 g-xl-8">
            <!--begin::Col-->
            <div class="col-xxl-6">
                {{ theme()->getView('dashboard::partials._panel-8', array('class' => 'card-xxl-stretch')) }}
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xxl-6">
                {{ theme()->getView('dashboard::partials._panel-9', array('class' => 'card-xxl-stretch', 'chartColor' => 'danger', 'chartHeight' => '200px')) }}
            </div>
            <!--end::Col-->
        </div>
    </div>
    <!--end::Card-->
    @push('scripts')
        <script>
            var KTWidgets = function () {
                var initChartsWidget3 = function () {
                    var element = document.getElementById("sales_by_month");
                    var monthNames = @json($panel_5['month']);
                    var monthValues = @json($panel_5['values']);
                    var height = parseInt(KTUtil.css(element, 'height'));
                    var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
                    var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
                    var baseColor = KTUtil.getCssVariableValue('--bs-info');
                    var lightColor = KTUtil.getCssVariableValue('--bs-light-info');

                    if (!element) {
                        return;
                    }

                    var options = {
                        series: [{
                            name: 'Net Profit',
                            data: monthValues
                        }],
                        chart: {
                            fontFamily: 'inherit',
                            type: 'area',
                            height: 350,
                            toolbar: {
                                show: false
                            }
                        },
                        plotOptions: {},
                        legend: {
                            show: false
                        },
                        dataLabels: {
                            enabled: false
                        },
                        fill: {
                            type: 'solid',
                            opacity: 1
                        },
                        stroke: {
                            curve: 'smooth',
                            show: true,
                            width: 3,
                            colors: [baseColor]
                        },
                        xaxis: {
                            categories: monthNames,
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false
                            },
                            labels: {
                                style: {
                                    colors: labelColor,
                                    fontSize: '12px'
                                }
                            },
                            crosshairs: {
                                position: 'front',
                                stroke: {
                                    color: baseColor,
                                    width: 1,
                                    dashArray: 3
                                }
                            },
                            tooltip: {
                                enabled: true,
                                formatter: undefined,
                                offsetY: 0,
                                style: {
                                    fontSize: '12px'
                                }
                            }
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    colors: labelColor,
                                    fontSize: '12px'
                                },
                                formatter: function (value) {
                                    return formatCurrency(value);
                                }
                            }
                        },
                        states: {
                            normal: {
                                filter: {
                                    type: 'none',
                                    value: 0
                                }
                            },
                            hover: {
                                filter: {
                                    type: 'none',
                                    value: 0
                                }
                            },
                            active: {
                                allowMultipleDataPointsSelection: false,
                                filter: {
                                    type: 'none',
                                    value: 0
                                }
                            }
                        },
                        tooltip: {
                            style: {
                                fontSize: '12px'
                            },
                            y: {
                                formatter: function (val) {
                                    return "Rp " + formatCurrency(val) ;
                                }
                            }
                        },
                        colors: [lightColor],
                        grid: {
                            borderColor: borderColor,
                            strokeDashArray: 4,
                            yaxis: {
                                lines: {
                                    show: true
                                }
                            }
                        },
                        markers: {
                            strokeColor: baseColor,
                            strokeWidth: 3
                        }
                    };

                    var chart = new ApexCharts(element, options);
                    chart.render();
                }

                return {
                    init: function () {
                        initChartsWidget3();
                    }
                }
            }();

            function formatCurrency(value) {
                if (value >= 1000000000) {
                    return (value / 1000000000).toFixed(1) + ' m';
                } else if (value >= 1000000) {
                    return (value / 1000000).toFixed(1) + ' jt';
                } else if (value >= 1000) {
                    return (value / 1000).toFixed(1) + ' rb';
                } else {
                    return value;
                }
            }

            // Webpack support
            if (typeof module !== 'undefined') {
                module.exports = KTWidgets;
            }

            // On document ready
            KTUtil.onDOMContentLoaded(function () {
                KTWidgets.init();
            });

        </script>
    @endpush
</x-base-layout>
