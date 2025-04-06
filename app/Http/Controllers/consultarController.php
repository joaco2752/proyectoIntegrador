<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Requests\validadorCrear;

class consultarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultaCuentas = DB::table('usuarios')->get();
        return view('Consultar', compact('consultaCuentas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Consultar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        //
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
        $usuario = DB::table('usuarios')->where('id', $id)->first();
        if (!$usuario) {
            return redirect()->route('rutaConsultar')->with('error', 'Usuario no encontrado');
        }
        return view('FormularioActualizar', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(validadorCrear $request, string $id)
    {
        DB::table('usuarios')->where('id', $id)->update([
            "email"=>$request->input('email'),
            "contraseña"=>$request->input('contraseña'),
            "created_at"=>Carbon::now(),
            "updated_at"=>Carbon::now()
        ]);
        session()->Flash('exito');
        return to_route('rutaConsultar')->with('exito', 'Usuario Actualizado' . $request->amount . '!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('usuarios')->where('id', $id)->delete();
        session()->Flash('exito');
        return to_route('rutaConsultar');
    }
}

