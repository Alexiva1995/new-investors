@extends('layouts/contentLayoutMaster')

{{-- @section('title', 'Dashboard Analytics') --}}

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
@endsection
@section('page-style')
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-invoice-list.css')) }}">
@endsection

@section('content')
<!-- Dashboard Analytics Start -->
<section id="dashboard-analytics">

	<div class="row match-height justify-content-center">
		<!-- Line Chart - Profit -->
		<div class="col-6">
			<div class="card card-tiny-line-stats">
				<div class="card-body pb-50">
					<h6>Últimos 7 días</h6>
					<h2 class="fw-bolder mb-1">15 Contratos</h2>
					<div id="contratosSemana"></div>
				</div>
			</div>
		</div>
		<!--/ Line Chart - Profit -->
		<!-- Line Chart - Profit -->
		<div class="col-6">
			<div class="card card-tiny-line-stats">
				<div class="card-body pb-50">
					{{-- <h6>Ingresos por mes</h6> --}}
					<h2 class="fw-bolder mb-1">Ingresos por mes</h2>
					<div id="montosMes"></div>
				</div>
			</div>
		</div>
		<!--/ Line Chart - Profit -->
		{{-- <!-- Line Chart Starts -->
		<div class="col-6">
			<div class="card">
				<div
					class="card-header d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start">
					<h4 class="card-title mb-25">Ingresos por mes</h4>
				</div>
				<div class="card-body">
					<div id="montosMes"></div>
				</div>
			</div>
		</div>
		<!-- Line Chart Ends --> --}}
	</div>
    <div id="record">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="card-title">
                            <h3>Nuevos Contratos</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped">
                                <thead class="">
                                    <tr class="text-center text-dark bg-purple-alt2">
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td>1</td>
                                        <td>Eulin Palma</td>
                                        <td>eulinpalma@valdusoft.com</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Dashboard Analytics end -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
		let monthNames = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
        let contratosSemana = document.querySelector('#contratosSemana');
        let montosMes = document.querySelector('#montosMes');

        contratosSemanaOptions = {
            chart: {
                height: 100,
                type: 'line',
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                }
            },
            grid: {
                borderColor: '#00C2EF',
                strokeDashArray: 5,
                xaxis: {
                    lines: {
                        show: true
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                },
                padding: {
                    top: 0,
                    bottom: -10
                }
            },
            stroke: {
                width: 3
            },
            colors: [window.colors.solid.info],
            series: [{
				name: 'Contratos',
                data: [0, 3, 3, 2, 3, 2, 2]
            }],
            markers: {
                size: 2,
                colors: window.colors.solid.info,
                strokeColors: window.colors.solid.info,
                strokeWidth: 2,
                strokeOpacity: 1,
                strokeDashArray: 0,
                fillOpacity: 1,
                discrete: [{
                    seriesIndex: 0,
                    dataPointIndex: 5,
                    fillColor: '#ffffff',
                    strokeColor: window.colors.solid.info,
                    size: 5
                }],
                shape: 'circle',
                radius: 2,
                hover: {
                    size: 3
                }
            },
            xaxis: {
                labels: {
                    show: true,
                    style: {
                        fontSize: '0px'
                    }
                },
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            },
            yaxis: {
                show: false
            },
            tooltip: {
                x: {
                    show: false
                }
            }
        };
        contratosSemana = new ApexCharts(contratosSemana, contratosSemanaOptions);
        contratosSemana.render();

		montosMesOptions = {
            chart: {
                height: 100,
                type: 'line',
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                }
            },
            grid: {
                borderColor: '#00C2EF',
                strokeDashArray: 5,
                xaxis: {
                    lines: {
                        show: true
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                },
                padding: {
                    top: 0,
                    bottom: -10
                }
            },
            stroke: {
                width: 3
            },
            colors: [window.colors.solid.info],
            series: [{
				name: '$',
                data: [1000, 2000, 4000, 3400, 5400, 3600, 2300 ,1300, 2500, 5000, 7400, 8600]
            }],
            markers: {
                size: 2,
                colors: window.colors.solid.info,
                strokeColors: window.colors.solid.info,
                strokeWidth: 2,
                strokeOpacity: 1,
                strokeDashArray: 0,
                fillOpacity: 1,
                discrete: [{
                    seriesIndex: 0,
                    dataPointIndex: 5,
                    fillColor: '#ffffff',
                    strokeColor: window.colors.solid.info,
                    size: 5
                }],
                shape: 'circle',
                radius: 2,
                hover: {
                    size: 3
                }
            },
            xaxis: {
				categories: monthNames,
                labels: {
                    show: true,
                    style: {
                        fontSize: '0px'
                    }
                },
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            },
            yaxis: {
                show: false
            },
            tooltip: {
                x: {
                    show: false
                }
            }
        };
        montosMes = new ApexCharts(montosMes, montosMesOptions);
        montosMes.render();


    })

</script>
@endsection

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
@endsection
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/pages/dashboard-analytics.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/pages/app-invoice-list.js')) }}"></script>
@endsection
