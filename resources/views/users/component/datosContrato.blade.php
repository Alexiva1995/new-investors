<div class="row match-height d-flex justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">  
                    <div class="form-body">
                        <div class="row">
                            <h2 class="my-1 font-bold col-12 text-center">Datos del contrato</h2>
                            <div class="col-12 col-md-6 ">
                                <div class="form-group">
                                    <label>Invertido</label>
                                    <input type="text" readonly class="form-control" value="{{ number_format($inversion->invertido,2,",",".") }}">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Tipo de interés</label>
                                    <input type="text" readonly class="form-control" value="{{ $inversion->tipo_interes }}">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mt-1">
                                <div class="form-group">
                                    <label>Fecha de Consignación</label>
                                    <input type="date" readonly class="form-control" value="{{ $inversion->fecha_consignacion}}">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mt-1">
                                <div class="form-group">
                                    <label>Referente</label>
                                    <input type="text" readonly class="form-control" value="{{ $inversion->referente }}">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mt-1">
                                <div class="form-group">
                                    <label>Periodo del mes</label>
                                    @if($inversion->periodo_mes == 1)
                                        <input type="text" readonly class="form-control" value="del 1 al 15">            
                                    @else
                                        <input type="text" readonly class="form-control" value="del 16 al 30 o (31)">                        
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mt-1">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <input type="text" readonly class="form-control" 
                                        value="{{ preg_replace('/[\_\" "]+/', ' ', $inversion->status) }}">
                            
                                </div>
                            </div>

                            <div class="col-12 col-md-6 mt-1">
                                <label class="mt-2 mb-1">Comprobante de consignación</label>
                                <img style="width: 100%;" class="rounded" src="{{ asset('storage/' . $inversion->comprobante_consignacion) }}"
                                alt="consignacion">            
                            </div>                             
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
