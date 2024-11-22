<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Requests\validadorLogin;

class loginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultaCuentas = DB::table('login')->get();
        return view('Login');
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
        DB::table('login')->insert([
            "correo"=>$request->input('correo'),
            "contraseña"=>$request->input('contraseña'),
            "created_at"=>Carbon::now(),
            "updated_at"=>Carbon::now()
        ]);
        return to_route('rutaInicio')->with('message', 'Inicio de Sesion Exitoso' . $request->amount . '!');
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
