<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Requests\validadorLogin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class loginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultaCuentas = DB::table('usuarios')->get();
        return view('login', compact('consultaCuentas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(validadorLogin $request)
    {
        // Validar que las credenciales sean correctas
        $usuario = DB::table('usuarios')->where('email', $request->email)->first();

        // Verificar si el usuario existe y si la contraseña es correcta
        if ($usuario && Hash::check($request->contraseña, $usuario->contraseña)) {
            // Iniciar sesión
            Auth::loginUsingId($usuario->id);

            // Guardar una variable de sesión que indique que el usuario está logueado
        session(['logged_in' => true]);

            // Redirigir al dashboard o página principal
            return redirect()->route('rutaInicio')->with('message', 'Inicio de sesión exitoso');
        } else {
            // Si las credenciales no son correctas
            return back()->withErrors(['email' => 'Las credenciales son incorrectas.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
