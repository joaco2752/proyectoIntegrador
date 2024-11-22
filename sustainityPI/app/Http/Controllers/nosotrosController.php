<?php

namespace App\Http\Controllers;

use App\Http\Requests\validadorInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class nosotrosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultaCorreos = DB::table('nosotros')->get();
        return view('nosotros', compact('consultaCorreos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('nosotros');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(validadorInfo $request)
    {
        DB::table('nosotros')->insert([
            "correo"=>$request->input('email'),
            "created_at"=>Carbon::now(),
            "updated_at"=>Carbon::now()
        ]);
        return to_route('rutaInfo')->with('message', 'Te enviaremos más información a ' . $request->email . '!');
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
