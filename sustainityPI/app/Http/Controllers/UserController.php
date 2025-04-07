<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Obtener todos los usuarios de la tabla tbUsers
        $users = DB::table('tbUsers')->get();

        // Pasar los usuarios a la vista
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:tbUsers,username',
            'email' => 'required|email|unique:tbUsers,email',
            'password' => 'required|min:8',
            'role_id' => 'required|exists:tbRoles,id',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }
}