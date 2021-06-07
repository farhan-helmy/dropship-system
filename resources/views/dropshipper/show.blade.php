@extends('master')

@section('content')
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Profile 4-->
        <div class="d-flex flex-row">
            <!--begin::Aside-->
            <div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <!--begin::Body-->
                    <div class="card-body pt-4">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end">
                            <div class="dropdown dropdown-inline">
                                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ki ki-bold-more-hor"></i>
                                </a>

                            </div>
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::User-->
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                                <div class="symbol-label" style="background-image:url('assets/media/users/300_13.jpg')">
                                </div>
                                <i class="symbol-badge bg-success"></i>
                            </div>
                            <div>
                                <a href="#"
                                    class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">{{$user->name}}</a>

                                <div class="mt-2">
                                    <span
                                        class="label label-lg label-light-success label-inline font-weight-bold py-4">{{$user->status}}</span>
                                </div>
                            </div>
                        </div>
                        <!--end::User-->
                        <!--begin::Contact-->
                        <div class="pt-8 pb-6">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">Email:</span>
                                <a href="#" class="text-muted text-hover-primary">{{$user->email}}</a>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">Phone:</span>
                                <span class="text-muted">{{$user->phone_no}}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">Location:</span>
                                <span class="text-muted">Malaysia</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="font-weight-bold mr-2">Nric:</span>
                                <span class="text-muted">{{$user->nric}}</span>
                            </div>
                        </div>
                        <!--end::Contact-->
                        @if($user->status == 'Active')
                        <a href="{{route('admin.dropshipper.deactivate', ['user' => $user->id])}}"
                            class="btn btn-light-danger font-weight-bold py-3 px-6 mb-2 text-center btn-block">Deactivate</a>
                        @else
                        <a href="{{route('admin.dropshipper.activate', ['user' => $user->id])}}"
                            class="btn btn-light-success font-weight-bold py-3 px-6 mb-2 text-center btn-block">Activate</a>
                        @endif
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
                <div class="card card-custom bg-radial-gradient-primary gutter-b">
                    <!--begin::Header-->
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title font-weight-bolder text-white">Sales Progress</h3>
                        <div class="card-toolbar">
                            <div class="dropdown dropdown-inline">
                                <a href="#" class="btn btn-text-white btn-hover-white btn-sm btn-icon border-0"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ki ki-bold-more-hor"></i>
                                </a>

                            </div>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column p-0">
                        <!--begin::Chart-->
                        <div id="kt_mixed_widget_5_chart" style="height: 200px"></div>
                        <!--end::Chart-->
                        <!--begin::Stats-->
                        <div class="card-spacer bg-white card-rounded flex-grow-1">
                            <!--begin::Row-->
                            <div class="row m-0">
                                <div class="col px-8 py-6 mr-8">
                                    <div class="font-size-sm text-muted font-weight-bold">Average Sale</div>
                                    <div class="font-size-h4 font-weight-bolder">TBD</div>
                                </div>
                                <div class="col px-8 py-6">
                                    <div class="font-size-sm text-muted font-weight-bold">Commission</div>
                                    <div class="font-size-h4 font-weight-bolder">TBD</div>
                                </div>
                            </div>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <div class="row m-0">
                                <div class="col px-8 py-6 mr-8">
                                    <div class="font-size-sm text-muted font-weight-bold">Annual Taxes</div>
                                    <div class="font-size-h4 font-weight-bolder">TBD</div>
                                </div>
                                <div class="col px-8 py-6">
                                    <div class="font-size-sm text-muted font-weight-bold">Annual Income</div>
                                    <div class="font-size-h4 font-weight-bolder">TBD</div>
                                </div>
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Body-->
                </div>
            </div>
            <!--end::Aside-->
            <!--begin::Content-->
            <div class="flex-row-fluid ml-lg-8">
                <div class="card card-custom gutter-b">
                    <!--begin::Header-->
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">Orders</span>

                        </h3>

                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-0 pb-3">
                       
                        {!! $ordertable->table() !!}
                       
                    </div>
                    <!--end::Body-->
                </div>
            </div>
            <!--end::Content-->
        </div>
        <!--end::Profile 4-->
    </div>
    <!--end::Container-->
</div>
@endsection

@push('scripts')
{!! $ordertable->scripts() !!}
<script>
    var _initChartsWidget5 = function () {
        var element = document.getElementById("kt_charts_widget_5_chart");

        if (!element) {
            return;
        }

        var options = {
            series: [{
                name: 'Net Profit',
                data: [40, 50, 65, 70, 50, 30]
            }, {
                name: 'Revenue',
                data: [-30, -40, -55, -60, -40, -20]
            }],
            chart: {
                type: 'bar',
                stacked: true,
                height: 350,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: ['12%'],
                    endingShape: 'rounded'
                },
            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                }
            },
            yaxis: {
                min: -80,
                max: 80,
                labels: {
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                }
            },
            fill: {
                opacity: 1
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
                    fontSize: '12px',
                    fontFamily: KTApp.getSettings()['font-family']
                },
                y: {
                    formatter: function (val) {
                        return "$" + val + " thousands"
                    }
                }
            },
            colors: [KTApp.getSettings()['colors']['theme']['base']['info'], KTApp.getSettings()['colors'][
                'theme'
            ]['base']['primary']],
            grid: {
                borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();
    }

</script>
@endpush
