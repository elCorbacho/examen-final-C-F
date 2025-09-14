<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Productos;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Validation\ValidationException;

class ProductosControllerAPI extends Controller
{


    //MENSAJES DE ERROR Y EXITO EN FORMATO JSON OK

    // realiza un get de todos los productos
    public function index()
    {
        $productos = Productos::all();
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

    // realiza un get de un producto por id
    public function show(string $id)
    {
        //
        $producto = Productos::find($id);
        if (!$producto) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => 'Producto no encontrado'
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'data' => $producto,
            'message' => 'Producto obtenido exitosamente',
        ] , 200);
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
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => 'Todos los campos son obligatorios o el SKU ya existe',
                'errors' => $e->errors(),
            ], 422);
        }

        // Validación adicional: precio_con_iva debe ser igual a precio_neto + 19%
        $precioNeto = $validated['precio_neto'];
        $precioConIvaEsperado = round($precioNeto * 1.19, 2);
        if ($validated['precio_con_iva'] != $precioConIvaEsperado) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => "El precio con IVA debe ser igual a precio neto + 19%. El valor correcto es: $precioConIvaEsperado",
                'errors' => [
                    'precio_con_iva' => ["El valor correcto es: $precioConIvaEsperado"]
                ],
            ], 422);
        }

        try {
            $producto = Productos::create($validated);
            return response()->json([
                'status' => 'success',
                'data' => $producto,
                'message' => 'Producto creado exitosamente',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => 'Error al crear el producto',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



    // realiza un put de un producto por id
    public function update(Request $request, string $id)
    {
        $producto = Productos::find($id);
        if (!$producto) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => 'Producto no encontrado'
            ], 404);
        }

        try {
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
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => 'Error de validación',
                'errors' => $e->errors(),
            ], 422);
        }

        $producto->update($validated);

        $mensajes = [];

        foreach ($validated as $campo => $valor) {
            switch ($campo) {
                case 'sku':
                    $campo = 'SKU';
                    break;
                case 'nombre':
                    $campo = 'Nombre';
                    break;
                case 'descripcion_corta':
                    $campo = 'Descripción Corta';
                    break;
                case 'descripcion_larga':
                    $campo = 'Descripción Larga';
                    break;
                case 'imagen_url':
                    $campo = 'Imagen URL';
                    break;
                case 'precio_neto':
                    $campo = 'Precio Neto';
                    break;
                case 'precio_con_iva':
                    $campo = 'Precio con IVA';
                    break;
                case 'stock_actual':
                    $campo = 'Stock Actual';
                    break;
                case 'stock_minimo':
                    $campo = 'Stock Mínimo';
                    break;
                case 'stock_bajo':
                    $campo = 'Stock Bajo';
                    break;
                case 'stock_alto':
                    $campo = 'Stock Alto';
                    break;
            }
            $mensajes[] = "El campo '$campo' ha sido actualizado a '$valor'.";
        }

        return response()->json([
            'status' => 'success',
            'data' => $producto,
            'mensajes' => $mensajes,
        ], 200);
    }




    // realiza un delete de un producto por id
    public function destroy(string $id)
    {
        //
        $producto = Productos::find($id);
        if (!$producto) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => 'Producto no encontrado'
            ], 404);
        }
        $producto->delete();
        return response()->json([
            'status' => 'success',
            'data' => null,
            'message' => 'Producto eliminado correctamente'
        ], 200);
    }
}
