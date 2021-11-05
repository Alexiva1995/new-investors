<?php

namespace App\Http\Controllers;

use App\Models\Inversion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
  public function dashboard()
  {
    $ultimosContratos = Inversion::orderBy('id', 'desc')->take(10)->get();
    return view('/content/dashboard/dashboard', compact('ultimosContratos'));
  }
  // Dashboard - Analytics
  public function dashboardAnalytics()
  {
    $pageConfigs = ['pageHeader' => false];

    return view('/content/dashboard/dashboard-analytics', ['pageConfigs' => $pageConfigs]);
  }

  // Dashboard - Ecommerce
  public function dashboardEcommerce()
  {
    $pageConfigs = ['pageHeader' => false];

    return view('/content/dashboard/dashboard-ecommerce', ['pageConfigs' => $pageConfigs]);
  }

  public function agregarFirma(Request $request)
  {
    $request->validate([
      "firma" => "required|mimes:jpg,jpeg,png",
    ]);

    $user = Auth::user();

    if ($request->hasFile('firma')) {
      $file = $request->file('firma');
      $name = time() . $file->getClientOriginalName();
      $ruta = 'firmaAdmin/' . $name;
      
      $file->move(public_path('storage') .'/adminFirma', $name);
      
    }

    return back()->with('msj-success', 'firma agregada exitosamente');
  }

}
