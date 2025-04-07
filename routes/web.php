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
// Ruta para mostrar el formulario de creación de donativo
Route::get('/donativos/create', [donativoController::class, 'create'])->name('rutaDonativos.create');
// Ruta para guardar donativo
Route::post('/donativos', [donativoController::class, 'store'])->name('rutaDonar');
// Ruta para listar donativos
Route::get('/donativos', [donativoController::class, 'index'])->name('enviarDonativo');

/* Rutas para crear cuenta */
Route::get('/crear_cuenta/create', [crearcuentaController::class, 'create'])->name('rutaCrear');
Route::post('/CrearCuenta', [crearcuentaController::class, 'store'])->name('rutaCrearCuenta');
Route::get('/CrearCuenta', [crearcuentaController::class, 'index'])->name('rutaCrear');

/* Rutas para nosotros */
Route::get('/nosotros/create', [nosotrosController::class, 'create'])->name('rutaInfo');
Route::post('/nosotros/create', [nosotrosController::class, 'store'])->name('rutaInfoStore');
Route::get('/nosotros', [nosotrosController::class, 'index'])->name('enviarInfo');

/* Rutas para login */
Route::get('/login/create', [loginController::class, 'create'])->name('rutaLogin');
Route::post('/Login', [loginController::class, 'store'])->name('rutaLoginStore');
Route::get('/Login', [loginController::class, 'index'])->name('rutaLog');
Route::get('/logout', [loginController::class, 'logout'])->name('rutaLogout');

/* Rutas para consultas */
Route::get('/Consultar', [consultarController::class, 'index'])->name('rutaConsultar');
Route::get('/Consultar/{id}/edit', [consultarController::class, 'edit'])->name('rutaFormConsulta');
Route::put('/Consultar/{id}', [consultarController::class, 'update'])->name('rutaActualizar');
Route::delete('/Consultar/{id}', [consultarController::class, 'destroy'])->name('rutaEliminar');

/* Ruta para componentes */
Route::view('/component', 'componentes')->name('rutacomponent');

/* Stripe */
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
