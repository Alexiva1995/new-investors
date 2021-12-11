@extends('layouts/contentLayoutMaster')

@section('content')

 <!-- Basic Tables start -->
 <div id="record">
        <div class="col-12">
      	  <div class="card"> 
        	 <div class="card-content clas">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
        				<h1>Contratos Finalizados</h1>
          			    <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped w-100">

					            <thead>
					              <tr>
					                <th>Id</th>
					                <th>Nombre</th>
					                <th>Invertido</th>
					                <th>Correo</th>
					                <th>Fecha</th>
					                <th>Estado</th>
					              </tr>
					            </thead>
					            <tbody>
					              @forelse ($inversiones as $inv)
					                  <tr>
					                    <td>{{$inv->id}}</td>
					                    <td>{{$inv->getUser->fullname}}</td>
					                    <td>{{number_format($inv->invertido, 2)}}</td>
					                    <td>{{$inv->getUser->email}}</td>
					                    <td>{{date('M-d-Y', strtotime($inv->created_at))}}</td>
					                    <td>{{$inv->status}}</td>
					                  </tr>
					                @empty
					                  <tr class="text-center">
					                    <td colspan="7">Sin Contratos finalizados</td>
					                  </tr>
					              @endforelse
		            		 </tbody>
         		     </table>
      			  </div>
     		   </div>
   		   </div>
 	  </div>
  </div>
@endsection
