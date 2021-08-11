
@extends('layouts/contentLayoutMaster')

@section('title', 'Nueva inversion')

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
<section class="bs-validation">
  <div class="row">
    <!-- Bootstrap Validation -->
    <div class="col-12">
      <div class="card">
        
        <div class="card-header">
          <h4 class="card-title">Información personal</h4>
        </div>
        
        <div class="card-body">
          <form class="" method="POST" action="{{route('inversiones.store')}}">
            @csrf
            <div class="mb-1">
                <label class="form-label" for="fullname">Nombre Completo <span style="color: red;">*</span></label>
  
                <input
                  type="text"
                  id="fullname"
                  name="fullname"
                  class="form-control {{ $errors->has('fullname') ? ' is-invalid' : '' }}"
                  placeholder="nombre y apellido"
                  aria-label="nombre y apellido"
                  aria-describedby="nombre completo de la persona"
                  required
                />
                <div class="valid-feedback">valido!</div>
                <div class="invalid-feedback">Por favor ingresa tu nombre y apellido.</div>
            </div>
            
            <div class="mb-1">
                <label class="form-label" for="tipo_documento">Tipo Documento de Identidad <span style="color: red;">*</span></label>
                <select class="form-select {{ $errors->has('tipo_documento') ? ' is-invalid' : '' }}" id="tipo_documento" required name="tipo_documento">
                  <option value="">Elegir</option>
                  <option value="cedula_ciudadana">Cédula de ciudadania</option>
                  <option value="cedula_extranjera">Cédula de Extranjeria</option>
                  <option value="pasaporte">Pasaporte</option>
                </select>
                <div class="valid-feedback">valido!</div>
                <div class="invalid-feedback">Por favor ingrese el tipo de documento</div>
            </div>

            <div class="mb-1">
                <label class="form-label" for="num_documento">Numero de Documento de Identidad <span style="color: red;">*</span></label>
  
                <input
                  type="number"
                  id="num_documento"
                  name="num_documento"
                  class="form-control {{ $errors->has('num_documento') ? ' is-invalid' : '' }}"
                  placeholder="Documento de indentidad"
                  aria-label="Documento de indentidad"
                  aria-describedby="numero del documento de identidad"
                  required
                />
                <div class="valid-feedback">valido!</div>
                <div class="invalid-feedback">Por favor ingresa tu Numero de Documento de Identidad.</div>
            </div>

            <div class="mb-1">
                <label class="form-label" for="ciudad_residencia">Ciudad de Residencia <span style="color: red;">*</span></label>
  
                <input
                  type="text"
                  id="ciudad_residencia"
                  name="ciudad_residencia"
                  class="form-control {{ $errors->has('ciudad_residencia') ? ' is-invalid' : '' }}"
                  placeholder="Ciudad de Residencia"
                  aria-label="Ciudad de Residencia"
                  aria-describedby="ciudad de residencia"
                  required
                />
                <div class="valid-feedback">valido!</div>
                <div class="invalid-feedback">Por favor ingresa tu Ciudad de Residencia.</div>
            </div>

            <div class="mb-1">
                <label class="form-label" for="direccion_residencia">Dirección de Residencia  <span style="color: red;">*</span></label>
  
                <input
                  type="text"
                  id="direccion_residencia"
                  name="direccion_residencia"
                  class="form-control {{ $errors->has('direccion_residencia') ? ' is-invalid' : '' }}"
                  placeholder="Dirección de Residencia "
                  aria-label="Dirección de Residencia "
                  aria-describedby="basic-addon-name"
                  required
                />
                <div class="valid-feedback">valido!</div>
                <div class="invalid-feedback">Por favor ingresa tu Dirección de Residencia .</div>
            </div>

            <div class="mb-1">
                <label class="form-label input-phone" for="celular">Numero de Celular <span style="color: red;">*</span></label>
  
                <input
                  type="number"
                  id="celular"
                  name="celular"
                  class="form-control {{ $errors->has('celular') ? ' is-invalid' : '' }}"
                  placeholder="Numero de Celular"
                  aria-label="Numero de Celular"
                  aria-describedby="basic-addon-name"
                  required
                />
                <div class="valid-feedback">valido!</div>
                <div class="invalid-feedback">Por favor ingresa tu Numero de Celular.</div>
            </div>


            <div class="mb-1">
              <label class="form-label" for="email">Correo electrónico</label>
              <input
                type="email"
                id="email"
                name="email"
                class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                placeholder="john.doe@email.com"
                aria-label="john.doe@email.com"
                required
              />
              <div class="valid-feedback">valido!</div>
              <div class="invalid-feedback">Por favor ingresa tu Correo electrónico.</div>
            </div>

            <div class="mb-1">
                <label class="form-label" for="banco">Banco (Preferiblemente Bancolombia o Nequi; en caso de otros Bancos y por disposición del sistema financiero el pago se puede demorar entre uno y siete días hábiles posterior a la fecha de consignación)  <span style="color: red;">*</span></label>
                <select class="form-select {{ $errors->has('banco') ? ' is-invalid' : '' }}" id="banco" required name="banco">
                  <option value="">Elegir</option>
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

            <div class="mb-1">
                <label class="form-label" for="tipo_cuenta">Tipo de Cuenta <span style="color: red;">*</span></label>
                <select class="form-select {{ $errors->has('tipo_cuenta') ? ' is-invalid' : '' }}" id="tipo_cuenta" required name="tipo_cuenta">
                  <option value="">Elegir</option>
                  <option value="ahorro">AHORROS</option>
                  <option value="corriente">CORRIENTE</option>
                </select>
                <div class="valid-feedback">valido!</div>
                <div class="invalid-feedback">Por favor ingrese el tipo de cuenta</div>
            </div>

            <div class="mb-1">
                <label class="form-label" for="num_cuenta">Numero de Cuenta Bancaria <span style="color: red;">*</span></label>
  
                <input
                  type="number"
                  id="num_cuenta"
                  name="num_cuenta"
                  class="form-control {{ $errors->has('num_cuenta') ? ' is-invalid' : '' }}"
                  placeholder="Documento de indentidad"
                  aria-label="Documento de indentidad"
                  aria-describedby="numero de cuenta"
                  required
                />
                <div class="valid-feedback">valido!</div>
                <div class="invalid-feedback">Por favor ingresa tu contraseña.</div>
            </div>

            <div class="mb-1">
              <label class="form-label" for="basic-default-password1">Password</label>
              <input
                type="password"
                id="basic-default-password1"
                name="password"
                class="form-control"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                required
              />
              <div class="valid-feedback">valido!</div>
              <div class="invalid-feedback">Por favor ingresa tu contraseña.</div>
            </div>

            <div class="mt-2">
                <h4 class="card-title">Información de inversión</h4>
            </div>

            <div class="mb-1">
                <label class="form-label" for="invertido">Valor a Administrar <span style="color: red;">*</span></label>
  
                <input
                  type="number"
                  id="invertido"
                  name="invertido"
                  class="form-control {{ $errors->has('invertido') ? ' is-invalid' : '' }}"
                  placeholder="Valor a Administrar"
                  aria-label="Valor a Administrar"
                  aria-describedby="Valor a Administrar"
                  required
                />
                <div class="valid-feedback">valido!</div>
                <div class="invalid-feedback">Por favor ingresa tu Valor a Administrar.</div>
            </div>

            <div class="mb-1">
                <label class="form-label">Tipo de interes</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipo_interes" id="tipo_interes1" value="lineal">
                    <label class="form-check-label" for="tipo_interes1">
                        LINEAL
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipo_interes" id="tipo_interes2" value="compuesto">
                    <label class="form-check-label" for="tipo_interes2">
                        COMPUESTO
                    </label>
                </div>
            </div>

            <div class="mb-1">
                <label class="form-label" for="fecha_consignacion">Fecha de Consignación <span style="color: red;">*</span></label>
  
                <input
                  type="date"
                  id="fecha_consignacion"
                  name="fecha_consignacion"
                  class="form-control {{ $errors->has('fecha_consignacion') ? ' is-invalid' : '' }}"
                  placeholder="Fecha de Consignación"
                  aria-label="Fecha de Consignación"
                  aria-describedby="Fecha de Consignaciónr"
                  required
                />
                <div class="valid-feedback">valido!</div>
                <div class="invalid-feedback">Por favor ingresa tu Fecha de Consignación.</div>
            </div>

            <div class="mb-1">
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

            <div class="mb-1">
              <label for="comprobante_consignacion" class="form-label">subir comprobante de consignación</label>
              <input class="form-control" type="file" id="comprobante_consignacion" name="comprobante_consignacion"/>
            </div>

            <div class="mb-1">
                <label class="form-label" for="periodo_mes">¿ La consignación se realizó en cual periodo del mes ? <span style="color: red;">*</span></label>
                <select class="form-select {{ $errors->has('periodo_mes') ? ' is-invalid' : '' }}" id="periodo_mes" name="periodo_mes" required>
                    <option value="">Elegir</option>
                    <option value="1">del 1 al 15</option>
                    <option value="2">del 16 al 30 o (31)</option>>
                </select>
                <div class="valid-feedback">valido!</div>
                <div class="invalid-feedback">Por favor ingresa el periodo del mes.</div>
            </div>


            <div class="mb-1">
              
              <div class="form-check my-50">
                <label class="form-label"><span style="color: red;">*</span></label>
                <input
                  type="checkbox"
                  id="terminos"
                  name="terminos"
                  class="form-check-input {{ $errors->has('terminos') ? ' is-invalid' : '' }}"
                  required
                />
                <label class="form-check-label" for="terminos">Autorizo el tratamiento de mis datos personales conforme a la ley colombiana</label>
              </div>
            </div>

            {{--
            <div class="mb-1">
              <label for="validationCustomUsername" class="form-label">Username</label>
              <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input
                  type="text"
                  class="form-control"
                  id="validationCustomUsername"
                  aria-describedby="inputGroupPrepend"
                  required
                />
                <div class="invalid-feedback">Please choose a username.</div>
              </div>
            </div>
            <div class="mb-1">
              <label class="d-block form-label" for="validationBioBootstrap">Bio</label>
              <textarea
                class="form-control"
                id="validationBioBootstrap"
                name="validationBioBootstrap"
                rows="3"
                required
              ></textarea>
            </div>
            <div class="mb-1">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="validationCheckBootstrap" required />
                <label class="form-check-label" for="validationCheckBootstrap">Agree to our terms and conditions</label>
                <div class="invalid-feedback">You must agree before submitting.</div>
              </div>
            </div>
            --}}
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>

        
      </div>
    </div>
    <!-- /Bootstrap Validation -->
  </div>
</section>
<!-- /Validation -->
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/forms/form-validation.js')) }}"></script>
@endsection
