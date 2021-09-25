<div 
    class="modal fade modal-secondary text-start" 
    id="modalAprobar" 
    tabindex="-1" 
    aria-labelledby="myModalLabel1660"
    aria-hidden="true"
    >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1660">Subir archivo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img style="width: 100%;" src="{{ asset('storage/' . $inversion->comprobante_consignacion) }}"
                    alt="consignacion">
            </div>
            <div class="modal-footer">
                <a href="{{ route('rechazar-inversor',2) }}" type="button" class="btn btn-danger">Rechazar</a>
                <a href="{{ route('edit-inversor',2) }}" type="button" class="btn btn-success">Aprobar</a>
            </div>
        </div>
    </div>
</div>
