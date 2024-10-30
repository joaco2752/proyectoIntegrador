<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('rutaWelcome');

Route::get('/about', function () {
    return view('about');
})->name('inicio');

Route::get('/inicio', function () {
    return view('inicio');
})->name('Inicio');