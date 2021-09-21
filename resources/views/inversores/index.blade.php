
@extends('layouts/contentLayoutMaster')

@section('title', 'Inversores')

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">

  <link rel="stylesheet" href="{{ asset(mix('vendors/css/file-uploaders/dropzone.min.css')) }}">
@endsection

@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-file-uploader.css')) }}">
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
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)            
            <tr>
              <td>{{$user->id}}</td>
              <td>{{$user->fullname}}</td>
              <td>{{$user->num_documento}}</td>
              <td></td>
              <td>{{$user->email}}</td>
              <td>{{$user->created_at->format('Y/m/d')}}</td>
              <td>
                <div class="dropdown">
                  <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      <i data-feather='more-vertical'></i>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#"><i data-feather='user'></i> Ver perfil</a></li>
                    <li><a class="dropdown-item" href="#"><i data-feather='arrow-left'></i> Reenviar contrato</a></li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                      data-bs-target="#modalAprobar"><i data-feather='check-circle'></i> Aprobar</a></li>
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
  <div
    class="modal fade modal-secondary text-start"
    id="modalAprobar"
    tabindex="-1"
    aria-labelledby="myModalLabel1660"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel1660">Subir archivo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
       
          <form action="{{route('dropZoneStore')}}" method="POST" enctype="multipart/form-data"  class="dropzone dropzone-area" id="dpz-single-file">
            <input type="hidden" name="user" value="{{$user->id}}">
            @csrf
            <div class="dz-message">Suelta los archivos aquí o haz clic para subir.</div>
          </form>
              
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Accept</button>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ Basic table -->



@endsection


@section('vendor-script')
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

  <script src="{{ asset(mix('vendors/js/file-uploaders/dropzone.min.js')) }}"></script>
@endsection
@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/tables/table-datatables-basic.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-file-uploader.js')) }}"></script>

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