
@extends('layouts/contentLayoutMaster')

@section('title', 'Verificación de Contratos')

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

<!-- Basic table -->
<section id="basic-datatable">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <table class="table" id="myTable">
          <thead>
            <tr>
              <th>id</th>
              <th>Nombre</th>
              <th>N° Documento</th>
              <th>Monto</th>
              <th>Correo</th>
              <th>Fecha</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($inversiones as $inversion)            
            <tr>
              <td>{{$inversion->id}}</td>
              <td>{{$inversion->getUser->fullname}}</td>
              <td>{{number_format($inversion->getUser->num_documento,0,",",".")}}</td>
              <td>{{number_format($inversion->invertido,2,",",".")}}</td>
              <td>{{$inversion->getUser->email}}</td>
              <td>{{$inversion->created_at->format('Y/m/d')}}</td>
              <td>
                <div class="dropdown">
                  <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      <i data-feather='more-vertical'></i>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li>
                      <a class="dropdown-item" target="_blank" href="{{route('inversion.generatePdf', ['id' => $inversion->id])}}">
                        <i class="fa fa-file-pdf"></i> Ver contrato
                      </a>                     
                    </li>                      
                    <li><a class="dropdown-item" href="javascript:void(0)"  onclick="verificacion({{$inversion->id}})"
                      ><i data-feather='check-circle'></i> Verificacion</a></li>
                  </ul>
                </div>
              </td>
            </tr>

            <div 
            class="modal fade modal-secondary text-start" 
            id="modalVerificacion" 
            tabindex="-1" 
            aria-labelledby="myModalLabel1660"
            aria-hidden="true"
            >
            <div class="modal-dialog modal-dialog-c entered">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1660">Subir archivo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('edit-inversor', ['id' => $inversion->id])}}">
                        <input type="hidden" id="idVerificacion" name="id">
                    <div class="modal-body">
                        {{-- src="{{ asset('storage/10/comprobantes/1632585581avatar.jpg' ) }}" --}}
                        <img id="imagen_url" style="width: 100%;" src=""
                            alt="consignacion">
                        <a class="d-block text-center" id="url_comprobante" target="_blank"></a>
                    </div>
                    <div class="modal-footer">
                        {{-- <a href="{{ route('rechazar-inversor',2) }}" type="button" class="btn btn-danger">Rechazar</a> --}}
                        <a href="#" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</a>
                        <button type="submit" class="btn" style="color:white; background-color: #00c2ef;">Aprobar</button>
                    </div>
                    </form>
                </div>
            </div>
           </div>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Modal to add new record -->

@include('inversores.component.modalContrato')
</section>
<!--/ Basic table -->



@endsection


@section('vendor-script')
  <script>
        // Para mostrar la imagen
        function verificacion(id){
          var URLactual = location.href;          
          var url = URLactual.replace('inversiones/inversores', "");

          $.ajax({
            url: 'getImage'+'/'+id,
                type: 'GET',
                success: function (json) {

                  if(json.url_imagen.indexOf('.pdf') > -1){
                    $('#imagen_url').addClass("d-none");
                    $('#url_comprobante').removeClass("d-none");
                    $('#modalVerificacion').modal('toggle')
                    $('#url_comprobante').attr("href", url+'storage/'+json.url_imagen);
                    $('#url_comprobante').text(json.url_imagen);
                    $('#idVerificacion').attr("value", id)
                  }else{
                    $('#imagen_url').removeClass("d-none");
                    $('#url_comprobante').addClass("d-none");
                    $('#modalVerificacion').modal('toggle')
                    $('#imagen_url').attr("src", url+'storage/'+json.url_imagen);
                    $('#idVerificacion').attr("value", id)
                  }
                  
                }
            });
        }
        
        // Para ver los detalles del contrato
        function verContrato(id){
          var URLactual = location.href;          
          var url = URLactual.replace('inversiones/inversores', "");

          $.ajax({
            url: 'ver-inversor'+'/'+id,
                type: 'GET',
                success: function (json) {
                  var obj = JSON.parse(json);
                  $('#modalContrato').modal('toggle')
                  $('#invertido').attr("value", obj.invertido)
                  $('#tipo_interes').attr("value", obj.tipo_interes)
                  $('#fecha_consignacion').attr("value", obj.fecha_consignacion)
                  $('#referente').attr("value", obj.referente)
                  let pm = obj.periodo_mes == 1 ? "Del 1 al 15": "Del 16 al 30 o (31)"
                  $('#periodo_mes').attr("value", pm)
                  $('#status').attr("value", obj.status)
                }
            });
        }

        function aprobar(){
          id = $('#idVerificacion').val()
          $.ajax({
            url: 'aprobar-inversor'+'/'+id,
                type: 'GET',
                success: function (json) {
                  Swal.fire({
                    icon: 'success',
                    title: 'El contrato ha sido Firmado exitosamente!',
                    confirmButtonColor: '#00c2ef'
                  })
                  location.reload(true);
                }
            });
        }
  </script>
  {{-- vendor files --}}
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.min.js')) }}"></script>
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