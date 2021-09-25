<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inversion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\InversionCreateRequest;

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
                $contrato->firma_cliente = $request->imagen64;
                $contrato->status = "firma_cliente";
            } else {
                $contrato->firma_admin = $request->imagen64;
            }

            if ($contrato->firma_cliente != null && $contrato->firma_admin != null) {
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

        // dd($request->imagen64);
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
                "direccion_residencia"  =>  $request->direccion_residencia,
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
                    "firma_cliente" => base64_encode($request->imagen64),                    
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
                    
                    $inversion->comprobante_consignacion = $ruta;
                    $inversion->save();
                }
                if($inversion){
                    DB::commit();
                    return redirect()->route('login')->withSuccess(['La inversión se ha registrado exitosamente!']);

                    // return response()->json([
                    //     'message' => 'Inversión registrada exitosamente',
                    //     'success' => true
        
                    // ], 200);
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
        $inversiones = Inversion::where('status', '<>', 'firmado')->orderBy('id', 'desc')->get();

        return view('inversores.index', compact('inversiones'));
    }

    public function getInversor($id)
    {
        $inversor = Inversion::where('id', $id)->get();

        return $inversor;

        // return view('inversores.index', compact('inversor'));
    }

    public function editInversor($id){
        $inversor = Inversion::where('id', $id)->first();
        $inversor->status = 'firmado';
        $inversor->save();

        $inv = Inversion::where('status', '<>', 'finalizado')->get();
        return view('contratos.firmados', compact('inv'));
    }

    public function rechazarInversor($id){
        $inversor = Inversion::where('id', $id)->first();
        $inversor->status = 'rechazado';
        $inversor->save();

        $inversiones = Inversion::where('status', '<>', 'firmado')->orderBy('id', 'desc')->get();
        return view('inversores.index', compact('inversiones'));
    }

    public function firmados()
    {
        $inv = Inversion::where('status', '<>', 'finalizado')->get();

        return view('contratos.firmados', compact('inv'));
    }

}
