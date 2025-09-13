@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Productos</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('productos.create') }}" class="btn btn-success mb-2">Nuevo producto</a>
    <a href="{{ route('usuarios.index') }}" class="btn btn-link">Usuarios</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>SKU</th>
                <th>Nombre</th>
                <th>Precio Neto</th>
                <th>Precio con IVA</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->sku }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->precio_neto }}</td>
                    <td>{{ $producto->precio_con_iva }}</td>
                    <td>{{ $producto->stock_actual }}</td>
                    <td>
                        <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
