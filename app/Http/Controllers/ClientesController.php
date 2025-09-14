<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    // Listar clientes
    public function index()
    {
        $clientes = Clientes::all();
        return view('clientes.index', compact('clientes'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('clientes.create');
    }

    // Guardar nuevo cliente
    public function store(Request $request)
    {
        $request->validate([
            'rut_empresa' => 'required|string|max:20|unique:cliente,rut_empresa',
            'rubro' => 'required|string|max:100',
            'razon_social' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'contacto_nombre' => 'nullable|string|max:100',
            'contacto_correo' => 'nullable|email|max:100',
        ]);

    Clientes::create($request->all());
    return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente.');
    }

    // Mostrar cliente
    public function show($id)
    {
        $cliente = Clientes::findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $cliente = Clientes::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    // Actualizar cliente
    public function update(Request $request, $id)
    {
        $cliente = Clientes::findOrFail($id);
        $request->validate([
            'rut_empresa' => 'required|string|max:20|unique:cliente,rut_empresa,' . $cliente->id,
            'rubro' => 'required|string|max:100',
            'razon_social' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'contacto_nombre' => 'nullable|string|max:100',
            'contacto_correo' => 'nullable|email|max:100',
        ]);

        $cambios = [];
        foreach ($request->except(['_token', '_method']) as $campo => $valor) {
            if ($cliente[$campo] != $valor) {
                $cambios[] = "$campo: '{$cliente[$campo]}' → '$valor'";
            }
        }
        $cliente->update($request->all());
        $mensaje = $cambios ? 'Actualización: ' . implode(', ', $cambios) : 'No hubo cambios.';
        return redirect()->route('clientes.index')->with('success', $mensaje);
    }

    // Eliminar cliente
    public function destroy($id)
    {
        $cliente = Clientes::findOrFail($id);
    $cliente->delete();
    return redirect()->route('clientes.index')->with('deleted', 'Cliente eliminado correctamente.');
    }
}
