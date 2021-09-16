@extends('layouts/fullLayoutMaster')

@section('title', 'Login | The New Investors')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">

<style>
  .titulo{
    font-size: 2rem;
    font-style: normal;
    font-weight: 100;
}

.subtitulo{
    font-size: 1rem;
}

.imagen{
  width: 100px;
  height: 100px;
}

.auth-wrapper{
  background-image: url("../../images/bg-login.png");
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
.btn-ingresar{
  background-color: rgba(0, 194, 239, 1);
  color: white;
}

.card-body{
  background-color: rgba(0, 0, 0, 0.75);
}

.form-label{
  font-size: 1rem;
}

</style>
@endsection

@section('content')
<div class="auth-wrapper auth-v1 px-2">
  <div class="auth-inner py-2">
    <!-- Login v1 -->
    <div class="card mb-0">
      <div class="card-body">
        <form class="auth-login-form mt-2" method="POST" action="{{ route('login') }}">
          @csrf
          <div class="d-flex justify-content-center">
            <img  class="imagen" src="{{asset('/images/logo1.png')}}" alt="">
          </div>
          <div class="mt-4 mb-3">
            <p class="titulo text-left text-white">{{ __('Iniciar Sesión') }}</p>
            {{-- <p class="subtitulo text-left ">Inicie sesion en su cuenta para empezar</p> --}}
          </div>

          <div class="my-2">
            <label for="login-email" class="form-label text-white">Correo Electronico</label>
            <input
              type="text"
              class="form-control @error('email') is-invalid @enderror"
              id="login-email"
              name="email"
              placeholder="Ingrese su correo electronico"
              aria-describedby="login-email"
              tabindex="1"
              autofocus
              value="{{ old('email') }}"
            />
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="my-2 mb-4">
            <div class="d-flex justify-content-between">
              <label class="form-label text-white" for="login-password">Contraseña</label>
              {{-- @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}">
                <small>Forgot Password?</small>
              </a>
              @endif --}}
            </div>
            <div class="input-group input-group-merge form-password-toggle">
              <input
                type="password"
                class="form-control form-control-merge"
                id="login-password"
                name="password"
                tabindex="2"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                aria-describedby="login-password"
              />
              <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
          </div>
          <button type="submit" class="btn btn-ingresar w-100 mb-4" tabindex="4">Ingresar</button>
        </form>
      </div>
    </div>
    <!-- /Login v1 -->
  </div>
</div>
@endsection
