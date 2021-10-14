<?php

namespace App\Http\Controllers;

use stdClass;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Inversion;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ContratoController extends Controller
{
    //
    public function index(Request $request)
    {
        /*
        $user = Auth::user();

        if ($user->admin == 1) {
        */
            if (isset($request->tipo_documento) && isset($request->num_documento)) {
                $user = User::where('tipo_documento', $request->tipo_documento)->where('num_documento', $request->num_documento)->first();
                if ($user != null) {
                    $inversiones = $user->inversiones;
                } else {
                    $inversiones = [];
                }
            } else {
                $inversiones = [];
            }
        /*
        } else {
            $inversiones = Inversion::where('user_id', $user->id)->get();
        }
        */
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

    public function reenviarPdf($id)
    {
        try{
            $inversion = Inversion::findOrFail($id);
            $email = $inversion->getUser->email;

            $dompdf = PDF::loadView('pdf.contrato', compact('inversion'));

            $dataEmail = [
                'nombre' =>  strtok($inversion->getUser->fullname, " "),
                'email' => $email
            ];

            Mail::send('Mails.reenvioContrato', $dataEmail, function ($mail) use ($dompdf, $email) {
                $mail->to($email);
                $mail->subject("Reenvío de contrato");
                $mail->attachData($dompdf->output(), 'contrato.pdf');
            });

            return redirect()->back()->with('msj-success','El PDF se reenvió correctamente');

        } catch (\Throwable $th) {
            Log::error('ContratoController - reenviarPdf -> Error: '.$th);
            abort(403);
        }

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

    /**
     * Método para devolver la información de los gráficos del dashboard
     *
     * @param integer $id
     * @return void
     */
    public function graficoDashboard()
    {
        $data = new stdClass();
        $date = Carbon::now();
        $from = $date->subYear()->format('Y-m-d')." 00:00:00";
        $inversiones = Inversion::all();

        /////INVERSIONES///////
        $invertidoLineal = $inversiones->where('tipo_interes', 'lineal')->sum('invertido');
        $invertidocompuesto = $inversiones->where('tipo_interes', 'compuesto')->sum('invertido');
        $invertidoTotal = $invertidoLineal + $invertidocompuesto;

        /////INVERSION DIVIDIDO POR 12 MESES Y POR LINEAL/COMPUESTO///////
        $linealMeses = [ 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ];
        $compuestoMeses = [ 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ];
        $inversionMes = Inversion::select(
            DB::raw("DATE_FORMAT(created_at,'%m') as mes"),
            DB::raw('sum(case when tipo_interes = "lineal" then invertido end) as lineal'), 
            DB::raw('sum(case when tipo_interes = "compuesto" then invertido end) as compuesto'),     
            )
            ->groupBy('mes')
            ->whereDate('created_at', '>=', $from)
            ->get();
        foreach($inversionMes as $registro) {
            /* Rellenamos el mes adecuado de la matriz */
            if($registro->lineal == null){
                $registro->lineal = 0; 
            }
            if($registro->compuesto == null){
                $registro->compuesto = 0; 
            }
            $linealMeses[intval($registro->mes) - 1] = intval($registro->lineal);
            $compuestoMeses[intval($registro->mes) - 1] = intval($registro->compuesto);
        }

        ///// NÚMERO DE INVERSIONES POR MES ///////
        $countContratosMeses = [ 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ];
        $contratosMeses = Inversion::select(
            DB::raw("DATE_FORMAT(created_at,'%m') as mes"),
            DB::raw('count(*) as contratos'),
            )
            ->groupBy('mes')
            ->whereDate('created_at', '>=', $from)
            ->get();

            foreach($contratosMeses as $registro) {
                $countContratosMeses[intval($registro->mes) - 1] = intval($registro->contratos);
            }

        $data->countContratos = count($inversiones);
        $data->countContratosMeses = $countContratosMeses;
        $data->invertidoLineal = $invertidoLineal;
        $data->invertidocompuesto = $invertidocompuesto;
        $data->invertidoTotal = $invertidoTotal;
        $data->linealMeses = $linealMeses;
        $data->compuestoMeses = $compuestoMeses;

        return response()->json($data);

    }
}
