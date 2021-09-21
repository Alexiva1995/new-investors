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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                            {{-- <p> <img src="{{ asset('assets/img/sistema/btn-plus.png') }}" alt=""></p> --}}
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
                                    @forelse ($inv as $item)
                                        <tr class="text-center">
                                            <td>{{ $item->getInversion->id }}</td>
                                            <td>{{ $item->getInversion->getUser->fullname }}</td>
                                            <td>{{ $item->getInversion->getUser->num_documento}}</td>
                                            <td>{{ $item->getInversion->getUser->email }}</td>
						                    <td>{{date('M-d-Y', strtotime($item->created_at))}}</td>                                            
											<td>{{ $item->id }}</td>
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
                                            <td colspan="4">Sin Contratos</td>
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

    <input type="hidden" id="contrato_id" name="contrato_id">
@endsection

@push('custom-scripts')
    {{-- <script>
    let myDropzone = new Dropzone("#dpz-single-file");
    myDropzone.on("addedfile", file => {
      console.log(`File added: ${file.name}`);
    });
  </script> --}}
  <script>

    let btnsRetirar = document.querySelectorAll('.retirar');
    
    btnsRetirar.forEach(function(btnRetirar) {
        if(btnRetirar != null){
            btnRetirar.addEventListener("click", function( event ) {
        
                let contratoId = event.target.attributes.contrato_id.value;                   
                //llamamos la alerta
                Swal.fire({
                title: '¿Estas seguro?',
                text: "Este contrato se dará como finalizado",
                icon: 'warning',
                showCancelButton: true,
                // inputValidator: (value) => { 

                //     if (parseInt(value, 10) > parseInt(capital,10)) {
                //     return 'El monto maximo que se puede retirar es de: '+capital
                //     }
                //     if(!value){
                //         return 'Debe ingresar un monto';
                //     }            
                    
                // },
                confirmButtonColor: '#00bb2d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Finalizar',
                preConfirm: (login) => {
                    let data= {'contratoId': contratoId, 'amount': login};
                    console.log(data)
                    return fetch(`{{route("contratos.finalizar")}}`, {
                    method: 'POST', // or 'PUT'
                    body: JSON.stringify(data), // data can be `string` or {object}!
                    headers:{
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    })   
                    .then(response => {
                        
                        if (!response.ok) {
                        throw new Error(response.statusText)
                        }
                        
                        return response.json()
                    })
                    .catch(error => {
                        Swal.showValidationMessage(
                        `Request failed: ${error}`
                        )
                    })
                },
                allowOutsideClick: () => !Swal.isLoading()
                })
                .then((result) => {
    
                if (result.isConfirmed) {
                    Swal.fire(
                    'Finalizado',
                    'Contrato finalizado con exito.',
                    'success'
                    )
                    location.reload(true);
                }
                })
            }, false)
        }
    });
</script>
@endpush
