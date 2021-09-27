
@extends('layouts/contentLayoutMaster')


@section('title', 'Lista de Usuarios')

@section('content')
<!-- Basic Tables start -->
<div id="record">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <p> <img src="{{asset('assets/img/sistema/btn-plus.png')}}" alt=""></p>
                        <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped w-100">
                            
                            <thead class="">
                                <tr class="text-center text-dark bg-purple-alt2">
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($user as $item)
                                   <tr class="text-center">
                                        <td>{{ $item->id}}</td>
                                        <td>{{ $item->fullname}}</td>
                                        <td>{{ $item->email}}</td>
                                   
                                        <td>
                                            @if($item->id != 1)
                                                <a href="{{ route('users.show-user',$item->id) }}" class="btn text-bold-600" style="background-color: rgba(0, 194, 239, 1)"><i class="fas fa-eye text-white"></i>
                                            @endif
                                        </td>
                                    </tr>                                                                   
                                @endforeach                                            
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection

{{-- CONFIGURACIÓN DE DATATABLE --}}
{{-- @include('panels.datatables-config') --}}
