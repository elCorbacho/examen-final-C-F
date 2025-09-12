<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clientes;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Validation\ValidationException;


class ClientesControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $clientes = Clientes::all();
        return response()->json($clientes);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
            {
        $validated = $request->validate([
            'rut_empresa' => 'required|string|unique:cliente,rut_empresa',
            'rubro' => 'required|string|max:255',
            'razon_social' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'contacto_nombre' => 'required|string|max:255',
            'contacto_correo' => 'required|email|max:255',
        ]);
        $cliente = Clientes::create($validated);
        return response()->json($cliente, 201);
    }



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = Clientes::find($id);
        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
        return response()->json($cliente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $cliente = Clientes::find($id);
        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
        $validated = $request->validate([
            'rut_empresa' => 'sometimes|required|string|unique:clientes,rut_empresa,' . $id,
            'rubro' => 'sometimes|required|string|max:255',
            'razon_social' => 'sometimes|required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'contacto_nombre' => 'sometimes|required|string|max:255',
            'contacto_correo' => 'sometimes|required|email|max:255',
        ]);
        $cliente->update($validated);
        return response()->json($cliente);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $cliente = Clientes::find($id);
        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
        $cliente->delete();
        return response()->json(['message' => 'Cliente eliminado correctamente']);

    }
}
