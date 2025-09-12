<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuarios;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class UsuariosControllerAPI extends Controller
{


// realiza un post de un usuario
// no se encuentra protegido por autenticacion
    public function store(Request $request)
    {
        try {
            $request->validate([
                'rut' => 'required|string|unique:usuario,rut',
                'nombre' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'email' => 'required|email|unique:usuario,email|max:255',
                'password' => 'required|string|min:6'
            ], [
                'nombre.unique' => 'El nombre de usuario ya está en uso.',
                'email.unique' => 'El usuario ya existe con ese correo electrónico.'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        }

        $user = Usuarios::create([
            'rut' => $request->rut,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = JWTAuth::fromUser($user);
        return response()->json([
            'status' => 'success',
            'user' => $user, 'token' => $token], 201);
    }


// realiza un post para login
// no se encuentra protegido por autenticacion
// devuelve un token JWT si las credenciales son correctas
    public function loginApi(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Credenciales inválidas'
            ], 401);
        }
        return response()->json([
            'status' => 'success',
            'token' => $token
        ], 200);
    }



    // get de todos los usuarios
    public function index()
    {
        //
        $usuarios = Usuarios::all();
        if($usuarios->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => 'No hay usuarios disponibles'
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'data' => $usuarios,
            'message' => 'Usuarios obtenidos exitosamente'
        ], 200);
    }



    // get de un usuario por id
    public function show(string $id)
    {
        //
        $usuario = Usuarios::find($id);
        if (!$usuario) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => 'Usuario no encontrado'
            ], 404);
        }
        return response()->json(
            [
                'status' => 'success',
                'data' => $usuario,
                'message' => 'Usuario obtenido exitosamente'
            ], 200);
    }




    // update de un usuario por id
    public function update(Request $request, string $id)
    {
        $usuario = Usuarios::find($id);
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        $validated = $request->validate([
            'rut' => 'sometimes|required|string|unique:usuario,rut,' . $id,
            'nombre' => 'sometimes|required|string|max:255',
            'apellido' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:usuario,email,' . $id,
            'password' => 'sometimes|required|string|min:6',
        ]);
        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }
        $usuario->update($validated);
        return response()->json($usuario);
    }

    // delete de un usuario por id
    public function destroy(string $id)
    {
        $usuario = Usuarios::find($id);
        if (!$usuario) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => 'Usuario no encontrado'
            ], 404);
        }
        $usuario->delete();
        return response()->json([
            'status' => 'success',
            'data' => null,
            'message' => 'Usuario eliminado con éxito'
        ], 200);
    }
}
