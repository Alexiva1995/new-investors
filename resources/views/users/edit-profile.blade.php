@extends('layouts/contentLayoutMaster')
@section('title', 'Perfil')

@push('custom_js')


<script src="{{asset('assets/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{asset('assets/app-assets/js/core/app.js')}}"></script>
<script src="{{asset('assets/app-assets/js/scripts/components.js')}}"></script>
@endpush


@section('content')

<style>
    /* #background {
        background: #0F1522;
        border-radius: 8px;
        max-height: 380px;
    }

    .list-group-item {
        border: 2px solid rgba(0, 246, 225, 0.77);
        box-sizing: border-box;
        background: #0F1522;
        border-radius: 1px;
        color: #FFFFFF;

    }

    #background2 {
        background: #0F1522;
        border-radius: 8px;
    } */
    /* .custom-file {
        position: relative;
        display: inline-block;
        width: 100%;
        height: calc( 1.25em + 1.4rem + 1px);
        margin-bottom: 0;
    }
    .custom-file-input  required{
        position: relative;
        z-index: 2;
        width: 100%;
        height: calc( 1.25em + 1.4rem + 1px);
        margin: 0;
        opacity: 0;
    } */
</style>


<div class="row match-height d-flex justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="form-body">
                        <form action="{{ route('profile.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row"> 

                                <div class="mb-2 d-flex justify-content-center mt-2">
                                    <div>
                                        <img id="photo_preview2" class=" " class="rounded img-fluid"/>
                                        <h1 class="text-center">Imagen de perfil</h1>
                                    </div>
                                </div>   

                                {{-- Nombre --}}
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="required" id="form-label" for="">Nombre<span style="color: red;"> *</span></label>
                                        <input type="text" class="form-control @error('fullname') is-invalid @enderror" id="fullname" name="fullname" placeholder="Nombre" value="{{ $user->fullname }}">
                                    </div>
                                    @error('fullname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                {{-- Correo --}}
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="required" id="form-label" for="email">Correo Electrónico<span style="color: red;"> *</span></label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Nombre" value="{{ $user->email }}">
                                    </div>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                    
                                </div>
                                
                                {{-- Telefono --}}
                                <div class="col-6 mt-1">
                                    <div class="form-group">
                                        <label class="required" id="form-label" for="celular">Telefono<span style="color: red;"> *</span></label>
                                        <input type="text" class="form-control @error('celular') is-invalid @enderror" id="celular" name="celular" placeholder="Nombre" value="{{ $user->celular }}">
                                    </div>
                                    @error('celular')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                    
                                </div>

                                {{-- Tipo de documento --}}
                                <div class="col-6 mt-1">
                                    <div class="form-group">
                                        <label class="required" id="form-label" for="tipo_documento">Tipo de documento<span style="color: red;"> *</span></label>
                                        <select class="form-select {{ $errors->has('tipo_documento') ? ' is-invalid' : '' }}" id="tipo_documento" required name="tipo_documento">
                                            <option value="{{$user->tipo_documento}}">{{$user->tipo_documento}}</option>
                                            <option value="cedula_ciudadana">Cédula de ciudadania</option>
                                            <option value="cedula_extranjera">Cédula de Extranjeria</option>
                                            <option value="pasaporte">Pasaporte</option>
                                          </select>
                                          <div class="valid-feedback">valido!</div>
                                          <div class="invalid-feedback">Por favor ingrese el tipo de documento</div>
                                    </div>
                                    @error('tipo_documento')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                    
                                </div>
                                
                                {{-- Numero de documento --}}
                                {{-- <div class="col-6 mt-1">
                                    <div class="form-group">
                                        <label>Numero de documento</label>
                                        <input type="text" class="form-control" value="{{$user->num_documento}}" required>
                                    </div>
                                    @error('num_documento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror                    
                                </div> --}}
                                
                                {{-- Ciudad de residencia --}}
                                {{-- <div class="col-6 mt-1">
                                    <div class="form-group">
                                        <label>Ciudad de residencia</label>
                                        <input type="text" class="form-control" value="{{$user->ciudad_residencia}}">
                                    </div>
                                    @error('ciudad_residencia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror                    
                                </div> --}}

                                {{-- Direccion de residencia --}}
                                {{-- <div class="col-6 mt-1">
                                    <div class="form-group">
                                        <label>Dirección de residencia</label>
                                        <input type="text" class="form-control" value="{{$user->direccion_residencia}}">
                                    </div>
                                    @error('direccion_residencia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror                    
                                </div> --}}

                                {{-- Banco --}}
                                {{-- <div class="col-6 mt-1">
                                    <div class="form-group">
                                        <label>Banco</label>
                                        <select class="form-select {{ $errors->has('banco') ? ' is-invalid' : '' }}" id="banco" required name="banco">
                                            <option value="{{$user->banco}}">{{$user->banco}}</option>
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
                                    </div>
                                    @error('banco')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror                    
                                </div> --}}

                                {{-- Tipo de cuenta --}}
                                {{-- <div class="col-6 mt-1">
                                    <div class="form-group">
                                        <label>Tipo de cuenta</label>
                                        <select class="form-select {{ $errors->has('tipo_cuenta') ? ' is-invalid' : '' }}" id="tipo_cuenta" required name="tipo_cuenta">
                                            <option value="{{$user->tipo_cuenta}}">{{$user->tipo_cuenta}}</option>
                                            <option value="ahorro">AHORROS</option>
                                            <option value="corriente">CORRIENTE</option>
                                          </select>
                                          <div class="valid-feedback">valido!</div>
                                          <div class="invalid-feedback">Por favor ingrese el tipo de cuenta</div>
                                    </div>                                    
                                    @error('tipo_cuenta')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                    
                                </div> --}}

                                {{-- Numero de cuenta --}}
                                {{-- <div class="col-6 mt-1">
                                    <div class="form-group">
                                        <label>Numero de cuenta</label>
                                        <input type="text" class="form-control" value="{{$user->num_cuenta}}" required>
                                    </div>
                                    @error('num_cuenta')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                    
                                </div> --}}

                                {{-- Imagen --}}
                                {{-- <div class="media">
                                    <div class="custom-file mt-1">
                                        <label class="custom-file-label" id="id" for="photoDB">Seleccione su
                                            Foto <b>(Se permiten JPG o PNG.
                                                Tamaño máximo de 800kB)</b></label>
                                        <input type="file" id="photoDB" class="custom-file-input @error('photoDB') is-invalid @enderror" name="photoDB" onchange="previewFile(this, 'photo_preview2')" accept="image/*" >
                                        @error('photoDB')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div> --}}

                                <div class="d-flex justify-content-center my-4 mb-0">
                                    <button class="btn btn-primary w-50">Guardar Cambios</button>
                                </div>
                            </div>
                        </form>
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
                        <h3 class="d-flex justify-content-center mt-2">Cambiar la contraseña</h3>
                        <div class="container">
                            <div class="row justify-content-center">                                
                                <div class="card-body">
                                    <form method="POST" action="{{ route('change.password') }}">
                                        @csrf
                                        @foreach ($errors->all() as $error)
                                            <p class="text-danger">{{ $error }}</p>
                                        @endforeach

                                        <div class="form-group row mt-1">
                                            <label for="password" id="form-label" class="col-md-4 col-form-label text-md-right">
                                                Contraseña Actual</label>
                                            <div class="col-md-8">
                                                <input id="names" type="password" class="form-control" name="current_password required"
                                                    autocomplete="current-password">
                                            </div>
                                        </div>

                                        <div class="form-group row mt-1">
                                            <label id="form-label" for="password" class="col-md-4 col-form-label text-md-right">Nueva
                                                Contraseña</label>
                                            <div class="col-md-8">
                                                <input id="names" type="password" class="form-control" name="new_password" required>
                                            </div>
                                        </div>

                                        <div class="form-group row mt-1">
                                            <label id="form-label" for="password" class="col-md-4 col-form-label text-md-right">Confirme la
                                                Contraseña</label>
                                            <div class="col-md-8">
                                                <input id="names" type="password" class="form-control" name="new_confirm_password required"
                                                    autocomplete="current-password">
                                            </div>
                                        </div>

                                        <div class="form-group row my-4 mb-0  d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary w-50">Actualizar Contraseña</button>
                                        </div>
                                    </form>
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

@section('page-script')
<script>
    $(document).ready(function() {
        @if($user -> photoDB !== NULL)
        previewPersistedFile("{{asset('storage/'.$user->photoDB)}}", 'photo_preview2');
        @endif
    });



    function previewFile(input, preview_id)  required{
        if (input.files && input.files[0])  required{
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#" + preview_id).attr('src', e.target.result);
                $("#" + preview_id).css('height', '200px');
                $("#" + preview_id).parent().parent().removeClass('d-none');
            }
            $("label[for='" + $(input).attr('id') + "']").text(input.files[0].name) required;
            reader.readAsDataURL(input.files[0]) required;
        }
    }

    function previewPersistedFile(url, preview_id) {
        $("#" + preview_id).attr('src', url);
        $("#" + preview_id).css('height', '200px');
        $("#" + preview_id).parent().parent().removeClass('d-none');

    }
</script>
@endsection