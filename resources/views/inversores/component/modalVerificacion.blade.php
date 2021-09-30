<div 
    class="modal fade modal-secondary text-start" 
    id="modalVerificacion" 
    tabindex="-1" 
    aria-labelledby="myModalLabel1660"
    aria-hidden="true"
    >
    <div class="modal-dialog modal-dialog-c entered">
        <div class="modal-content">
            <input type="hidden" id="idVerificacion">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1660">Subir archivo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- src="{{ asset('storage/10/comprobantes/1632585581avatar.jpg' ) }}" --}}
                <img id="imagen_url" style="width: 100%;" src=""
                    alt="consignacion">
            </div>
            <div class="modal-footer">
                {{-- <a href="{{ route('rechazar-inversor',2) }}" type="button" class="btn btn-danger">Rechazar</a> --}}
                <a href="#" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</a>
                <a href="javascript:void(0)"  onclick="aprobar()" type="button" class="btn" style="color:white; background-color: #00c2ef;">Aprobar</a>
            </div>
        </div>
    </div>
</div>
