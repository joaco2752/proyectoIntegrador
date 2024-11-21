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
        $consultaCuentas = DB::table('_crear_cuenta')->get();
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
    public function store(Request $request)
    {
        DB::table('_crear_cuenta')->insert([
            "correo"=>$request->input('correo'),
            "contraseña"=>$request->input('contraseña'),
            "created_at"=>Carbon::now(),
            "updated_at"=>Carbon::now()
        ]);
        return to_route('rutaCrear')->with('message', 'Gracias por registrarte' . $request->amount . '!');
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
