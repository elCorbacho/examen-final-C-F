<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\UsuariosController;

// Ruta principal: si no hay sesión, redirige a login
Route::get('/', function () {
    if (!session('usuario_id')) {
        return redirect()->route('login');
    }
    return redirect()->route('usuarios.index');
});

// Login y registro
Route::get('/login', [UsuariosController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UsuariosController::class, 'login'])->name('login.post');
Route::post('/logout', [UsuariosController::class, 'logout'])->name('logout');

Route::get('/register', [UsuariosController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UsuariosController::class, 'register'])->name('register.post');


use App\Http\Controllers\ProductosController;
// CRUD de usuarios (protegido por sesión)
Route::resource('usuarios', UsuariosController::class);
// CRUD de productos
Route::resource('productos', ProductosController::class);


