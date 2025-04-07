<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Requests\validadorDonativo;

class donativoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultaDonativos = DB::table('donativos')->get();
        return view('donativos', compact('consultaDonativos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('donativos');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(validadorDonativo $request)
    {
        DB::table('donativos')->insert([
            "nombre"=>$request->input('name'),
            "correo"=>$request->input('email'),
            "cantidad"=>$request->input('amount'),
            "metodo_pago"=>$request->input('payment_method'),
            "created_at"=>Carbon::now(),
            "updated_at"=>Carbon::now()
        ]);
        return to_route('rutaDonativos')->with('message', 'Gracias por tu donación de $' . number_format($request->amount, 2) . '!');
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
