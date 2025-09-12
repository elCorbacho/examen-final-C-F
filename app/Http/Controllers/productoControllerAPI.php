<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;

class productoControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $productos = producto::all();
        return response()->json($productos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
        'sku' => 'required|string|unique:productos,sku',
        'nombre' => 'required|string|max:255',
        'descripcion_corta' => 'required|string|max:255',
        'descripcion_larga' => 'nullable|string',
        'imagen_url' => 'nullable|string|max:255',
        'precio_neto' => 'required|numeric|min:0',
        'precio_con_iva' => 'required|numeric|min:0',
        'stock_actual' => 'required|integer|min:0',
        'stock_minimo' => 'required|integer|min:0',
        'stock_bajo' => 'required|integer|min:0',
        'stock_alto' => 'required|integer|min:0',
    ]);
    $producto = producto::create($validated);
    return response()->json($producto, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $producto = producto::find($id);
        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
        return response()->json($producto);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
        $validated = $request->validate([
            'sku' => 'sometimes|required|string|unique:productos,sku,' . $id,
            'nombre' => 'sometimes|required|string|max:255',
            'descripcion_corta' => 'sometimes|required|string|max:255',
            'descripcion_larga' => 'nullable|string',
            'imagen_url' => 'nullable|string|max:255',
            'precio_neto' => 'sometimes|required|numeric|min:0',
            'precio_con_iva' => 'sometimes|required|numeric|min:0',
            'stock_actual' => 'sometimes|required|integer|min:0',
            'stock_minimo' => 'sometimes|required|integer|min:0',
            'stock_bajo' => 'sometimes|required|integer|min:0',
            'stock_alto' => 'sometimes|required|integer|min:0',
        ]);
        $producto->update($validated);
        return response()->json($producto);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
        $producto->delete();
        return response()->json(['message' => 'Producto eliminado correctamente']);
    }
}
