<?php

use App\Http\Controllers\ControladorVistas;
use App\Http\Controllers\donativoController;
use App\Http\Controllers\crearcuentaController;
use App\Http\Controllers\nosotrosController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\consultarController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Http\Controllers\Api\NewsController;

// Página de inicio
Route::get('/', function () {
    return view('inicio');
})->name('rutaInicio');

// Página de donación (vista simple)
Route::get('/donar', function () {
    return view('donativos');
})->name('rutaDonativos.form');

// Página de información "nosotros"
Route::get('/info', function () {
    return view('nosotros');
})->name('rutaNosotros');

// Página de consulta (vista)
Route::get('/Consulta', function () {
    return view('Consultar');
})->name('rutaConsultas');

// Noticias (API)
Route::get('/Noti', [NewsController::class, 'index'])->name('rutaNoticias');

// Demo
Route::get('/demo', function () {
    return view('demo');
})->name('rutaDemoDesarrollo');

/* Rutas para donativoController */
// Muestra formulario de creación
Route::get('/donativos/create', [donativoController::class, 'create'])->name('rutaDonativos.create');
// Guarda donativo
Route::post('/donativos', [donativoController::class, 'store'])->name('rutaDonativos.store');
// Lista donativos
Route::get('/donativos', [donativoController::class, 'index'])->name('rutaDonativos.index');

// Rutas para crear cuenta
Route::get('/crear_cuenta/create', [crearcuentaController::class, 'create'])->name('rutaCrear.create');
Route::post('/CrearCuenta', [crearcuentaController::class, 'store'])->name('rutaCrear.store');
Route::get('/CrearCuenta', [crearcuentaController::class, 'index'])->name('rutaCrear.index');

// Rutas para nosotros (información)
Route::get('/nosotros/create', [nosotrosController::class, 'create'])->name('rutaInfo.create');
Route::post('/nosotros/create', [nosotrosController::class, 'store'])->name('rutaInfo.store');
Route::get('/nosotros', [nosotrosController::class, 'index'])->name('rutaInfo.index');

// Rutas para login
Route::get('/login/create', [loginController::class, 'create'])->name('rutaLogin.create');
Route::post('/Login', [loginController::class, 'store'])->name('rutaLogin.store');
Route::get('/Login', [loginController::class, 'index'])->name('rutaLogin.index');
Route::get('/logout', [loginController::class, 'logout'])->name('rutaLogout');

// Rutas para consultas
Route::get('/Consultar', [consultarController::class, 'index'])->name('rutaConsultar.index');
Route::get('/Consultar/{id}/edit',[consultarController::class, 'edit'])->name('rutaConsultar.edit');
Route::put('/Consultar/{id}', [consultarController::class, 'update'])->name('rutaConsultar.update');
Route::delete('/Consultar/{id}', [consultarController::class, 'destroy'])->name('rutaConsultar.destroy');

// Ruta para componentes
Route::view('/component', 'componentes')->name('rutaComponent');

// Rutas para Stripe (donación)
// Ruta para mostrar el formulario de donación (puede ser la misma vista de /donar, si se requiere)
Route::get('/donar', function () {
    return view('donativos');
})->name('rutaDonativos.form2');

// Ruta para manejar el pago con Stripe
Route::post('/checkout', function (Request $request) {
    Stripe::setApiKey(env('STRIPE_SECRET'));
    $session = Session::create([
        'payment_method_types' => ['card'],
        'mode' => 'payment',
        'line_items' => [[
            'price_data' => [
                'currency' => 'mxn',
                'product_data' => [
                    'name' => 'Donación',
                ],
                'unit_amount' => $request->amount * 100,
            ],
            'quantity' => 1,
        ]],
        'success_url' => url('/gracias'),
        'cancel_url' => url('/cancelado'),
    ]);
    return redirect($session->url);
})->name('rutaCheckout');

// Página de agradecimiento
Route::get('/gracias', function () {
    return view('gracias');
})->name('rutaGracias');

// Página de cancelación
Route::get('/cancelado', function () {
    return view('cancelado');
})->name('rutaCancelado');
