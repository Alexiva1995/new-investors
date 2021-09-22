<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Inversion;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ContratoController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->admin == 1) {
            if (isset($request->tipo_documento) && isset($request->num_documento)) {
                $user = User::where('tipo_documento', $request->tipo_documento)->where('num_documento', $request->num_documento)->first();
                if ($user != null) {
                    $inversiones = $user->inversiones;
                } else {
                    $inversiones = [];
                }
            } else {
                $inversiones = Inversion::all();
            }
        } else {
            $inversiones = Inversion::where('user_id', $user->id)->get();
        }

        return view('contratos.index', compact('inversiones'));
    }

    public function download_pdf($id)
    {
        $inversion = Inversion::findOrFail($id);

        $pdf = PDF::loadView('pdf.contrato', compact('inversion'));

        $pdf->getDomPDF()->set_option("enable_php", true);
        //$pdf->setPaper('A4', 'landscape');

        $html = $pdf->stream();
        //$html = $pdf->download('reporte-socios-'. Carbon::now()->format('d/m/Y').'.pdf');

        return $html;
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
            Log::error('ContratoController - firmar -> Error: '.$th);
            return response()->json([
                'message' => 'Error',
                'success' => false
            ], 400);
        }
    }

    public function firmaInversor()
    {
        
        $inversiones = Inversion::all();
        return view('contratos.FirmaInversor', compact('inversiones'));
    }

    public function finalizar(Request $request)
    {
        try{
            $validate = $request->validate([
                'contratoId' => 'required',
            ]);

            if ($validate) {
                $contrato = Inversion::findOrFail($request->contratoId);
                $contrato->status = 'finalizado';
                $contrato->save();

                return response()->json(true);
            }
        } catch (\Throwable $th) {
            Log::error('SolicitudController - solicitar -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }
}
