<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('rutaWelcome');


Route::get('/inicio', function () {
    return view('inicio');
})->name('Inicio');

Route::get('/donar', function () {
    return view('donativos');
});