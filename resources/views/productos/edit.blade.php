@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Editar producto</h2>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('productos.update', $producto->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="sku" class="form-label">SKU</label>
            <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku', $producto->sku) }}" required>
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required>
        </div>
        <div class="mb-3">
            <label for="descripcion_corta" class="form-label">Descripción corta</label>
            <input type="text" class="form-control" id="descripcion_corta" name="descripcion_corta" value="{{ old('descripcion_corta', $producto->descripcion_corta) }}">
        </div>
        <div class="mb-3">
            <label for="descripcion_larga" class="form-label">Descripción larga</label>
            <textarea class="form-control" id="descripcion_larga" name="descripcion_larga">{{ old('descripcion_larga', $producto->descripcion_larga) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="imagen_url" class="form-label">URL de imagen</label>
            <input type="url" class="form-control" id="imagen_url" name="imagen_url" value="{{ old('imagen_url', $producto->imagen_url) }}">
        </div>
        <div class="mb-3">
            <label for="precio_neto" class="form-label">Precio Neto</label>
            <input type="number" step="0.01" class="form-control" id="precio_neto" name="precio_neto" value="{{ old('precio_neto', $producto->precio_neto) }}" required>
        </div>
        <div class="mb-3">
            <label for="precio_con_iva" class="form-label">Precio con IVA</label>
            <input type="number" step="0.01" class="form-control" id="precio_con_iva" name="precio_con_iva" value="{{ old('precio_con_iva', $producto->precio_con_iva) }}" required>
        </div>
        <div class="mb-3">
            <label for="stock_actual" class="form-label">Stock actual</label>
            <input type="number" class="form-control" id="stock_actual" name="stock_actual" value="{{ old('stock_actual', $producto->stock_actual) }}" required>
        </div>
        <div class="mb-3">
            <label for="stock_minimo" class="form-label">Stock mínimo</label>
            <input type="number" class="form-control" id="stock_minimo" name="stock_minimo" value="{{ old('stock_minimo', $producto->stock_minimo) }}" required>
        </div>
        <div class="mb-3">
            <label for="stock_bajo" class="form-label">Stock bajo</label>
            <input type="number" class="form-control" id="stock_bajo" name="stock_bajo" value="{{ old('stock_bajo', $producto->stock_bajo) }}" required>
        </div>
        <div class="mb-3">
            <label for="stock_alto" class="form-label">Stock alto</label>
            <input type="number" class="form-control" id="stock_alto" name="stock_alto" value="{{ old('stock_alto', $producto->stock_alto) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-link">Volver</a>
    </form>
</div>
@endsection
