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
					<h6>Último Año</h6>
					<h2 class="fw-bolder mb-1"><span id="totalContratos">0</span> Contratos</h2>
					<div id="contratosMes"></div>
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
                                        <th>Monto (COP)</th>
                                        <th>Monto (USD)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ultimosContratos as $contrato)
                                    <tr class="text-center">
                                        <td>{{$contrato->id}}</td>
                                        <td>{{$contrato->getUser->fullname}}</td>
                                        <td>{{$contrato->getUser->email}}</td>
                                        <td>{{number_format($contrato->invertido, 2)}} </td>
                                        <td>$ {{number_format($contrato->usd, 2)}} </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-end">
        <div class="col-6">
            <div class="card card-tiny-line-stats">
                <div class="card-body pb-50">
                    <h2>Establecer firma:</h2>
                    <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modalFirma">Agregar</button>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card card-tiny-line-stats">
                <div class="card-body pb-50">
                    <h6>Total Capital</h6>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <h2 class="fw-bolder mb-1">COP: <span id="totalCapital">0</span></h2>
                        </div>
                        <div class="col-12 col-lg-6">
                            <h2 class="fw-bolder mb-1">USD: <span id="totalCapitalUSD">0</span></h2>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    

    <!-- Modal -->
    <div class="modal fade" id="modalFirma" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agrega tu firma digital</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('agregarFirma')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="file" accept="image/png, image/jpeg" name="firma" class="form-control">
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</section>
<!-- Dashboard Analytics end -->

<script>
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    document.addEventListener('DOMContentLoaded', function () {
		let monthNames = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
        let contratosMeses = document.querySelector('#contratosMes');
        let totalContratos = document.querySelector('#totalContratos');
        let montosMeses = document.querySelector('#montosMes');
        let totalCapital = document.querySelector('#totalCapital');
        let totalCapitalUSD = document.querySelector('#totalCapitalUSD');
        
        contratosMesOptions = {
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
                    name: 'Número de contratos',
                    data: [0, 0, 0, 0, 0, 0, 0 , 0, 0, 0, 0, 0]
                    }],
            markers: {
                size: 2,
                colors: window.colors.solid.info,
                strokeColors: window.colors.solid.info,
                strokeWidth: 2,
                strokeOpacity: 1,
                strokeDashArray: 0,
                fillOpacity: 1,
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
                y: {
                    formatter: function (val) {
                        return val.toFixed(0)
                    }
                }
            }
        };
        contratosMes = new ApexCharts(contratosMeses, contratosMesOptions);
        contratosMes.render();

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
                    name: 'Lineal',
                    data: [0, 0, 0, 0, 0, 0, 0 , 0, 0, 0, 0, 0]
                    },{
                    name: 'Compuesto',
                    data: [0, 0, 0, 0, 0, 0, 0 , 0, 0, 0, 0, 0]
                    }],
            markers: {
                size: 2,
                colors: window.colors.solid.info,
                strokeColors: window.colors.solid.info,
                strokeWidth: 2,
                strokeOpacity: 1,
                strokeDashArray: 0,
                fillOpacity: 1,
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
                y: {
                    formatter: function (val) {
                        return "$ " + val.toFixed(2)
                    }
                }
            }
        };
        montosMes = new ApexCharts(montosMeses, montosMesOptions);
        montosMes.render();

        ejecutarConsulta();
        

    })

    function ejecutarConsulta(){
            fetch(`{{route("grafico.dashboard")}}`, {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": token
                },
                method: 'get',
            })
            .then(response => response.text())
            .then(resultText => (
                data = JSON.parse(resultText),
                totalContratos.innerHTML = data.countContratos,
                totalCapital.innerHTML = data.invertidoTotal.toFixed(2),
                totalCapitalUSD.innerHTML = data.invertidoTotalUSD.toFixed(2),
                
                montosMes.updateOptions({
                    series: [{
                            data: data.linealMeses
                        },
                        {
                            data: data.compuestoMeses
                        }
                    ],
                }),
                contratosMes.updateOptions({
                    series: [{
                            data: data.countContratosMeses
                        },
                    ],
                })
            ))
            .catch(function (error) {
                console.log(error);
            });
        }

        

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
<script>
    //datataables ordenes
    $('.myTable').DataTable({
        responsive: true,
        order: [
            [0, "desc"]
        ],
    })
</script>
@endsection
