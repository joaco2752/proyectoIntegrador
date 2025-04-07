<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Requests\validadorCrear;

class crearcuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cambiar de 'usuarios' a 'tbUsers'
        $consultaCuentas = DB::table('tbUsers')->get();
        return view('CrearCuenta', compact('consultaCuentas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('CrearCuenta');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(validadorCrear $request)
    {
        $request->validate([
            'email' => 'required|email|unique:tbUsers,email',
            'username' => 'required|unique:tbUsers,username',
        ]);

        DB::table('tbUsers')->insert([
            "username" => $request->input('username'),
            "email" => $request->input('email'),
            "password" => bcrypt($request->input('password')),
            "role_id" => 2,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);

        return redirect()->route('rutaCrear')->with('exito', 'Usuario creado correctamente.');
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
