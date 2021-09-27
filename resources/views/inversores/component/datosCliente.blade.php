    <h2 class="my-1 mt-4 font-bold col-12 text-center">Datos del usuario</h2>
    <div class="col-6">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" readonly class="form-control" value="{{ $inversion->getUser->fullname }}">
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>Email</label>
            <input type="text" readonly class="form-control" value="{{ $inversion->getUser->email }}">
        </div>
    </div>
    <div class="col-6 mt-1">
        <div class="form-group">
            <label>Telefono</label>
            <input type="text" readonly class="form-control" value="{{ $inversion->getUser->celular }}">
        </div>
    </div>
    <div class="col-6 mt-1">
        <div class="form-group">
            <label>Tipo de documento</label>
            <input type="text" readonly class="form-control"
                value="{{ preg_replace('/[\_\" "]+/', ' ', $inversion->getUser->tipo_documento) }}">
        </div>
    </div>
    <div class="col-6 mt-1">
        <div class="form-group">
            <label>Numero de documento</label>
            <input type="text" readonly class="form-control" value="{{ number_format($inversion->getUser->num_documento,0,",",".") }}">
        </div>
    </div>
    <div class="col-6 mt-1">
        <div class="form-group">
            <label>Ciudad de residencia</label>
            <input type="text" readonly class="form-control" value="{{ $inversion->getUser->ciudad_residencia }}">
        </div>
    </div>
    <div class="col-6 mt-1">
        <div class="form-group">
            <label>Dirección de residencia</label>
            <input type="text" readonly class="form-control"
                value="{{ $inversion->getUser->direccion_residencia }}">
        </div>
    </div>
    <div class="col-6 mt-1">
        <div class="form-group">
            <label>Banco</label>
            <input type="text" readonly class="form-control" value="{{ $inversion->getUser->banco }}">
        </div>
    </div>
    <div class="col-6 mt-1">
        <div class="form-group">
            <label>Tipo de cuenta</label>
            <input type="text" readonly class="form-control" value="{{ $inversion->getUser->tipo_cuenta }}">
        </div>
    </div>
    <div class="col-6 mt-1">
        <div class="form-group">
            <label>Numero de cuenta</label>
            <input type="text" readonly class="form-control" value="{{ $inversion->getUser->num_cuenta }}">
        </div>
    </div>
