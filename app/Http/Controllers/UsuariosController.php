<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    //-------------------------------------------------
    //VISTA INICIAL DE APLICACION
    // Mostrar formulario de login
    //-------------------------------------------------

    public function showLoginForm()
    {
        return view('usuarios.login');
    }


    // Procesar login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $usuario = Usuarios::where('email', $request->email)->first();
        if ($usuario && Hash::check($request->password, $usuario->password)) {
            session(['usuario_id' => $usuario->id, 'usuario_nombre' => $usuario->nombre]);
            return redirect()->route('usuarios.index')->with('success', 'Sesión iniciada correctamente.');
        }
        return back()->withErrors(['email' => 'Credenciales incorrectas'])->withInput();
    }

    //------------------------------------------------



    //------------------------------------------------
    // Cerrar sesión
    public function logout()
    {
        session()->forget(['usuario_id', 'usuario_nombre']);
        return redirect()->route('login')->with('success', 'Sesión cerrada.');
    }
    //------------------------------------------------


    //------------------------------------------------
    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        return view('usuarios.register');
    }

    // Procesar registro
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $usuario = new Usuarios();
        $usuario->nombre = $request->nombre;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->save();

        session(['usuario_id' => $usuario->id, 'usuario_nombre' => $usuario->nombre]);
        return redirect()->route('usuarios.index')->with('success', 'Usuario registrado y sesión iniciada.');
    }
    //----------------------------------------------------


    //------------------------------------------------
    //PAGINA INICIAL TRAS LOGIN
    // Listar usuarios
    //--------------------------------------------------

    public function index()
    {
        $this->checkSession();
        $usuarios = Usuarios::all();
        return view('usuarios.index', compact('usuarios'));
    }


    // Mostrar formulario de creación
    public function create()
    {
        $this->checkSession();
        return view('usuarios.create');
    }

    // Guardar nuevo usuario
    public function store(Request $request)
    {
        $this->checkSession();
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $usuario = new Usuarios();
        $usuario->nombre = $request->nombre;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }



    // Mostrar usuario
    public function show($id)
    {
        $this->checkSession();
        $usuario = Usuarios::findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $this->checkSession();
        $usuario = Usuarios::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    // Actualizar usuario
    public function update(Request $request, $id)
    {
        $this->checkSession();
        $usuario = Usuarios::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . $usuario->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $cambios = [];
        if ($usuario->nombre !== $request->nombre) {
            $cambios[] = "Nombre: '{$usuario->nombre}' → '{$request->nombre}'";
            $usuario->nombre = $request->nombre;
        }
        if ($usuario->email !== $request->email) {
            $cambios[] = "Email: '{$usuario->email}' → '{$request->email}'";
            $usuario->email = $request->email;
        }
        if ($request->filled('password')) {
            $cambios[] = "Contraseña actualizada";
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        $mensaje = $cambios ? 'Actualización: ' . implode(', ', $cambios) : 'No hubo cambios.';
        return redirect()->route('usuarios.index')->with('success', $mensaje);
    }

    // Eliminar usuario
    public function destroy($id)
    {
        $this->checkSession();
        $usuario = Usuarios::findOrFail($id);
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }

    // Validar sesión
    private function checkSession()
    {
        if (!session('usuario_id')) {
            abort(403, 'No autenticado.');
        }
    }
}
