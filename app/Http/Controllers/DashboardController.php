<?php

namespace App\Http\Controllers;

use App\Models\Inversion;
use Illuminate\Http\Request;

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
}
