<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\DashboardController;

// Ruta principal: si no hay sesión, redirige a login
Route::get('/', function () {
    if (!session('usuario_id')) {
        return redirect()->route('login');
    }
    return redirect()->route('usuarios.index');
});

//-----
// ruta web para login, registro y logout
Route::get('/login', [UsuariosController::class, 'showLoginForm'])->name('login');

//ruta web para procesar el login
Route::post('/login', [UsuariosController::class, 'login'])->name('login.post');

//ruta web para procesar el logout
Route::post('/logout', [UsuariosController::class, 'logout'])->name('logout');


//----
//ruta web para registro de nuevos usuarios
Route::get('/register', [UsuariosController::class, 'showRegisterForm'])->name('register');

//ruta web para procesar el registro
Route::post('/register', [UsuariosController::class, 'register'])->name('register.post');



// Rutas protegidas por sesión
Route::middleware('auth')->group(function () {

    //ruta para el CRUD de usuarios, productos y clientes
    Route::resource('usuarios', UsuariosController::class);
    Route::resource('productos', ProductosController::class);
    Route::resource('clientes', ClientesController::class);

    //ruta para el dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
