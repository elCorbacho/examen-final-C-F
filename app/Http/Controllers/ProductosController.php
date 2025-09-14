<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    // Listar productos
    public function index()
    {
        $productos = Productos::all();
        return view('productos.index', compact('productos'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('productos.create');
    }

    // Guardar nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'sku' => 'required|string|max:50|unique:producto,sku',
            'nombre' => 'required|string|max:255',
            'descripcion_corta' => 'nullable|string|max:255',
            'descripcion_larga' => 'nullable|string',
            'imagen_url' => 'nullable|url',
            'precio_neto' => 'required|numeric|min:0',
            'precio_con_iva' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'stock_bajo' => 'required|integer|min:0',
            'stock_alto' => 'required|integer|min:0',
        ]);

        // Validación adicional: precio_con_iva debe ser igual a precio_neto + 19%
        $precioNeto = $request->precio_neto;
        $precioConIvaEsperado = round($precioNeto * 1.19, 2);
        if ($request->precio_con_iva != $precioConIvaEsperado) {
            return back()
                ->withErrors(['precio_con_iva' => "El precio con IVA debe ser igual a precio neto + 19%. El valor correcto es: $precioConIvaEsperado"])
                ->withInput();
        }

        $producto = Productos::create($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    // Mostrar producto
    public function show($id)
    {
        $producto = Productos::findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $producto = Productos::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    // Actualizar producto
    public function update(Request $request, $id)
    {
        $producto = Productos::findOrFail($id);
        $request->validate([
            'sku' => 'required|string|max:50|unique:producto,sku,' . $producto->id,
            'nombre' => 'required|string|max:255',
            'descripcion_corta' => 'nullable|string|max:255',
            'descripcion_larga' => 'nullable|string',
            'imagen_url' => 'nullable|url',
            'precio_neto' => 'required|numeric|min:0',
            'precio_con_iva' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'stock_bajo' => 'required|integer|min:0',
            'stock_alto' => 'required|integer|min:0',
        ]);

        // Validación adicional: precio_con_iva debe ser igual a precio_neto + 19%
        $precioNeto = $request->precio_neto;
        $precioConIvaEsperado = round($precioNeto * 1.19, 2);
        if ($request->precio_con_iva != $precioConIvaEsperado) {
            return back()
                ->withErrors(['precio_con_iva' => "El precio con IVA debe ser igual a precio neto + 19%. El valor correcto es: $precioConIvaEsperado"])
                ->withInput();
        }

        $cambios = [];
        foreach ($request->except(['_token', '_method']) as $campo => $valor) {
            if ($producto[$campo] != $valor) {
                $cambios[] = "$campo: '{$producto[$campo]}' → '$valor'";
            }
        }
        $producto->update($request->all());
        $mensaje = $cambios ? 'Actualización: ' . implode(', ', $cambios) : 'No hubo cambios.';
        return redirect()->route('productos.index')->with('success', $mensaje);
    }

    // Eliminar producto
    public function destroy($id)
    {
        $producto = Productos::findOrFail($id);
        $producto->delete();
        return redirect()->route('productos.index')->with('deleted', 'Producto eliminado correctamente.');
    }
}
