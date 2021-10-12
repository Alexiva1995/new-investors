<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppsController;
use App\Http\Controllers\UserInterfaceController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\ComponentsController;
use App\Http\Controllers\ExtensionController;
use App\Http\Controllers\PageLayoutController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\MiscellaneousController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\InversionesController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/clear', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('route:clear');
    // Mail::send('correo.subcripcion', ['data' => []], function ($correo2)
    //     {
    //         $correo2->subject('Limpio el sistema');
    //         $correo2->to('cgonzalez.byob@gmail.com');
    //     });
    return 'DONE'; //Return anything
});
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return 'DONE'; //Return anything
});
Route::get('/storage-link', function() {
    $exitCode = Artisan::call('storage:link');
    return 'DONE'; //Return anything
});
// Main Page Route
// Route::get('/', [DashboardController::class,'dashboardEcommerce'])->name('dashboard-ecommerce')->middleware('verified');
Route::middleware(['auth', 'admin'])->group(function () {
    //TEST
    Route::get('/test',function(){
        return view('test/create');
    });
});
Route::get('/',[InversionesController::class, 'create'])->name('home');

//DASHBOARD ADMIN
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware(['auth']);

//DASHBOARDS DE PRUEBA DE LA PLANTILLA 
Route::get('/dashboard-prueba', [DashboardController::class, 'dashboardAnalytics'])->name('dashboard.prueba');
Route::get('/dashboard-prueba2', [DashboardController::class, 'dashboardEcommerce'])->name('dashboard.prueba2');

//INVERSIONES
Route::group(['prefix' => 'inversiones'], function () {
    Route::get('/create', [InversionesController::class, 'create'])->name('inversiones.create');
    Route::post('/store', [InversionesController::class, 'store'])->name('inversiones.store');


    //CONTRATOS
    Route::group(['prefix' => 'contratos'], function () {
        Route::get('/', [ContratoController::class, 'index'])->name('contratos.index');
        Route::get('/download_pdf/{id}', [ContratoController::class, 'download_pdf'])->name('contratos.download_pdf');
        Route::get('/reenviar_pdf/{id}', [ContratoController::class, 'reenviarPdf'])->name('contratos.reenviar_pdf');
        Route::get('/firmar', [ContratoController::class, 'firmar'])->name('contratos.firmar');
        Route::get('/firmaInversor', [ContratoController::class, 'firmaInversor'])->name('contratos.firmaInversor');
        Route::post('/finalizar', [ContratoController::class, 'finalizar'])->name('contratos.finalizar');
    });
    //rutas para la lista de usuarios
    Route::prefix('user')->group(function () {
        Route::get('/list-user', [UserController::class, 'listUser'])->name('users.list-user');
        Route::get('show-user/{id}', [UserController::class, 'showUser'])->name('users.show-user');
        Route::get('profile', [UserController::class, 'editProfile'])->name('profile');
        Route::patch('profile-update', [UserController::class, 'updateProfile'])->name('profile.update');


        Route::post('change-password', [ChangePasswordController::class, 'store'])->name('change.password');
        Route::get('change-password', [ChangePasswordController::class, 'change-password'])->name('profile.change-password');
    });

    Route::get('inversores', [InversionesController::class, 'inversores'])->name('inversores');
    Route::get('getImage/{id}', [InversionesController::class, 'getImage'])->name('getImage');
    Route::get('aprobar-inversor/{id}', [InversionesController::class, 'editInversor'])->name('edit-inversor');
    Route::get('rechazar-Inversor/{id}', [InversionesController::class, 'rechazarInversor'])->name('rechazar-inversor');
    Route::get('ver-inversor/{id}', [InversionesController::class, 'verInversor'])->name('ver-inversor');
    Route::get('firmados', [InversionesController::class, 'firmados'])->name('firmados');
    Route::get('finalizados', [InversionesController::class, 'finalizados'])->name('finalizados');

    Route::post('/form-pdf', [InversionesController::class, 'formPdf'])->name('inversion.pdf');
    Route::get('/generatePdf/{id}', [InversionesController::class, 'generatePdf'])->name('inversion.generatePdf');


});
Auth::routes(['verify' => true]);


// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);