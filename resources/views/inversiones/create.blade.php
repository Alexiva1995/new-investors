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

    <style>
        .panel.panel-default.row.align-items-start {
            text-align: center;
        }
        .tab-pane {
            padding: 0px 40px;
        }

        .header{
            position: relative;
            background-color: black;
        }

    </style>
@endsection

@section('content')

{{-- <div class="capa-exterior">
    <img class="margin" href="#" src="{{ asset('images/logo1.png') }}" alt="" width="100">
    <div>
        <h3 class="capa-interior">the new investor</h3>
        <br>
        <p class="capa-exterior2">Te damos la bienvenida a nuestro sistema de inversión, agradecemos diligenciar el
            siguiente formulario para poder brindarte un mejor servicio y garantizar consignar tus rentabilidades
            mensuales directamente a tu cuenta bancaria.</p>
    </div>
</div> --}}

<div class="header">
    <div class="d-flex justify-content-center align-items-center py-4">
        <img href="#" src="{{ asset('images/logo1.png') }}" alt="" width="100">
    </div>
</div>
<!-- Validation -->

<section class="bs-validation py-5" style="background-color: #FFFFFF !important;">
    <div class="container py-5">
        <form class="" id="formInvestor" name="formInvestor" method="POST" action="{{ route('inversiones.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="panel-body">
                <div class="tab-content ">
                    <div class="tab-pane active " id="1">
                        <div class="">
                            <div class="" style="background-color: #FFFFFF !important;">
                                <div id="exTab2" class="row">
                                    <div class="panel panel-default row align-items-start">
                                        <div class="col-4 ">
                                            <a href="#" id="inf">1. Información Personal</a>
                                            <div class="line-mf"></div>
                                        </div>
                                        <div class="col-4">
                                            <a id="inft" href="#"> 2. Información Bancaria</a>
                                            <div class="line-mft"></div>
                                        </div>
                                        <div class="col-4">
                                            <a id="inft" href="#"> 3. Información de inversión</a>
                                            <div class="line-mft"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row  mt-3">
                                <div class="col-4 ">
                                    <label class="form-label" for="fullname">Nombre Completo <span style="color: red;">*</span></label>
                                    <input type="text" id="fullname" name="fullname" class=" form-control  {{ $errors->has('fullname') ? ' is-invalid' : '' }}" placeholder="Ingresa tu Nombre Completo" aria-label="nombre y apellido" aria-describedby="nombre completo de la persona" required value="{{old('fullname')}}"/>
                                    <div class="valid-feedback">valido!</div>
                                    <div class="invalid-feedback">Por favor ingresa tu nombre y apellido.</div>
                                </div>

                                <div class="col-4 mb-3 ">
                                    <label class="form-label" for="tipo_documento">Tipo Documento de Identidad <span style="color: red;">*</span></label>
                                    <select class="form-select {{ $errors->has('tipo_documento') ? ' is-invalid' : '' }}" id="tipo_documento" required name="tipo_documento">
                                        <option value="">Seleccionar</option>
                                        <option value="cedula_ciudadana" @if(old('tipo_documento') == "cedula_ciudadana") selected @endif>Cédula de ciudadania</option>
                                        <option value="cedula_extranjera" @if(old('tipo_documento') == "cedula_extranjera") selected @endif>Cédula de Extranjeria</option>
                                        <option value="pasaporte" @if(old('tipo_documento') == "pasaporte") selected @endif>Pasaporte</option>
                                    </select>
                                    <div class="valid-feedback">valido!</div>
                                    <div class="invalid-feedback">Por favor ingrese el tipo de documento</div>
                                </div>


                                <div class="col-4 mb-1">
                                    <label class="form-label" for="num_documento"> Documento de Identidad <span style="color: red;">*</span></label>

                                    <input type="text" id="num_documento" name="num_documento" class="form-control {{ $errors->has('num_documento') ? ' is-invalid' : '' }}" placeholder="Ingresa tu número de documento" aria-label="Documento de indentidad" aria-describedby="numero del documento de identidad" required value="{{old('num_documento')}}" />
                                    <div class="valid-feedback">valido!</div>
                                    <div class="invalid-feedback">Por favor ingresa tu Numero de Documento de Identidad.
                                    </div>
                                </div>
                            </div>

                            <div class="row" >
                                <div class="col-4 mb-1">
                                    <label class="form-label" for="ciudad_residencia">Ciudad de Residencia <span style="color: red;">*</span></label>

                                    <input type="text" id="ciudad_residencia" name="ciudad_residencia" class="form-control {{ $errors->has('ciudad_residencia') ? ' is-invalid' : '' }}" placeholder="Ingresa tu Ciudad de Residencia" aria-label="Ciudad de Residencia" aria-describedby="ciudad de residencia" required value="{{old('ciudad_residencia')}}"/>
                                    <div class="valid-feedback">valido!</div>
                                    <div class="invalid-feedback">Por favor ingresa tu Ciudad de Residencia.</div>
                                </div>

                                <div class="col-4 mb-1">
                                    <label class="form-label" for="direccion_residencia">Dirección de Residencia <span style="color: red;">*</span></label>

                                    <input type="text" id="direccion_residencia" name="direccion_residencia" class="form-control {{ $errors->has('direccion_residencia') ? ' is-invalid' : '' }}" placeholder="Ingresa tu Dirección de Residencia " aria-label="Dirección de Residencia " aria-describedby="basic-addon-name" required value="{{old('direccion_residencia')}}"/>
                                    <div class="valid-feedback">valido!</div>
                                    <div class="invalid-feedback">Por favor ingresa tu Dirección de Residencia .</div>
                                </div>

                                <div class="col-4 mb-1">
                                    <label class="form-label input-phone" for="celular">Numero de Celular <span style="color: red;">*</span></label>

                                    <input type="text" id="celular" name="celular" class="form-control {{ $errors->has('celular') ? ' is-invalid' : '' }}" placeholder="Ingresa tu Número de Celular" aria-label="Numero de Celular" aria-describedby="basic-addon-name" required value="{{old('celular')}}"/>
                                    <div class="valid-feedback">valido!</div>
                                    <div class="invalid-feedback">Por favor ingresa tu Numero de Celular.</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4 mt-1">
                                    <label class="form-label" for="email">Correo electrónico <span style="color: red;">*</span></label>
                                    <input type="email" id="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Ingresa tu Correo Electrónico" aria-label="john.doe@email.com" required value="{{old('email')}}"/>
                                    <div class="valid-feedback">valido!</div>
                                    <div class="invalid-feedback">Por favor ingresa tu Correo electrónico.</div>
                                </div>
                            </div>

                            <a class="btn  btn-primarys float-right text-white mb-5 mt-5" href="#2" data-toggle="tab">Siguiente</a>
                        </div>
                    </div>


                    <div class="tab-pane " id="2">
                        <div class="" style="background-color: #FFFFFF !important;">
                            <div id="exTab2" class="row">
                                <div class="panel panel-default row align-items-start">
                                    <div class="col-4 ">
                                        <a href="#" id="inft">1. Información Personal</a>
                                        <div class="line-mft"></div>
                                    </div>
                                    <div class="col-4">
                                        <a id="inf" href="#"> 2. Información Bancaria</a>
                                        <div class="line-mf"></div>
                                    </div>
                                    <div class="col-4">
                                        <a id="inft" href="#"> 3. Información de inversión</a>
                                        <div class="line-mft"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4 " >
                            <div class="col-4">
                                <label class="form-label" for="banco">Banco<span style="color: red;">*</span> </label>
                                <select class="form-select {{ $errors->has('banco') ? ' is-invalid' : '' }}" id="banco" required name="banco">
                                    <option value="">Selecciona un Banco</option>
                                    <option value="Bancolombia" @if(old('banco') == "Bancolombia") selected @endif>Bancolombia</option>
                                    <option value="NEQUI de Bancolombia" @if(old('banco') == "NEQUI de Bancolombia") selected @endif>NEQUI de Bancolombia</option>
                                    <option value="Banco Av Villas" @if(old('banco') == "Banco Av Villas") selected @endif>Banco Av Villas</option>
                                    <option value="Davivienda" @if(old('banco') == "Davivienda") selected @endif>Davivienda</option>
                                    <option value="Banco de Bogotá" @if(old('banco') == "Banco de Bogotá") selected @endif>Banco de Bogotá</option>
                                    <option value="Banco Popular" @if(old('banco') == "Banco Popular") selected @endif>Banco Popular</option>
                                    <option value="Banco de Occidente" @if(old('banco') == "Banco de Occidente") selected @endif>Banco de Occidente</option>
                                    <option value="Banco Colpatria" @if(old('banco') == "Banco Colpatria") selected @endif>Banco Colpatria</option>
                                    <option value="Banco BBVA" @if(old('banco') == "Banco BBVA") selected @endif>Banco BBVA</option>
                                    <option value="Banco Caja social" @if(old('banco') == "Banco Caja social") selected @endif>Banco Caja social</option>
                                    <option value="GNB Sudameris" @if(old('banco') == "GNB Sudameris") selected @endif>GNB Sudameris</option>
                                    <option value="Banco Agrario" @if(old('banco') == "Banco Agrario") selected @endif>Banco Agrario</option>
                                </select>
                                <div class="valid-feedback">valido!</div>
                                <div class="invalid-feedback">Por favor ingrese el banco</div>
                            </div>
                            <div class="col-4">
                                <label class="form-label" for="tipo_cuenta">Tipo de Cuenta <span style="color: red;">*</span></label>
                                <select class="form-select {{ $errors->has('tipo_cuenta') ? ' is-invalid' : '' }}" id="tipo_cuenta" required name="tipo_cuenta">
                                    <option value="">Selecciona </option>
                                    <option value="ahorro" @if(old('tipo_cuenta') == "ahorro") selected @endif>AHORROS</option>
                                    <option value="corriente" @if(old('tipo_cuenta') == "corriente") selected @endif>CORRIENTE</option>
                                </select>
                                <div class="valid-feedback">valido!</div>
                                <div class="invalid-feedback">Por favor ingrese el tipo de cuenta</div>
                            </div>
                            <div class="col-4">
                                <label class="form-label" for="num_cuenta">Numero de Cuenta Bancaria <span style="color: red;">*</span></label>

                                <input type="text" id="num_cuenta" name="num_cuenta" class="form-control {{ $errors->has('num_cuenta') ? ' is-invalid' : '' }}" placeholder="Ingresa el número de Cuenta" aria-label="Documento de indentidad" aria-describedby="numero de cuenta" required value="{{old('num_cuenta')}}"/>
                                <div class="valid-feedback">valido!</div>
                                <div class="invalid-feedback">Por favor ingresa tu contraseña.</div>
                            </div>

                            <div class="row " style="margin-left: 30px !important;">
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
                        <div class="" style="background-color: #FFFFFF !important;">
                            <div id="exTab2" class="row">
                                <div class="panel panel-default row align-items-start">
                                    <div class="col-4">
                                        <a href="#" id="inft">1. Información Personal</a>
                                        <div class="line-mft"></div>
                                    </div>

                                    <div class="col-4">
                                        <a id="inft" href="#"> 2. Información Bancaria</a>
                                        <div class="line-mft"></div>
                                    </div>

                                    <div class="col-4">
                                        <a id="inf" href="#"> 3. Información de inversión</a>
                                        <div class="line-mf"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="Información-de-inversión">
                            <div class=" mt-4 mb-3 ">
                                <div class="row">
                                    <div class="col-4">
                                        <label class="form-label" for="invertido">Valor a Administrar <span style="color: red;">*</span></label>

                                        <input type="text" id="invertido" name="invertido" class="form-control {{ $errors->has('invertido') ? ' is-invalid' : '' }}" placeholder="Valor a Administrar" aria-label="Valor a Administrar" aria-describedby="Valor a Administrar" required value="{{old('invertido')}}"/>
                                        <div class="valid-feedback">valido!</div>
                                        <div class="invalid-feedback">Por favor ingresa tu Valor a Administrar.</div>
                                    </div>


                                    <div class="col-4">
                                        <label class="form-label">Tipo de interes <span style="color: red;">*</span></label>
                                        <select class="form-select {{ $errors->has('tipo_interes') ? ' is-invalid' : '' }}" id="tipo_interes1" name="tipo_interes" required >
                                            <option value="">Seleccionar</option>
                                            <option class="form-check-input" value="lineal" @if(old('tipo_interes') == "lineal") selected @endif>LINEAL</option>
                                            <option class="form-check-input" value="compuesto" @if(old('tipo_interes') == "compuesto") selected @endif>COMPUESTO</option>
                                        </select>
                                        <div class="valid-feedback">valido!</div>
                                        <div class="invalid-feedback">Por favor ingresa el tipo de interes.</div>
                                    </div>


                                    <div class="col-4 mb-3">
                                        <label class="form-label" for="fecha_consignacion">Fecha de Consignación <span style="color: red;">*</span></label>

                                        <input type="date" id="fecha_consignacion" name="fecha_consignacion" class="form-control {{ $errors->has('fecha_consignacion') ? ' is-invalid' : '' }}" placeholder="Fecha de Consignación " aria-label="Fecha de Consignación" aria-describedby="Fecha de Consignaciónr" required value="{{old('fecha_consignacion')}}"/>
                                        <div class="valid-feedback">valido!</div>
                                        <div class="invalid-feedback">Por favor ingresa tu Fecha de Consignación.</div>
                                    </div>
                                </div>

                                <div class="row ">
                                    <div class="col-4">
                                        <label class="form-label" for="referente">¿Como conoció nuestro sistema de
                                            Inversión? <span style="color: red;">*</span></label>
                                        <input class="form-control {{ $errors->has('referente') ? ' is-invalid' : '' }}" id="referente" name="referente" required value="{{old('referente')}}">
                                        <div class="valid-feedback">valido!</div>
                                        <div class="invalid-feedback">Por favor ingresa Como conoció nuestro sistema de
                                            Inversión.</div>
                                    </div>


                                    <div class="col-4 ">
                                        <label for="comprobante_consignacion" class="form-label">subir comprobante de
                                            consignación <span style="color: red;">*</span></label>
                                        <input class="form-control {{ $errors->has('comprobante_consignacion') ? ' is-invalid' : '' }}" type="file" id="comprobante_consignacion" name="comprobante_consignacion" value="{{old('comprobante_consignacion')}}"/>
                                        <div class="valid-feedback">valido!</div>
                                        <div class="invalid-feedback">Por favor sube tu comprobante de consignacion.</div>
                                        @if($errors->first() != null && !$errors->has('comprobante_consignacion'))
                                        <div class="text-danger">Por favor vuelva a subir su comprobante de consignacion.</div>
                                        @endif
                                    </div>

                                    <input class="form-control" type="file" id="firma_cliente" name="firma_cliente" style="display:none;" />


                                    <div class="col-4">
                                        <label class="form-label" for="periodo_mes">¿La consignación se realizó en cual
                                            periodo del mes? <span style="color: red;">*</span></label>
                                        <select class="form-select {{ $errors->has('periodo_mes') ? ' is-invalid' : '' }}" id="periodo_mes" name="periodo_mes" required>
                                            <option value="">Elegir</option>
                                            <option value="1" @if(old('periodo_mes') == "1") selected @endif>del 1 al 15</option>
                                            <option value="2" @if(old('periodo_mes') == "2") selected @endif>del 16 al 30 o (31)</option>>
                                        </select>
                                        <div class="valid-feedback">valido!</div>
                                        <div class="invalid-feedback">Por favor ingresa el periodo del mes.</div>
                                    </div>


                                    <div class="form-check my-50 mt-3">

                                        <input type="checkbox" id="terminos" name="terminos" class="form-check-input {{ $errors->has('terminos') ? ' is-invalid' : '' }}" required />
                                        <label class="form-check-label form-label" for="terminos">Autorizo el
                                            tratamiento de mis datos personales conforme a la ley colombiana <span style="color: red;">*</span></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-left: 30px !important;">
                            <div class="col-10">
                                <button class="btn-int  active mb-5 mt-5" href="#2" data-toggle="tab">Atras</button>
                            </div>

                            <div class="col-2">
                                <button type="button" class="subir btn btn-primarys text-white mb-5 mt-5">Firmar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Vertically Centered
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="signature-pad" class="signature-pad" style="margin: 0px auto;">
                                    <div class="signature-pad--body">
                                        <p>Colocar tu firma aqui</p>
                                        <canvas style="border: 1px solid #000; width: 100%;"></canvas>
                                        <input type="hidden" id="imagen64" name="imagen64">
                                    </div>
                                    <div class="signature-pad--footer">
                                        <div class="text-center">Accion</div>
                                        <div class="text-center">
                                            <button type="button" class="button clear btn btn-info btn-round" data-action="clear" id="limpiar">Limpiar</button>
                                            <input type="button" class="button btn btn-info btn-round" id="btnGuardar" value="Firmar">
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
    </div>
    <!-- Vertical modal -->


</section>

<footer class="footer-section">
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 ">
                    <div class="copyright-text">
                        <img src="{{asset('images/logo1.png') }}" alt="" width="100">
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 d-none d-lg-block text-right">
                    <div class="footer-menu">
                        <p class="li nav-item w-100 mt-2 text-white" style="text-align: right">The New Investor 2021 | Todos los Derechos Reservados
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- /Validation -->
@endsection
@push('custom-scripts')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    var modal = document.getElementById('modal')

    $('.subir').click(function() {

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

        document.querySelector('#btnGuardar').addEventListener('click', function(e) {
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
                console.log("SIN FIRMA");
                return false;
            }
            document.getElementById('imagen64').value = signaturePad.toDataURL();
            
            $('#formInvestor').submit();
        });
    })

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
<script>
    let html = document.querySelector('html');
    let body = document.querySelector('body');
    html.classList.remove('dark-layout');
    body.classList.remove('dark-layout');
</script>
@endsection