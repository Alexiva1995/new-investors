@extends('layouts/contentLayoutMaster')

@section('title', 'Firmados')

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

@section('content')
    <!-- Basic Tables start -->
    <div id="record">
        <div class="col-12">
            <div class="card"> 
                <div class="card-content clas">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <p> <img src="{{ asset('assets/img/sistema/btn-plus.png') }}" alt=""></p>
                            <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped w-100">

                                <thead class="">
                                <tr class=" text-center text-dark
                                    bg-purple-alt2">
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Nº Documento</th>
                                    <th>Correo</th>
                                    <th>Fecha</th>
                                    <th>Contrato</th>
                                    <th>Acción</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($inv as $item)
                                        <tr class="text-center">
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->getUser->fullname }}</td>
                                            <td>{{ $item->getUser->num_documento}}</td>
                                            <td>{{ $item->getUser->email }}</td>
						                    <td>{{date('M-d-Y', strtotime($item->created_at))}}</td>                                            
											<td>{{ isset($item->contrato->id) ? $item->contrato->id : "SN"  }}</td>
                                            <td>
                                                <a class="btn text-bold-600"
                                                    style="background-color: rgba(0, 194, 239, 1)"><i
                                                        class="fas fa-edit"></i>
                                                </a>
                                            </td>
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

@endsection

@push('custom-scripts')
    {{-- <script>
    let myDropzone = new Dropzone("#dpz-single-file");
    myDropzone.on("addedfile", file => {
      console.log(`File added: ${file.name}`);
    });
  </script> --}}
@endpush
