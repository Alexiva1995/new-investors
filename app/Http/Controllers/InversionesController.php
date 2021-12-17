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
use App\Notifications\firmado;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade as PDF;
use App\Notifications\sendform;
use Carbon\Carbon;

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

            $user->notify(new firmado);

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
            //$invertido = ($request->invertido / 3800);
            
            
            $inversion = Inversion::create([
                "invertido" => $request->invertido,
                "usd" => $request->usd,
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
                
                $file->move(public_path('storage') .'/'.$user->id.'/comprobantes/', $name);
                
                $inversion->comprobante_consignacion = $ruta;
                $inversion->save();
            }
            $user->notify(new sendform);
            // Mail::send('Mails.firmadoEmail', ['user' => $user], function($message) use ($user) {
            //     $message->subject('Firma Exitosa');
            //     $message->to($user->email);
            // });
            
            DB::commit();

            return redirect()->route('contratos.index');
        
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('InversionesController - store -> Error: '.$th);
            abort(403);
        }
        // return back();
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
        
        $user = User::find($inversor->user_id);
        $user->notify(new firmado($inversor));

        $inv = Inversion::where('status', '<>', 'finalizado')->get();
        return view('contratos.firmados', compact('inv'))->with('msj-success', 'La inversión ha sido aprobado exitosamente');
    }

    public function rechazarInversor($id){
        $inversor = Inversion::where('id', $id)->first();
        $inversor->status = 'rechazado';
        $inversor->save();
        
        $msj = "La inversion ha sido rechazada";
        return response()->json(['msj', $msj]);
    }

    public function getImage($id){
        $inv = Inversion::where('id', $id)->first();

        $url_imagen = $inv->comprobante_consignacion;

        return response()->json(['url_imagen' => $url_imagen]);

    }

    public function verInversor($id){
        $inv = Inversion::where('id', $id)->first();

        $data = [
            'invertido' => $inv->invertido,
            'tipo_interes' => $inv->tipo_interes,
            'fecha_consignacion' => $inv->fecha_consignacion,
            'referente' => $inv->referente,
            'periodo_mes' => $inv->periodo_mes,
            'created_at' => $inv->created_at,
            'status' => $inv->status
        ];

        return json_encode($data);
    }

    public function firmados()
    {
        $inv = Inversion::where('status', 'firmado')->get();

        return view('contratos.firmados', compact('inv'));
    }
       public function finalizados()
    {
        
        $inversiones = Inversion::where('status', 'finalizado')->get();
        return view('contratos.finalizados', compact('inversiones'));
    }

        /**
     * Formulario para subir PDF
     *
     */
    public function formPdf(Request $request)
    {
        try{
            $validate = $request->validate([
                'idInversion' => 'required',
                'urlpdf' => ['nullable', 'max:4096']
            ]);
            
            if($validate){      
                $file = $request->urlpdf;
                $nombre = time() . $file->getClientOriginalName();
                $ruta = 'pdf-inversion/' . $request->idinversion . '/' . $nombre;
                $contrato = Inversion::find($request->idinversion);
                $contrato->url_pdf = $ruta;
                $contrato->save();
                $file->storeAs('public/pdf-inversion/'.$request->idinversion, $nombre);
                return redirect()->back()->with('msj-success', 'PDF Guardado Exitosamente');
            }   

        } catch (\Throwable $th) {
            Log::error('InversionesController::formPdf -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function generatePdf($id)
    {
        set_time_limit(300);
        $inversion = Inversion::findOrFail($id);
        //FIRMA DEL ADMIN
        $firmaAdmin = asset('storage/adminFirma/'.collect(\File::allFiles(public_path('storage/adminFirma/')))->reverse()->first()->getRelativePathname());
        
        /////
        $pdf = PDF::loadView('pdf.contrato', compact('inversion', 'firmaAdmin'));

        $pdf->setPaper('A4', 'portrait');
        
        //$html = $pdf->stream();
        $html = $pdf->download('contrato-'. Carbon::now()->format('d/m/Y').'.pdf');

        return $html;
    }  
}
