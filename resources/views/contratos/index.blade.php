
@extends('layouts/fullLayoutMaster')

@section('title', 'Lista de contratos')

@section('content')
<div class="capa-exterior">
  <img class="margin" href="#" src="{{ asset('images/logo1.png') }}" alt="" width="100">
  <div>
      <h3 class="capa-interior">the new investor</h3>
      <br>
      <p class="capa-exterior2">Te damos la bienvenida a nuestro sistema de inversión, agradecemos diligenciar el
          siguiente formulario para poder brindarte un mejor servicio y garantizar consignar tus rentabilidades
          mensuales directamente a tu cuenta bancaria.</p>
  </div>
</div>

<!-- Basic Tables start -->
<div class="row" id="basic-table">
  <div class="col-12">
    <div class="card m-5">
    {{--
      <div class="card-header">
        <h4 class="card-title">Table Basic</h4>
      </div>
      --}}
      <div class="card-body">
        
        {{--@if(Auth::user()->admin == 1)--}}
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
        {{--@endif--}}
      
        <div class="table-responsive" style="height: 63vh;">
          <table class="table">
            <thead>
              <tr>
                <th>Id</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Acción</th>
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
                          {{--
                          <a class="dropdown-item subir" inversion="{{$inversion->id}}">
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
    {{--
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
    --}}
  
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
@endsection

@push('custom-scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@endpush