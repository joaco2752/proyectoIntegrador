<?php

use App\Http\Controllers\ControladorVistas;
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

Route::get('/Iniciar Sesión', function () {
    return view('Login');
})->name('rutaLogin');



Route::get('/Noti', function () {
    return view('Noticias');
})->name('rutaNoticias');

Route::get('/CrearCuenta', [ControladorVistas::class, 'CrearCuenta'])->name('enviarDonativo');

Route::post('/CrearCuenta', [ControladorVistas::class, 'creartuCuenta'])->name('rutaCrearCuenta');

Route::get('/enviarDonativo', [ControladorVistas::class, 'donativos'])->name('enviarDonativo');

Route::post('/enviarDonativo', [ControladorVistas::class, 'process'])->name('rutaDonar');

Route::get('/enviarInfo', function () {
    return view('nosotros');
})->name('rutaInfo');

Route::post('/enviarInfo', [ControladorVistas::class, 'procesoInfo'])->name('rutaInfo');