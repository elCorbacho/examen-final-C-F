<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use App\Models\Productos;
use App\Models\Clientes;

class DashboardController extends Controller
{
    public function index()
    {
        $usuarios = Usuarios::count();
        $productos = Productos::count();
        $clientes = Clientes::count();

        return view('dashboard.dashboard', compact('usuarios', 'productos', 'clientes'));
    }
}
