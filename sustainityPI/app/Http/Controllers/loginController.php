<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\validadorLogin;

class loginController extends Controller
{
    public function create()
    {
        return view('Login');
    }
    
    public function store(validadorLogin $request)
    {
        // Realiza la petición al endpoint de FastAPI
        $response = Http::withoutVerifying()->post('https://api-yovy.onrender.com/login', [
            'email'    => $request->email,
            'password' => $request->contraseña,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['token']) && isset($data['usuario'])) {
                // Guarda en sesión que el usuario está logueado, el token, el username y el id del usuario
                session([
                    'logged_in' => true,
                    'authToken' => $data['token'],
                    'username'  => $data['usuario']['username'],
                    'user_id'   => $data['usuario']['id'],  // Asegúrate de que la API retorne el id
                ]);
                return redirect()->route('rutaInicio')->with('message', 'Inicio de sesión exitoso');
            }
        }

        return back()->withErrors(['email' => 'Las credenciales son incorrectas.'])->withInput();
    }
    
    /**
     * Otros métodos.
     */
    public function index()
    {
        // Cambiar de 'usuarios' a 'tbUsers'
        $consultaCuentas = DB::table('tbUsers')->get();
        return view('login', compact('consultaCuentas'));
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('rutaInicio')->with('message', 'Sesión cerrada');
    }
}