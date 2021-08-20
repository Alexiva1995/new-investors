
@extends('layouts/contentLayoutMaster')

@section('title', 'Lista de contratos')

@section('content')
<!-- Basic Tables start -->
<div class="row" id="basic-table">
  <div class="col-12">
    <div class="card">
    {{--
      <div class="card-header">
        <h4 class="card-title">Table Basic</h4>
      </div>
      --}}
      <div class="card-body">
        
        @if(Auth::user()->admin == 1)
          <form method="get" action="{{route('contratos.index')}}">
              <div class="row">
                  <div class="col mb-1">
                      <label class="form-label" for="tipo_documento">Tipo Documento<span style="color: red;">*</span></label>
                      <select class="form-select" id="tipo_documento" required name="tipo_documento">
                          <option value="">Elegir</option>
                          <option value="cedula_ciudadana">Cédula de ciudadania</option>
                          <option value="cedula_extranjera">Cédula de Extranjeria</option>
                          <option value="pasaporte">Pasaporte</option>
                      </select>
                      <div class="valid-feedback">valido!</div>
                      <div class="invalid-feedback">Por favor ingrese el tipo de documento</div>
                  </div>

                  <div class="col mb-1">
                      <label class="form-label" for="num_documento">Numero de Documento <span style="color: red;">*</span></label>
      
                      <input
                      type="number"
                      id="num_documento"
                      name="num_documento"
                      class="form-control"
                      placeholder="Documento de indentidad"
                      aria-label="Documento de indentidad"
                      aria-describedby="numero del documento de identidad"
                      required
                      />
                      <div class="valid-feedback">valido!</div>
                      <div class="invalid-feedback">Por favor ingresa tu Numero de Documento de Identidad.</div>
                  </div>

                  <div class="col mb-1">
                      <label class="form-label" > </label>
                      <div class="d-grid gap-2">
                          <button class="btn btn-primary" type="submit">Buscar</button>
                      </div>
                    
                  </div>
              </div>
          </form>
        @endif
      
        <div class="table-responsive" style="height: 63vh;">
          <table class="table">
            <thead>
              <tr>
                <th>Id</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Archivo</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($inversiones as $inversion)
                  <tr>
                    <td>{{$inversion->id}}</td>
                    <td>{{$inversion->getUser->tipo_documento}}</td>
                    <td>
                      @if($inversion->contrato == null || $inversion->contrato->status == "por_firmar")
                        <span class="badge rounded-pill badge-light-danger me-1">Por firmar</span>
                      @elseif($inversion->contrato->status == "firma_cliente")
                        <span class="badge rounded-pill badge-light-warning me-1">Espera</span>
                      @elseif($inversion->contrato->status == "firmado")
                      <span class="badge rounded-pill badge-light-success me-1">Firmado</span>
                      @endif
                      
                    </td>
                    <td>
                      <div class="dropdown">
                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i data-feather="more-vertical"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="{{route('contratos.download_pdf', ['id' => $inversion->id])}}">
                            <i data-feather="download" class="me-50"></i>
                            <span>Descargar</span>
                          </a>
                          <a class="dropdown-item subir" inversion="{{$inversion->id}}">
                              <i data-feather="upload" class="me-50"></i>
                              <span>Subir</span>
                          </a>
                          {{--
                          <a class="dropdown-item" href="#">
                            <i data-feather="upload" class="me-50"></i>
                            <span>Subir</span>
                          </a>
                          --}}
                          </form>
                        </div>
                      </div>
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

  <!-- Vertical modal -->
    <!-- Modal -->
    <div
      class="modal fade"
      id="modal"
      tabindex="-1"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Vertically Centered</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div id="signature-pad" class="signature-pad" style="margin: 0px auto;">
              <div class="signature-pad--body">
                <p>Colocar tu firma aqui</p>
                <canvas style="border: 1px solid #000; width: 100%;"></canvas>
                <form method="POST" id="formContrato">
                @csrf
                  <input type="hidden" id="imagen64" name="imagen64">
                  <input type="hidden" id="inversion_id" name="inversion_id">
                </form>
              </div>
              <div class="signature-pad--footer">
                <div class="text-center">Accion</div>
                <div class="text-center">
                    <button type="button" class="button clear btn btn-info btn-round" data-action="clear" id="limpiar">Limpiar</button>
                    <button type="button" class="button btn btn-info btn-round" data-action="undo" id="btnGuardar">Firmar</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>

    
@endsection

@push('custom-scripts')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">

  var modal = document.getElementById('modal')

  $('.subir').click(function(){
  
    $('#inversion_id').val($('.subir').attr('inversion'));
    var myModal = new bootstrap.Modal(modal);

    myModal.show();

  });

  modal.addEventListener('shown.bs.modal', function (event) {
    
    var wrapper = document.getElementById("signature-pad");
  
    var canvas = wrapper.querySelector("canvas");
    var signaturePad = new SignaturePad(canvas, {
      backgroundColor: 'rgb(255, 255, 255)'
    });
    
    function resizeCanvas() {
    
      var ratio =  Math.max(window.devicePixelRatio || 1, 1);
    
      canvas.width = canvas.offsetWidth * ratio;
      canvas.height = canvas.offsetHeight * ratio;
      canvas.getContext("2d").scale(ratio, ratio);
    
      signaturePad.clear();
    }
    
    window.onresize = resizeCanvas;
    resizeCanvas();

    $('#limpiar').click(function(){
      signaturePad.clear();
    })

    $('#btnGuardar').click(function(){
  
      event.preventDefault();
      if (signaturePad.isEmpty()) {
          const swalWithBootstrapButtons = Swal.mixin({
              customClass: {
                  confirmButton: 'btn btn-danger'
              },
              buttonsStyling: false
          });
          swalWithBootstrapButtons.fire({
              title: "Debe realizar la firma!"
          });
      } else {
          document.getElementById('imagen64').value = signaturePad.toDataURL();
         //$("#loading").modal('show');
          var datos = $('#formContrato').serialize();
          $.ajax({
              method: "GET",
              url: "{{route('contratos.firmar')}}",
              data: datos
          }).done(function( response ) {
          //$("#loading").modal('hide');
          
          if(response.success== true) {
              const swalWithBootstrapButtons = Swal.mixin({
                  customClass: {
                      confirmButton: 'btn btn-success'
                  },
                  buttonsStyling: false
              })
              swalWithBootstrapButtons.fire({
                  title: "Contrato creado exitosamente.",
                  text: "Un asesor se encargará de validar la firma del contrato y pronto se habilitará el botón de Pago para que empieces a disfrutar los beneficios.",
                  icon: "success",
                  backdrop:true,
                  allowOutsideClick: false
              }).then(function(e) {
                  location.href = "{{ route('contratos.index') }}";
              });
          } else {
              const swalWithBootstrapButtons = Swal.mixin({
                  customClass: {
                      confirmButton: 'btn btn-danger'
                  },
                  buttonsStyling: false
              })
              swalWithBootstrapButtons.fire({
                  title: "Opss! Algo no salio bien",
                  text: "El contrato no se creó!",
                  icon: "warning"
                  });
              }
          });
      }
    });
  })
  
  
</script>

@endpush