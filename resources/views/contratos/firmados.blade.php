@extends('layouts/contentLayoutMaster')


@section('title', 'Firmados')

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css'))}}">

@endsection

@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-file-uploader.css')) }}">
  <link rel="stylesheet" href="{{asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css'))}}">

@endsection

@section('content')
<!-- Basic Tables start -->
<div id="record">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body card-dashboard">
            
                    <div class="table-responsive">
                        <table class="table myTable" id="myTable">

                          <thead class="">
                            <tr class=" text-center text-dark
                                bg-purple-alt2">
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Nº Documento</th>
                                <th>Correo</th>
                                <th>Fecha</th>
                                <th>Monto (COP)</th>
                                <th>Monto (USD)</th>
                                <th>Num. cuenta</th>
                                <th>entidad bancaria</th>
                                <th>Fecha consignacion</th>
                                <th>Acción</th>
                              </tr>
                          </thead>

                          <tbody>
                              @forelse ($inv as $item)
                                  <tr class="text-center">
                                      <td>{{ $item->id }}</td>
                                      <td>{{ $item->getUser->fullname }}</td>
                                      <td>{{ $item->getUser->num_documento}}</td>
                                      <td>{{ $item->getUser->email }}</td>
                                      <td>{{date('M-d-Y', strtotime($item->created_at))}}</td>                                            
                                      <td>{{number_format($item->invertido,2,",",".")}}</td>
                                      <td>$ {{number_format($item->usd,2,",",".")}}</td>
                                      <td>{{ $item->getUser->num_cuenta }}</td>
                                      <td>{{ $item->getUser->banco }}</td>
                                      <td>{{ $item->fecha_consignacion }}</td>
                                      <td>
                                          {{-- <a  class="btn text-bold-600 retirar"
                                              style="background-color: red; color:white;" 
                                              contrato_id="{{$item->id}}">
                                              <i class="fas fa-edit"></i>
                                          </a> --}}
                                          <button type="button" class="btn btn-danger retirar" contrato_id="{{$item->id}}">
                                              Finalizar
                                          </button>
                                      </td>
                                  </tr>
                              @empty
                                  <tr class="text-center">
                                      <td colspan="7">Sin Contratos</td>
                                    </tr>
                              @endforelse
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection

{{-- CONFIGURACIÓN DE DATATABLE --}}
{{-- @include('panels.datatables-config') --}}
@section('vendor-script')
 
  {{-- vendor files --}}
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  {{--
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.min.js')) }}"></script>--}}
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>

@endsection
@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/tables/table-datatables-basic.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/extensions/ext-component-sweet-alerts.js')) }}"></script>

@endsection

@push('custom-scripts')
{{--
  <script>
    let myDropzone = new Dropzone("#dpz-single-file");
    myDropzone.on("addedfile", file => {
      console.log(`File added: ${file.name}`);
    });
  </script>
--}}
  <script>
  
    $('#myTable').DataTable(  
    {
        //scrollX: true,
        processing: true,
        responsive: true,
        order: [[ 0, "desc" ]],
        searching: true,
        bLengthChange: true,
        pageLength: 10,
        language: {
            processing:     "Procesando...",
            search:         "",
            searchPlaceholder: "Buscar",
            info:           "",
            lengthMenu:     "Mostrar _MENU_ Utilidades",
            infoEmpty:      "Vacío",
            infoFiltered:   "Información refinada",
            infoPostFix:    "",
            loadingRecords: "Procesando...",
            zeroRecords:    "Vacio",
            emptyTable:     "Vacio",
            paginate: {
                first:      "Primero",
                previous:   "Anterior",
                next:       "Siguiente",
                last:       "Último"
            },
            aria: {
                sortAscending:  ": Ordenar ascendente",
                sortDescending: ": Ordenar descendente"
            }
        },
        dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle me-2',
          text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + 'Export',
          buttons: [
            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [0, 1, 2, 3, 4, 5] }
            }
          ],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
            }, 50);
          }
        }
      ]
    })
  </script>
@endpush

