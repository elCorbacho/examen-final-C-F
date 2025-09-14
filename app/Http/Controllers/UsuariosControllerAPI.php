<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuarios;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Validation\ValidationException;

class UsuariosControllerAPI extends Controller
{
    // POST: Crear usuario (API)
    public function store(Request $request)
    {
        try {
            $request->validate([
                'rut' => 'required|string|unique:usuario,rut',
                'nombre' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'email' => [
                    'required',
                    'email',
                    'unique:usuario,email',
                    'max:255',
                    'regex:/^[a-zA-Z0-9._%+-]+\.[a-zA-Z0-9._%+-]+@ventasfix\.cl$/'
                ],
                'password' => 'required|string|min:6'
            ], [
                'nombre.unique' => 'El nombre de usuario ya está en uso.',
                'email.unique' => 'El usuario ya existe con ese correo electrónico.',
                'email.regex' => 'El correo debe tener el formato nombre.apellido@ventasfix.cl'
            ]);
        } catch (ValidationException $e) {
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

    // POST: Login API
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

    // GET: Listar usuarios
    public function index()
    {
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

    // GET: Mostrar usuario por ID
    public function show(string $id)
    {
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

    // PUT/PATCH: Actualizar usuario por ID
    public function update(Request $request, string $id)
    {
        $usuario = Usuarios::find($id);
        if (!$usuario) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        try {
            $validated = $request->validate([
                'rut' => 'sometimes|required|string|unique:usuario,rut,' . $id,
                'nombre' => 'sometimes|required|string|max:255',
                'apellido' => 'sometimes|required|string|max:255',
                'email' => [
                    'sometimes',
                    'required',
                    'email',
                    'unique:usuario,email,' . $id,
                    'max:255',
                    'regex:/^[a-zA-Z0-9._%+-]+\.[a-zA-Z0-9._%+-]+@ventasfix\.cl$/'
                ],
                'password' => 'sometimes|required|string|min:6',
            ], [
                'nombre.unique' => 'El nombre de usuario ya está en uso.',
                'email.unique' => 'El usuario ya existe con ese correo electrónico.',
                'email.regex' => 'El correo debe tener el formato nombre.apellido@ventasfix.cl'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        }

        $original = $usuario->only(array_keys($validated));

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $usuario->update($validated);

        $mensajes = [];
        foreach ($validated as $campo => $valor) {
            $nombreCampo = match ($campo) {
                'rut' => 'RUT',
                'nombre' => 'Nombre',
                'apellido' => 'Apellido',
                'email' => 'Correo electrónico',
                'password' => 'Contraseña',
                default => ucfirst($campo),
            };

            $valorAnterior = $original[$campo] ?? '(sin valor anterior)';
            if ($campo === 'password') {
                $mensajes[] = "El campo '$nombreCampo' fue actualizado.";
            } else {
                $mensajes[] = "El campo '$nombreCampo' fue actualizado de '$valorAnterior' a '$valor'.";
            }
        }

        return response()->json([
            'status' => 'success',
            'data' => $usuario,
            'mensajes' => $mensajes,
        ], 200);
    }

    // DELETE: Eliminar usuario por ID
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
