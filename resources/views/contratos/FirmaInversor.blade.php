
@extends('layouts/contentLayoutMaster')

@section('title', 'Firma del Inversor')

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
        <div class="table-responsive" style="height: 63vh;">
          <table class="table">
            <thead>
              <tr>
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
              @forelse ($inversiones as $inv)
                  <tr>
                    <td>{{$inv->id}}</td>
                    <td>{{$inv->getUser->fullname}}</td>
                    <td>{{"000999222333"}}</td>
                    <td>{{$inv->getUser->email}}</td>
                    <td>{{date('M-d-Y', strtotime($inv->created_at))}}</td>
                  </tr>
              @empty
                  <tr class="text-center">
                    <td colspan="7">Sin Contratos</td>
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
