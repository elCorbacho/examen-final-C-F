@extends('layouts.app')
@section('content')
<div class="authentication-wrapper authentication-cover d-flex justify-content-center">
    <div class="authentication-inner row justify-content-center w-100 m-0">
        <!-- Productos Card -->
        <div class="d-flex col-lg-10 align-items-center authentication-bg p-0 justify-content-center mx-auto">
            <div class="w-100 p-4 p-sm-5">
                <div class="mb-2">
                    <h4 class="mb-0">Productos</h4>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="{{ route('productos.create') }}" class="btn btn-success">Nuevo producto</a>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <thead class="table-light">
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
                                                <div class="btn-group" role="group" aria-label="Acciones">
                                                    <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-info btn-sm" title="Ver"><i class="ti ti-eye"></i></a>
                                                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm" title="Editar"><i class="ti ti-pencil"></i></a>
                                                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm" title="Eliminar" onclick="return confirm('¿Seguro?')"><i class="ti ti-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Productos Card -->
    </div>
</div>
@endsection
