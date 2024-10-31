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

Route::get('/enviarDonativo', [ControladorVistas::class, 'donativos'])->name('enviarDonativo');

Route::post('/enviarDonativo', [ControladorVistas::class, 'process'])->name('rutaDonar');