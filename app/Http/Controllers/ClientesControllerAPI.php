<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clientes;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Validation\ValidationException;


class ClientesControllerAPI extends Controller
{


    //realiza un get de todos los clientes
    public function index()
    {

        $clientes = Clientes::all();
        if($clientes->isEmpty()){
            return response()->json( [
                'status' => 'error',
                'data' => null,
                'message' => 'No hay clientes registrados',
            ], 404);
        }
        return response()->json( [
            'status' => 'success',
            'data' => $clientes,
            'message' => 'Clientes obtenidos exitosamente',
        ], 200);
    }

    // get de un cliente por id
    public function show(string $id)
    {
        $cliente = Clientes::find($id);
        if (!$cliente) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => 'Cliente no encontrado',
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'data' => $cliente,
            'message' => 'Cliente obtenido exitosamente'], 200);
    }




    // realiza un post de un cliente
    public function store(Request $request)
    {
        try {
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
        return response()->json(
            [
                'status' => 'success',
                'data' => $cliente,
                'message' => 'Cliente creado exitosamente'
            ], 201);
        }

        catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error de validación',
                'errors' => $e->errors(),
            ], 422);

        }
    }


    // update de un cliente por id
    public function update(Request $request, string $id)
    {
        //
        $cliente = Clientes::find($id);
        if (!$cliente) {
            return response()->json([
                'message' => 'Cliente no encontrado',
                'data' => null,
                'status' => 'error'
            ], 404);
        }

        try {
            $validated = $request->validate([
                'rut_empresa' => 'sometimes|required|string|unique:clientes,rut_empresa,' . $id,
                'rubro' => 'sometimes|required|string|max:255',
                'razon_social' => 'sometimes|required|string|max:255',
                'telefono' => 'nullable|string|max:20',
                'direccion' => 'nullable|string|max:255',
                'contacto_nombre' => 'sometimes|required|string|max:255',
                'contacto_correo' => 'sometimes|required|email|max:255',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        }


        // Guardar valores originales antes de actualizar
        $original = $cliente->only(array_keys($validated));

        // Actualizar el cliente
        $cliente->update($validated);

        // Mensajes detallados de los cambios
        $mensajes = [];
        foreach ($validated as $campo => $valor) {
            $nombreCampo = match ($campo) {
                'rut_empresa' => 'RUT Empresa',
                'rubro' => 'Rubro',
                'razon_social' => 'Razón Social',
                'telefono' => 'Teléfono',
                'direccion' => 'Dirección',
                'contacto_nombre' => 'Nombre de Contacto',
                'contacto_correo' => 'Correo de Contacto',
                default => ucfirst($campo),
            };

            $valorAnterior = $original[$campo] ?? '(sin valor anterior)';
            $mensajes[] = "El campo '$nombreCampo' fue actualizado de '$valorAnterior' a '$valor'.";
        }

        return response()->json([
            'status' => 'success',
            'data' => $cliente,
            'mensajes' => $mensajes,
        ], 200);
    }


    // delete de un cliente por id
    public function destroy(string $id)
    {
        //
        $cliente = Clientes::find($id);
        if (!$cliente) {
            return response()->json([
                'message' => 'Cliente no encontrado',
                'data' => null,
                'status' => 'error'
            ], 404);
        }
        $cliente->delete();
        return response()->json([
            'message' => 'Cliente eliminado correctamente',
            'data' => null,
            'status' => 'success'
        ]);

    }
}
