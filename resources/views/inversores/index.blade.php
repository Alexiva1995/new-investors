
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
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Modal to add new record -->


@include('inversores.component.modalVerificacion')
@include('inversores.component.modalContrato')
</>
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
    $('#myTable').DataTable({
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
    })
  </script>
@endpush