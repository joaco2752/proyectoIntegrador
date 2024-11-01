<?php

namespace App\Http\Controllers;

use App\Http\Requests\validadorDonativo;
use Illuminate\Http\Request;

class ControladorVistas extends Controller
{
    public function inicio()
    {
        return view('inicio');
    }


    public function donativos()
    {
        return view('donativos');
    }

    public function nosotros()
    {
        return view('nosotros');
    }


    public function process(validadorDonativo $request)
    {
        return to_route('rutaDonar')->with('message', 'Gracias por tu donativo $' . $request->amount . '!');
    }
}

