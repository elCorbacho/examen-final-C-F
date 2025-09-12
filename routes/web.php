<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usuarioController;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Rutas de autenticación de usuarios
Route::get('/login', [usuarioController::class, 'showLoginForm'])->name('usuarios.login');
Route::post('/login', [usuarioController::class, 'login']);
Route::post('/logout', [usuarioController::class, 'logout'])->name('usuarios.logout');

// Rutas de gestión de usuarios
Route::resource('usuarios', usuarioController::class);

require __DIR__.'/auth.php';


