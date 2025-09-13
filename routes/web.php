<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Rutas de autenticación de usuarios
Route::get('/login', [UsuariosController::class, 'showLoginForm'])->name('usuarios.login');
Route::post('/login', [UsuariosController::class, 'login']);
Route::post('/logout', [UsuariosController::class, 'logout'])->name('usuarios.logout');

// Rutas de gestión de usuarios
Route::resource('usuarios', UsuariosController::class);

require __DIR__.'/auth.php';


