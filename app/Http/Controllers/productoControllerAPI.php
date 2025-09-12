<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Validation\ValidationException;

class productoControllerAPI extends Controller
{

    // realiza un get de todos los productos
    public function index()
    {
        $productos = producto::all();
        //
        if($productos->isEmpty()){
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => 'No hay productos disponibles',
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'data' => $productos,
            'message' => 'Productos obtenidos exitosamente',
        ], 200);
    }

    // realiza un post de un producto
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'sku' => 'required|string|unique:producto,sku',
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
        } catch (ValidationException $e) { // captura errores de validacion
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => 'todos los campos son obligatorios o el SKU ya existe',
                'errors' => $e->errors(),
            ], 422);

        }

        try {
            $producto = producto::create($validated);
            return response()->json([
                'status' => 'success',
                'data' => $producto,
                'message' => 'Producto creado exitosamente',
            ], 201);
        } catch (\Exception $e) { // captura cualquier otro error
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => 'Error al crear el producto',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    // realiza un get de un producto por id
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
