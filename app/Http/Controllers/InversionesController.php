<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InversionCreateRequest;
use App\Models\User;
use App\Models\Inversion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DB;

class InversionesController extends Controller
{

    public function create()
    {

        return view('/inversiones/create');
    }


    public function firmar(Request $request)
    {
        try{
            DB::beginTransaction();
            $user =  Auth::user();

            if ($user->admin == 1) {
                $name = "firma_administrador.png";
                $firmante = "admin";
            } else {
                $name = "firma_cliente.png";
                $firmante = "cliente";
            }

            $contrato = Inversion::findOrFail($request->inversion_id);
     
            if ($firmante == "cliente") {
                $contrato->doc_cliente_firmado = $request->imagen64;
                $contrato->status = "firma_cliente";
            } else {
                $contrato->doc_admin_firmado = $request->imagen64;
            }

            if ($contrato->doc_cliente_firmado != null && $contrato->doc_admin_firmado != null) {
                $contrato->status = "firmado";
            }
            $contrato->save();

            $user->notify(new \App\Notifications\firmado);

            DB::commit();
            return response()->json([
                'message' => 'Firma digital registrada exitosamente',
                'success' => true

            ], 200);
    
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('InversionesController - firmar -> Error: '.$th);
            return response()->json([
                'message' => 'Error',
                'success' => false
            ], 400);
        }
    }


    public function store(InversionCreateRequest $request)
    {
        dd('El metodo del controlador');
    
        $request->password = bcrypt($request->password);
        $request->merge([
            'password' => bcrypt($request->password)
        ]);

        $user = User::create($request->all());

        //$user->notify(new \App\Notifications\sendform);

        if ($request->hasFile('comprobante_consignacion')) {

            $file = $request->file('comprobante_consignacion');
            $name = time() . $file->getClientOriginalName();
            $ruta = $user->id . '/comprobantes/' . $name;
            
            Storage::disk('public')->put($ruta,  \File::get($file));

            $request = collect($request->except('comprobante_consignacion'))->merge([
                'comprobante_consignacion' => $ruta
            ]);


        }

        $request = collect($request)->merge([
            'user_id' => $user->id
        ]);

        Inversion::create($request->all());

        return back();
    }

    public function inversores()
    {
        $inversiones = Inversion::orderBy('id', 'desc')->get();

        return view('inversores.index', compact('inversiones'));
    }


    public function firmados()
    {
        $inv = Inversion::where('status', '<>', 'finalizado')->get();

        return view('contratos.firmados', compact('inv'));
    }

}
