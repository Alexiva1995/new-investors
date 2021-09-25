<div class="row match-height d-flex justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="form-body">
                        <div class="row">
                            <h2 class="my-1 font-bold col-12 text-center">Datos del usuario</h2>
                            <div class="col-12 col-md-8">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" readonly class="form-control" value="{{ $user->fullname }}">
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" readonly class="form-control" value="{{$user->email}}">
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mt-1">
                                <div class="form-group">
                                    <label>Telefono</label>
                                    <input type="text" readonly class="form-control" value="{{$user->celular}}">
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mt-1">
                                <div class="form-group">
                                    <label>Tipo de documento</label>
                                    <input type="text" readonly class="form-control" value="{{preg_replace('/[\_\" "]+/', ' ', $user->tipo_documento)}}">
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mt-1">
                                <div class="form-group">
                                    <label>Numero de documento</label>
                                    <input type="text" readonly class="form-control" value="{{$user->num_documento}}">
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mt-1">
                                <div class="form-group">
                                    <label>Ciudad de residencia</label>
                                    <input type="text" readonly class="form-control" value="{{$user->ciudad_residencia}}">
                                </div>
                            </div>
                            <div class="col-12 col-md-8 mt-1">
                                <div class="form-group">
                                    <label>Dirección de residencia</label>
                                    <input type="text" readonly class="form-control" value="{{$user->direccion_residencia}}">
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mt-1">
                                <div class="form-group">
                                    <label>Banco</label>
                                    <input type="text" readonly class="form-control" value="{{$user->banco}}">
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mt-1">
                                <div class="form-group">
                                    <label>Tipo de cuenta</label>
                                    <input type="text" readonly class="form-control" value="{{$user->tipo_cuenta}}">
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mt-1">
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