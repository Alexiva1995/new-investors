<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InversionCreateRequest;
use App\Models\User;
use App\Models\Inversion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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
        try{
            DB::beginTransaction();
            $user = User::create([
                "fullname" => $request->fullname,
                "email" => $request->email,
                "password" => $request->password,
                "state" => "En espera",
                "tipo_documento" => $request->tipo_documento,
                "num_documento" => $request->num_documento,
                "ciudad_residencia" => $request->ciudad_residencia,
                "celular" => $request->celular,
                "banco" => $request->banco,
                "tipo_cuenta" => $request->tipo_cuenta,
                "num_cuenta" => $request->num_cuenta
            ]);

            if($user){
                $inversion = Inversion::create([
                    "invertido" => $request->invertido,
                    "tipo_interes" => $request->tipo_interes,
                    "fecha_consignacion" => $request->fecha_consignacion,
                    "referente" => $request->referente,
                    "doc_cliente_firmado" => $request->doc_cliente_firmado,
                    "periodo_mes" => $request->periodo_mes,
                    "terminos" => $request->terminos,
                    "status" => "firma_cliente",
                    "user_id" => $user->id
                ]);
                if ($request->hasFile('comprobante_consignacion')) {
                    $file = $request->file('comprobante_consignacion');
                    $name = time() . $file->getClientOriginalName();
                    $ruta = $user->id . '/comprobantes/' . $name;
                    
                    Storage::disk('public')->put($ruta,  \File::get($file));

                    $inversion->$request->comprobante_consignacion = $ruta;
                }
                if($inversion){
                    DB::commit();
                    return response()->json([
                        'message' => 'Inversión registrada exitosamente',
                        'success' => true
        
                    ], 200);
                }else{
                    DB::rollback();
                    return response()->json([
                        'message' => 'Error al crear la inversión',
                        'success' => false
                    ], 400);    
                }
            }else{
                DB::rollback();
                return response()->json([
                    'message' => 'Error al crear el usuario',
                    'success' => false
                ], 400);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('InversionesController - firmar -> Error: '.$th);
            return response()->json([
                'message' => 'Error',
                'success' => false
            ], 400);
        }
    
        // $request->password = bcrypt($request->password);
        // $request->merge([
        //     'password' => bcrypt($request->password)
        // ]);

        // $user = User::create($request->all());

        // //$user->notify(new \App\Notifications\sendform);

        // if ($request->hasFile('comprobante_consignacion')) {

        //     $file = $request->file('comprobante_consignacion');
        //     $name = time() . $file->getClientOriginalName();
        //     $ruta = $user->id . '/comprobantes/' . $name;
            
        //     Storage::disk('public')->put($ruta,  \File::get($file));

        //     $request = collect($request->except('comprobante_consignacion'))->merge([
        //         'comprobante_consignacion' => $ruta
        //     ]);


        // }

        // $request = collect($request)->merge([
        //     'user_id' => $user->id
        // ]);

        // Inversion::create($request->all());

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
