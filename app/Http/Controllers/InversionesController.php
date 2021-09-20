<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InversionCreateRequest;
use App\Models\User;
use App\Models\Inversion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class InversionesController extends Controller
{
    
    public function create()
    {
    
        
      return view('/inversiones/create');
    }

    public function store(InversionCreateRequest $request)
    {
        $request->password = bcrypt($request->password);
        $request->merge([
            'password' => bcrypt($request->password)
        ]);
    
        $user = User::create($request->all());

        $user->notify(new \App\Notifications\sendform);

        if($request->hasFile('comprobante_consignacion')){

            $file = $request->file('comprobante_consignacion');
            $name = time().$file->getClientOriginalName();
            $ruta = $user->id .'/comprobantes/'.$name;

            Storage::disk('public')->put($ruta,  \File::get($file));
        
            $request->merge([
                'comprobante_consignacion' => $name
            ]);
        }  

        $request->merge([
            'user_id' => $user->id
        ]);
        
        Inversion::create($request->all());

        return back();

        
    }

    public function inversores()
    {
        $users = User::orderBy('id', 'desc')->get();

        return view('inversores.index', compact('users'));
    }


    public function firmados()
    {
        // $users = User::orderBy('id', 'desc')->get();

        $inv = Inversion::all();

        return view('contratos.firmados', compact('inv'));
    }


    
    public function dropZoneStore(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName(). '.'.$image->extension();
        $ruta = $request->user .'/pdf/'.$imageName;
        Storage::disk('public')->put($ruta,  \File::get($image));

        return response()->json([
            'success' => $imageName
        ]);
    }
}
