<div 
    class="modal fade bd-example-modal-lg" 
    id="modalContrato" 
    tabindex="-1" 
    role="dialog"
    aria-labelledby="myLargeModalLabel" 
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Datos del contrato</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row match-height d-flex justify-content-center">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="row">
                                            @include('inversores.component.datosContrato')
                                            <br>
                                            @include('inversores.component.datosCliente')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Regresar</button>
            </div>
        </div>
    </div>
</div>
