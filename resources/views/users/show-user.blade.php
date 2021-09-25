@extends('layouts/contentLayoutMaster')

@section('title', 'Información del usuario')

@section('content')

    @include('users.component.datosUser')
    @include('users.component.datosContrato')
    
@endsection

