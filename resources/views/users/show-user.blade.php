@extends('layouts/contentLayoutMaster')

@section('title', 'Información del usuario')

@section('content')
<div class="row match-height d-flex justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="form-body">
                        <div class="row">
                            <h2 class="my-1 font-bold col-12 text-center">Datos del usuario</h2>
                            <div class="col-8">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" readonly class="form-control" value="{{ $user->fullname }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" readonly class="form-control" value="{{$user->email}}">
                                </div>
                            </div>
                            <div class="col-4 mt-1">
                                <div class="form-group">
                                    <label>Telefono</label>
                                    <input type="text" readonly class="form-control" value="{{$user->celular}}">
                                </div>
                            </div>
                            <div class="col-4 mt-1">
                                <div class="form-group">
                                    <label>Tipo de documento</label>
                                    <input type="text" readonly class="form-control" value="{{preg_replace('/[\_\" "]+/', ' ', $user->tipo_documento)}}">
                                </div>
                            </div>
                            <div class="col-4 mt-1">
                                <div class="form-group">
                                    <label>Numero de documento</label>
                                    <input type="text" readonly class="form-control" value="{{$user->num_documento}}">
                                </div>
                            </div>
                            <div class="col-4 mt-1">
                                <div class="form-group">
                                    <label>Ciudad de residencia</label>
                                    <input type="text" readonly class="form-control" value="{{$user->ciudad_residencia}}">
                                </div>
                            </div>
                            <div class="col-8 mt-1">
                                <div class="form-group">
                                    <label>Dirección de residencia</label>
                                    <input type="text" readonly class="form-control" value="{{$user->direccion_residencia}}">
                                </div>
                            </div>
                            <div class="col-4 mt-1">
                                <div class="form-group">
                                    <label>Banco</label>
                                    <input type="text" readonly class="form-control" value="{{$user->banco}}">
                                </div>
                            </div>
                            <div class="col-4 mt-1">
                                <div class="form-group">
                                    <label>Tipo de cuenta</label>
                                    <input type="text" readonly class="form-control" value="{{$user->tipo_cuenta}}">
                                </div>
                            </div>
                            <div class="col-4 mt-1">
                                <div class="form-group">
                                    <label>Numero de cuenta</label>
                                    <input type="text" readonly class="form-control" value="{{$user->num_cuenta}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row match-height d-flex justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">  
                    <div class="form-body">
                        <div class="row">
                            <h2 class="my-1 font-bold col-12 text-center">Información de Contratos</h2>


                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped w-100">
                                                
                                                <thead class="">
                                                    <tr class="text-center text-dark bg-purple-alt2">
                                                        <th>ID</th>
                                                        <th>Invertido</th>
                                                        <th>Tipo de Interés</th>
                                                        <th>Fecha de consignación</th>
                                                        <th>Estado</th>
                                                        <th>Referente</th>
                                                    </tr>
                                                </thead>
                    
                                                <tbody>
                                                    @forelse ($inv as $item)
                                                        <tr class="text-center">
                                                            <td>{{ $item->id}}</td>
                                                            <td>{{ number_format($item->invertido,2,',','.')}}</td>
                                                            <td>{{ $item->tipo_interes}}</td>
                                                            <td>{{ $item->fecha_consignacion}}</td>
                                                            <td>
                                                                @if($item->contrato == null || $item->contrato->status == "por_firmar")
                                                                  <span class="badge rounded-pill badge-light-danger me-1">Por firmar</span>
                                                                @elseif($item->contrato->status == "firma_cliente")
                                                                  <span class="badge rounded-pill badge-light-warning me-1">Espera</span>
                                                                @elseif($item->contrato->status == "firmado")
                                                                <span class="badge rounded-pill badge-light-success me-1">Firmado</span>
                                                                @endif
                                                                
                                                              </td>
                                          
                                                            <td>{{ $item->referente}}</td>                                                                                                                        
                                                        </tr>
                                                    @empty 
                                                    <tr>
                                                        <td colspan="5" class="text-center">Sin Contratos</td>
                                                    </tr>
                                                    @endforelse                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>   

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

  
@endsection

