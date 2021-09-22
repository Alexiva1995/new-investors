@extends('layouts/fullLayoutMaster')

@section('title', 'Nueva Inversión')

@section('vendor-style')
{{-- Vendor Css files --}}
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
@endsection

@section('content')

<!-- Validation -->

<div class="capa-exterior">
  <img class="margin" href="#" src="{{asset('images/svg/Frame.svg')}}" alt="">

  <div>
    <h3 class="capa-interior">the new investor</h3>
    <br>
    <p class="capa-exterior2">Te damos la bienvenida a nuestro sistema de inversión, agradecemos diligenciar el siguiente formulario para poder brindarte un mejor servicio y garantizar consignar tus rentabilidades mensuales directamente a tu cuenta bancaria.</p>
  </div>
</div>


<section class="bs-validation" style="background-color: #FFFFFF !important;">
  <div class="container row ">
    <form class="" method="POST" action="{{route('inversiones.store')}}" enctype="multipart/form-data">
      @csrf
      <div class="panel-body">
        <div class="tab-content ">
          <div class="tab-pane active " id="1">
            <div class="">
              <div class="container" style="background-color: #FFFFFF !important;">
                <div id="exTab2" class="container row">
                  <div class="panel panel-default row align-items-start mt-4 ">
                    <div class="col-3 ">
                      <a href="#" id="inf">1 Información Personal</a>
                      <div class="line-mf"></div>
                    </div>
                    <div class="col-3">
                      <a id="inft" href="#"> 2 Información Bancaria</a>
                      <div class="line-mft"></div>
                    </div>
                    <div class="col-4">
                      <a id="inft" href="#"> 3 Información de inversión</a>
                      <div class="line-mft"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row align-items-start mt-3">
                <div class="col-4">
                  <label class="form-label" for="fullname">Nombre Completo <span style="color: red;">*</span></label>
                  <input type="text" id="fullname" name="fullname" class=" form-control  {{ $errors->has('fullname') ? ' is-invalid' : '' }}" placeholder="Ingresa tu Nombre Completo" aria-label="nombre y apellido" aria-describedby="nombre completo de la persona" required />
                  <div class="valid-feedback">valido!</div>
                  <div class="invalid-feedback">Por favor ingresa tu nombre y apellido.</div>
                </div>


                <div class="col-4 mb-3">
                  <label class="form-label" for="tipo_documento">Tipo Documento de Identidad <span style="color: red;">*</span></label>
                  <select class="form-select {{ $errors->has('tipo_documento') ? ' is-invalid' : '' }}" id="tipo_documento" required name="tipo_documento">
                    <option value="">Seleccionar</option>
                    <option value="cedula_ciudadana">Cédula de ciudadania</option>
                    <option value="cedula_extranjera">Cédula de Extranjeria</option>
                    <option value="pasaporte">Pasaporte</option>
                  </select>
                  <div class="valid-feedback">valido!</div>
                  <div class="invalid-feedback">Por favor ingrese el tipo de documento</div>
                </div>


                <div class="col-4 mb-1">
                  <label class="form-label" for="num_documento"> Documento de Identidad <span style="color: red;">*</span></label>

                  <input type="text" id="num_documento" name="num_documento" class="form-control {{ $errors->has('num_documento') ? ' is-invalid' : '' }}" placeholder="Ingresa tu número de documento" aria-label="Documento de indentidad" aria-describedby="numero del documento de identidad" required />
                  <div class="valid-feedback">valido!</div>
                  <div class="invalid-feedback">Por favor ingresa tu Numero de Documento de Identidad.</div>
                </div>
              </div>

              <div class="row align-items-center">
                <div class="col mb-1">
                  <label class="form-label" for="ciudad_residencia">Ciudad de Residencia <span style="color: red;">*</span></label>

                  <input type="text" id="ciudad_residencia" name="ciudad_residencia" class="form-control {{ $errors->has('ciudad_residencia') ? ' is-invalid' : '' }}" placeholder="Ingresa tu Ciudad de Residencia" aria-label="Ciudad de Residencia" aria-describedby="ciudad de residencia" required />
                  <div class="valid-feedback">valido!</div>
                  <div class="invalid-feedback">Por favor ingresa tu Ciudad de Residencia.</div>
                </div>

                <div class="col mb-1">
                  <label class="form-label" for="direccion_residencia">Dirección de Residencia <span style="color: red;">*</span></label>

                  <input type="text" id="direccion_residencia" name="direccion_residencia" class="form-control {{ $errors->has('direccion_residencia') ? ' is-invalid' : '' }}" placeholder="Ingresa tu Dirección de Residencia " aria-label="Dirección de Residencia " aria-describedby="basic-addon-name" required />
                  <div class="valid-feedback">valido!</div>
                  <div class="invalid-feedback">Por favor ingresa tu Dirección de Residencia .</div>
                </div>

                <div class="col mb-1">
                  <label class="form-label input-phone" for="celular">Numero de Celular <span style="color: red;">*</span></label>

                  <input type="text" id="celular" name="celular" class="form-control {{ $errors->has('celular') ? ' is-invalid' : '' }}" placeholder="Ingresa tu Número de Celular" aria-label="Numero de Celular" aria-describedby="basic-addon-name" required />
                  <div class="valid-feedback">valido!</div>
                  <div class="invalid-feedback">Por favor ingresa tu Numero de Celular.</div>
                </div>
              </div>

              <div class="row align-items-end">
                <div class="col-4 mt-1">
                  <label class="form-label" for="email">Correo electrónico <span style="color: red;">*</span></label>
                  <input type="email" id="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Ingresa tu Correo Electrónico" aria-label="john.doe@email.com" required />
                  <div class="valid-feedback">valido!</div>
                  <div class="invalid-feedback">Por favor ingresa tu Correo electrónico.</div>
                </div>

              </div>

              <a class="btn  btn-primarys float-right text-white mb-5 mt-5" href="#2" data-toggle="tab">Siguiente</a>
            </div>
          </div>



          <div class="tab-pane  " id="2">
            <div class="container" style="background-color: #FFFFFF !important;">
              <div id="exTab2" class="container row">
                <div class="panel panel-default row align-items-start mt-4 ">
                  <div class="col-3 ">
                    <a href="#" id="inft">1 Información Personal</a>
                    <div class="line-mft"></div>
                  </div>
                  <div class="col-3">
                    <a id="inf" href="#"> 2 Información Bancaria</a>
                    <div class="line-mf"></div>
                  </div>
                  <div class="col-4">
                    <a id="inft" href="#"> 3 Información de inversión</a>
                    <div class="line-mft"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row align-items-start mt-4">
              <div class="col-4">
                <label class="form-label" for="banco">Banco<span style="color: red;">*</span> </label>
                <select class="form-select {{ $errors->has('banco') ? ' is-invalid' : '' }}" id="banco" required name="banco">
                  <option value="">Selecciona un Banco</option>
                  <option value="Bancolombia">Bancolombia</option>
                  <option value="NEQUI de Bancolombia">NEQUI de Bancolombia</option>
                  <option value="Banco Av Villas">Banco Av Villas</option>
                  <option value="Davivienda">Davivienda</option>
                  <option value="Banco de Bogotá">Banco de Bogotá</option>
                  <option value="Banco Popular">Banco Popular</option>
                  <option value="Banco de Occidente">Banco de Occidente</option>
                  <option value="Banco Colpatria">Banco Colpatria</option>
                  <option value="Banco BBVA">Banco BBVA</option>
                  <option value="Banco Caja social">Banco Caja social</option>
                  <option value="GNB Sudameris">GNB Sudameris</option>
                  <option value="Banco Agrario">Banco Agrario</option>
                </select>
                <div class="valid-feedback">valido!</div>
                <div class="invalid-feedback">Por favor ingrese el banco</div>
              </div>
              <div class="col-4">
                <label class="form-label" for="tipo_cuenta">Tipo de Cuenta <span style="color: red;">*</span></label>
                <select class="form-select {{ $errors->has('tipo_cuenta') ? ' is-invalid' : '' }}" id="tipo_cuenta" required name="tipo_cuenta">
                  <option value="">Selecciona </option>
                  <option value="ahorro">AHORROS</option>
                  <option value="corriente">CORRIENTE</option>
                </select>
                <div class="valid-feedback">valido!</div>
                <div class="invalid-feedback">Por favor ingrese el tipo de cuenta</div>
              </div>
              <div class="col-4">
                <label class="form-label" for="num_cuenta">Numero de Cuenta Bancaria <span style="color: red;">*</span></label>

                <input type="text" id="num_cuenta" name="num_cuenta" class="form-control {{ $errors->has('num_cuenta') ? ' is-invalid' : '' }}" placeholder="Ingresa el número de Cuenta" aria-label="Documento de indentidad" aria-describedby="numero de cuenta" required />
                <div class="valid-feedback">valido!</div>
                <div class="invalid-feedback">Por favor ingresa tu contraseña.</div>
              </div>

              <div class="col-4 mt-3">
                <label class="form-label" for="basic-default-password1">Password <span style="color: red;">*</span></label>
                <input type="password" id="basic-default-password1" name="password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required />
                <div class="valid-feedback">valido!</div>
                <div class="invalid-feedback">Por favor ingresa tu contraseña.</div>
              </div>

              <div class="row align-items-end">
                <div class="col-10">
                  <button class="btn-int  active mb-5 mt-5" href="#1" data-toggle="tab">Atras</button>
                </div>
                <div class="col">
                  <a class="btn btn-primarys text-white mb-5 mt-5" href="#3" data-toggle="tab">Siguiente</a>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane " id="3">
            <div class="container" style="background-color: #FFFFFF !important;">
              <div id="exTab2" class="container row">
                <div class="panel panel-default row align-items-start mt-4 ">

                  <div class="col-3 ">
                    <a href="#" id="inft">1 Información Personal</a>
                    <div class="line-mft"></div>
                  </div>

                  <div class="col-3">
                    <a id="inft" href="#"> 2 Información Bancaria</a>
                    <div class="line-mft"></div>
                  </div>

                  <div class="col-4">
                    <a id="inf" href="#"> 3 Información de inversión</a>
                    <div class="line-mf"></div>
                  </div>
                </div>
              </div>
            </div>
            <div id="Información-de-inversión">
              <div class="container mt-4 mb-3 row">
                <div class="row align-items-start">
                  <div class="col-4">
                    <label class="form-label" for="invertido">Valor a Administrar <span style="color: red;">*</span></label>

                    <input type="text" id="invertido" name="invertido" class="form-control {{ $errors->has('invertido') ? ' is-invalid' : '' }}" placeholder="Valor a Administrar" aria-label="Valor a Administrar" aria-describedby="Valor a Administrar" required />
                    <div class="valid-feedback">valido!</div>
                    <div class="invalid-feedback">Por favor ingresa tu Valor a Administrar.</div>
                  </div>


                  <div class="col-4">
                    <label class="form-label">Tipo de interes <span style="color: red;">*</span></label>


                    <select class="form-select {{ $errors->has('tipo_interes') ? ' is-invalid' : '' }}" id="tipo_interes1" name="tipo_interes" required>
                      <option value="">Seleccionar</option>
                      <option class="form-check-input" type="radio" name="tipo_interes" id="tipo_interes2" value="compuesto" value="1">LINEAL</option>
                      <option class="form-check-input" type="radio" name="tipo_interes" id="tipo_interes2" value="compuesto" value="2">COMPUESTO</option>
                    </select>



                  </div>


                  <div class="col-4 mb-3">
                    <label class="form-label" for="fecha_consignacion">Fecha de Consignación <span style="color: red;">*</span></label>

                    <input type="date" id="fecha_consignacion" name="fecha_consignacion" class="form-control {{ $errors->has('fecha_consignacion') ? ' is-invalid' : '' }}" placeholder="Fecha de Consignación " aria-label="Fecha de Consignación" aria-describedby="Fecha de Consignaciónr" required />
                    <div class="valid-feedback">valido!</div>
                    <div class="invalid-feedback">Por favor ingresa tu Fecha de Consignación.</div>
                  </div>
                </div>

                <div class="row align-items-center">
                  <div class="col-4">
                    <label class="form-label" for="referente">¿Como conoció nuestro sistema de Inversión? <span style="color: red;">*</span></label>
                    <select class="form-select {{ $errors->has('referente') ? ' is-invalid' : '' }}" id="referente" name="referente" required>
                      <option value="">Elegir</option>
                      <option value="GERSON OSORIO">GERSON OSORIO</option>
                      <option value="PAOLA SOTELO">PAOLA SOTELO</option>
                      <option value="ANGEL MENDOZA">ANGEL MENDOZA</option>
                      <option value="CAMILO BARBOSA">CAMILO BARBOSA</option>
                      <option value="IVAN SALAZAR">IVAN SALAZAR</option>
                      <option value="ALEX C.">ALEX C.</option>
                      <option value="ALEJANDRA C.">ALEJANDRA C.</option>
                    </select>
                    <div class="valid-feedback">valido!</div>
                    <div class="invalid-feedback">Por favor ingresa Como conoció nuestro sistema de Inversión.</div>
                  </div>


                  <div class="col-4 mt-2">
                    <label for="comprobante_consignacion" class="form-label">subir comprobante de consignación <span style="color: red;">*</span></label>
                    <input class="form-control" type="file" id="comprobante_consignacion" name="comprobante_consignacion" />
                  </div>

                  <div class="col-4">
                    <label class="form-label" for="periodo_mes">¿La consignación se realizó en cual periodo del mes? <span style="color: red;">*</span></label>
                    <select class="form-select {{ $errors->has('periodo_mes') ? ' is-invalid' : '' }}" id="periodo_mes" name="periodo_mes" required>
                      <option value="">Elegir</option>
                      <option value="1">del 1 al 15</option>
                      <option value="2">del 16 al 30 o (31)</option>>
                    </select>
                    <div class="valid-feedback">valido!</div>
                    <div class="invalid-feedback">Por favor ingresa el periodo del mes.</div>
                  </div>


                  <div class="form-check my-50 mt-3">

                    <input type="checkbox" id="terminos" name="terminos" class="form-check-input {{ $errors->has('terminos') ? ' is-invalid' : '' }}" required />
                    <label class="form-check-label form-label" for="terminos">Autorizo el tratamiento de mis datos personales conforme a la ley colombiana <span style="color: red;">*</span></label>
                  </div>
                </div>
              </div>
            </div>

            <div class="row align-items-end">
              <div class="col-10">
                <button class="btn-int  active mb-5 mt-5" href="#2" data-toggle="tab">Atras</button>
              </div>

              <div class="col-2">
                <button class=" btn btn-primarys text-white mb-5 mt-5">Firmar</button>
              </div>

              <!-- Vertical modal -->
              <!-- Modal -->
              <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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

    </form>

</section>


<footer class="footert">
  <span>
    <img src="{{asset('images/svg/Frame.svg')}}" alt="">
    </label>
    <div class="ul mt-2">
      <p class="li nav-item">The New Investor 2021 | Todos los Derechos Reservados</p>
    </div>
</footer>


</section>


<!-- /Validation -->
@endsection
@push('custom-scripts')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
  var modal = document.getElementById('modal')

  $('.subir').click(function() {

    $('#inversion_id').val($('.subir').attr('inversion'));
    var myModal = new bootstrap.Modal(modal);

    myModal.show();

  });

  modal.addEventListener('shown.bs.modal', function(event) {

    var wrapper = document.getElementById("signature-pad");

    var canvas = wrapper.querySelector("canvas");
    var signaturePad = new SignaturePad(canvas, {
      backgroundColor: 'rgb(255, 255, 255)'
    });

    function resizeCanvas() {

      var ratio = Math.max(window.devicePixelRatio || 1, 1);

      canvas.width = canvas.offsetWidth * ratio;
      canvas.height = canvas.offsetHeight * ratio;
      canvas.getContext("2d").scale(ratio, ratio);

      signaturePad.clear();
    }

    window.onresize = resizeCanvas;
    resizeCanvas();

    $('#limpiar').click(function() {
      signaturePad.clear();
    })

    $('#btnGuardar').click(function() {

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
        }).done(function(response) {
          //$("#loading").modal('hide');

          if (response.success == true) {
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
              backdrop: true,
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

  var botonModal = document.getElementsByClassName('btn-primarys')
  
  botonModal.addEventListener("click", function (event) {
    console.log("Aqui el modal");
  },false)

</script>


@endpush
@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

@endsection
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/forms/form-validation.js')) }}"></script>
@endsection