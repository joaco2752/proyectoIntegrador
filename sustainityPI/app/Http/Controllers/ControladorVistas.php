<?php

namespace App\Http\Controllers;

use App\Http\Requests\validadorCrear;
use App\Http\Requests\validadorDonativo;
use App\Http\Requests\validadorInfo;
use App\Http\Requests\validadorLogin;
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

    public function crearCuenta()
    {
        return view('CrearCuenta');
    }

    public function login()
    {
        return view('Login');
    }

    public function process(validadorDonativo $request)
    {
        return to_route('rutaDonar')->with('message', 'Gracias por tu donación de $' . $request->amount . '!');
    }

    public function procesoInfo(validadorInfo $request)
    {
        return to_route('rutaInfo')->with('message', 'Te mandaremos más información a tu correo: ' . $request->email . '!');
    }

    public function creartuCuenta(validadorCrear $request)
    {
    return to_route('rutaCrearCuenta')->with('message', 'Cuenta creada exitosamente.');
    }

    public function iniciasesion(validadorLogin $request)
    {
    return to_route('rutaInicio')->with('message', 'Inicio de Sesion Exitoso.');
    }

}

