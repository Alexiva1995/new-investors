<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InversionCreateRequest;
use App\Models\User;
use App\Models\Inversion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Contrato;

class InversionesController extends Controller
{
    
    public function create()
    {
    
      return view('/inversiones/create');
    }

    public function firmar(Request $request)
    {
        $img = str_replace('data:image/png;base64,', '', $request->imagen64);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        //return $request->imagen64;
        $user =  Auth::user();

        if ($user->admin == 1) {
            $name = "firma_administrador.png";
            $firmante = "admin";
        } else {
            $name = "firma_cliente.png";
            $firmante = "cliente";
        }

        $ruta = $user->id . '/' . $request->inversion_id . '/' . $name;

        if (Storage::disk('public')->put($ruta,  $data)) {

            $contrato = Contrato::where('inversion_id', $request->inversion_id)->first();

           

            if ($contrato == null) {
                $contrato = new Contrato();
                $contrato->inversion_id = $request->inversion_id;
            }

            if ($firmante == "cliente") {
                $contrato->doc_cliente_firmado = $ruta;
                $contrato->status = "firma_cliente";
            } else {
                $contrato->doc_admin_firmado = $ruta;
            }

            if ($contrato->doc_cliente_firmado != null && $contrato->doc_admin_firmado != null) {
                $contrato->status = "firmado";
               
               
            }
            $contrato->save();
            
            $user->notify(new \App\Notifications\firmado);
            
            return response()->json([
                'message' => 'Firma digital registrada exitosamente',
                'success' => true
                
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error',
                'success' => false
            ], 400);
        }
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
