<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('usuarios.login');
    }

    // Procesar login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => [
                'required',
                'email',
                'regex:/^[a-zA-Z0-9._%+-]+\.[a-zA-Z0-9._%+-]+@ventasfix\.cl$/'
            ],
            'password' => 'required|string',
        ], [
            'email.regex' => 'El correo debe tener el formato nombre.apellido@ventasfix.cl',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/usuarios');
        }

        return back()->withErrors([
            'email' => 'Credenciales incorrectas.',
        ]);
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        return view('usuarios.register');
    }

    // Procesar registro
    public function register(Request $request)
    {
        $validated = $request->validate([
            'rut' => 'required|string|unique:usuario,rut',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'unique:usuario,email',
                'regex:/^[a-zA-Z0-9._%+-]+\.[a-zA-Z0-9._%+-]+@ventasfix\.cl$/'
            ],
            'password' => 'required|string|min:6|confirmed',
        ], [
            'email.regex' => 'El correo debe tener el formato nombre.apellido@ventasfix.cl',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        Usuarios::create($validated);

        return redirect('/login')->with('success', 'Usuario registrado correctamente.');
    }

    // Listar usuarios
    public function index()
    {
        $usuarios = Usuarios::all();
        return view('usuarios.index', compact('usuarios'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('usuarios.create');
    }

    // Guardar nuevo usuario
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rut' => 'required|string|unique:usuario,rut',
            'nombre' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'
            ],
            'apellido' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'
            ],
            'email' => [
                'required',
                'email',
                'unique:usuario,email',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+\.{1}[a-zA-ZáéíóúÁÉÍÓÚñÑ]+@ventasfix\.cl$/'
            ],
            'password' => 'required|string|min:6|confirmed',
        ], [
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'apellido.regex' => 'El apellido solo puede contener letras y espacios.',
            'email.regex' => 'El correo debe tener el formato nombre.apellido@ventasfix.cl, sin números.',
        ]);

        // Validación adicional para coincidencia exacta
        $nombre = strtolower(str_replace(' ', '', $request->nombre));
        $apellido = strtolower(str_replace(' ', '', $request->apellido));
        $emailEsperado = $nombre . '.' . $apellido . '@ventasfix.cl';

        if (strtolower($request->email) !== $emailEsperado) {
            return back()->withErrors(['email' => 'El correo debe ser exactamente igual a nombre.apellido@ventasfix.cl, usando los valores ingresados en nombre y apellido.'])->withInput();
        }

        $validated['password'] = Hash::make($validated['password']);
        Usuarios::create($validated);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    // Mostrar un usuario
    public function show($id)
    {
        $usuario = Usuarios::findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $usuario = Usuarios::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    // Actualizar usuario
    public function update(Request $request, $id)
    {
        $usuario = Usuarios::findOrFail($id);

        $validated = $request->validate([
            'rut' => 'required|string|unique:usuario,rut,' . $id,
            'nombre' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'
            ],
            'apellido' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'
            ],
            'email' => [
                'required',
                'email',
                'unique:usuario,email,' . $id,
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+\.{1}[a-zA-ZáéíóúÁÉÍÓÚñÑ]+@ventasfix\.cl$/'
            ],
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'apellido.regex' => 'El apellido solo puede contener letras y espacios.',
            'email.regex' => 'El correo debe tener el formato nombre.apellido@ventasfix.cl, sin números.',
        ]);

        // Validación adicional para coincidencia exacta
        $nombre = strtolower(str_replace(' ', '', $request->nombre));
        $apellido = strtolower(str_replace(' ', '', $request->apellido));
        $emailEsperado = $nombre . '.' . $apellido . '@ventasfix.cl';

        if (strtolower($request->email) !== $emailEsperado) {
            return back()->withErrors(['email' => 'El correo debe ser exactamente igual a nombre.apellido@ventasfix.cl, usando los valores ingresados en nombre y apellido.'])->withInput();
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $usuario->update($validated);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    // Eliminar usuario
    public function destroy($id)
    {
        $usuario = Usuarios::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
