<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\FastApiService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $fastApi;

    public function __construct(FastApiService $fastApi)
    {
        $this->fastApi = $fastApi;
    }

    // Crear usuario
    public function agregarUsuario(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'role_id' => 'required|integer',
        ]);
    
        try {
            // Verificar si el correo ya existe en la API
            $usuarios = $this->fastApi->get('/usuarios'); // Endpoint para obtener todos los usuarios
            $correoExistente = collect($usuarios)->firstWhere('email', $data['email']);
    
            if ($correoExistente) {
                return response()->json(['message' => 'El correo ya está en uso'], 422);
            }
    
            // Crear el usuario si el correo no existe
            $userData = [
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role_id' => $data['role_id'],
            ];
    
            $this->fastApi->post('/usuarios', $userData);
            return response()->json(['message' => 'Usuario creado correctamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear el usuario', 'error' => $e->getMessage()], 500);
        }
    }
    // Leer todos los usuarios
    public function leerUsuarios()
    {
        try {
            $usuarios = $this->fastApi->get('/usuarios');
            return response()->json($usuarios);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al obtener los usuarios', 'error' => $e->getMessage()], 500);
        }
    }

    // Leer un usuario por ID
    public function leerUsuario($id)
    {
        try {
            $usuario = $this->fastApi->get('/usuarios/' . $id);
            return response()->json($usuario);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Usuario no encontrado', 'error' => $e->getMessage()], 404);
        }
    }

    // Actualizar usuario
    public function actualizarUsuario(Request $request, $id)
    {
        $data = $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'role_id' => 'required|integer',
        ]);

        $userData = [
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role_id' => $data['role_id'],
        ];

        try {
            $this->fastApi->put('/usuarios/' . $id, $userData);
            return response()->json(['message' => 'Usuario actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar el usuario', 'error' => $e->getMessage()], 500);
        }
    }

    // Eliminar usuario
    public function eliminarUsuario($id)
    {
        try {
            $this->fastApi->delete('/usuarios/' . $id);
            return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el usuario', 'error' => $e->getMessage()], 500);
        }
    }
}
