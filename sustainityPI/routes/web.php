<?php

use App\Http\Controllers\ControladorVistas;
use App\Http\Controllers\donativoController;
use App\Http\Controllers\crearcuentaController;
use App\Http\Controllers\nosotrosController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\consultarController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('inicio');
})->name('rutaInicio');

Route::get('/donar', function () {
    return view('donativos');
})->name('rutaDonativos');

Route::get('/info', function () {
    return view('nosotros');
})->name('rutaNosotros');

Route::get('/Consulta', function () {
    return view('Consultar');
})->name('rutaConsultas');

Route::get('/Noti', function () {
    return view('Noticias');
})->name('rutaNoticias');

Route::get('/demo', function () {
    return view('demo');
})->name('rutaDemoDesarrollo');

/* Route::get('/Login', [ControladorVistas::class, 'login'])->name('rutaLogin');

Route::post('/Login', [ControladorVistas::class, 'iniciasesion'])->name('rutalogin'); */



/* Route::get('/CrearCuenta', [ControladorVistas::class, 'CrearCuenta'])->name('rutaCrear');

Route::post('/CrearCuenta', [ControladorVistas::class, 'creartuCuenta'])->name('rutaCrearCuenta'); */

/* Route::get('/enviarDonativo', [ControladorVistas::class, 'donativos'])->name('enviarDonativo'); */

/* Route::post('/enviarDonativo', [ControladorVistas::class, 'process'])->name('rutaDonar'); */

/* Route::get('/enviarInfo', function () {
    return view('nosotros');
})->name('rutaInfo'); */

/* Route::post('/enviarInfo', [ControladorVistas::class, 'procesoInfo'])->name('rutaInfo'); */

/* Rutas para donativoController */
Route::get('/donativos/create', [donativoController::class, 'create'])->name('rutaDonativos');
Route::post('/donativos', [donativoController::class, 'store'])->name('rutaDonar');
Route::get('/donativos', [donativoController::class, 'index'])->name('enviarDonativo');

Route::get('/crear_cuenta/create', [crearcuentaController::class, 'create'])->name('rutaCrear');
Route::post('/CrearCuenta', [crearcuentaController::class, 'store'])->name('rutaCrearCuenta');
Route::get('/CrearCuenta', [crearcuentaController::class, 'index'])->name('rutaCrear');

Route::get('/nosotros/create', [nosotrosController::class, 'create'])->name('rutaInfo');
Route::post('/nosotros/create', [nosotrosController::class, 'store'])->name('rutaInfo');
Route::get('/nosotros', [nosotrosController::class, 'index'])->name('enviarInfo');

Route::get('/login/create', [loginController::class, 'create'])->name('rutaLogin');
Route::post('/Login', [loginController::class, 'store'])->name('rutaLogin');
Route::get('/Login', [loginController::class, 'index'])->name('rutaLog');

Route::get('/Consultar', [consultarController::class, 'index'])->name('rutaConsultar');
Route::get('/Consultar/{id}/edit',[consultarController::class,'edit'])->name('rutaFormConsulta');
Route::put('/Consultar/{id}', [consultarController::class, 'update'])->name('rutaActualizar');
Route::delete('/Consultar/{id}', [consultarController::class, 'destroy'])->name('rutaEliminar');

Route::view('/component','componentes')->name('rutacomponent');

