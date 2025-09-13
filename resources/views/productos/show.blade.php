@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Detalle de producto</h2>
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $producto->nombre }}</h5>
            <p class="card-text"><strong>SKU:</strong> {{ $producto->sku }}</p>
            <p class="card-text"><strong>Descripción corta:</strong> {{ $producto->descripcion_corta }}</p>
            <p class="card-text"><strong>Descripción larga:</strong> {{ $producto->descripcion_larga }}</p>
            <p class="card-text"><strong>Precio Neto:</strong> {{ $producto->precio_neto }}</p>
            <p class="card-text"><strong>Precio con IVA:</strong> {{ $producto->precio_con_iva }}</p>
            <p class="card-text"><strong>Stock actual:</strong> {{ $producto->stock_actual }}</p>
            <p class="card-text"><strong>Stock mínimo:</strong> {{ $producto->stock_minimo }}</p>
            <p class="card-text"><strong>Stock bajo:</strong> {{ $producto->stock_bajo }}</p>
            <p class="card-text"><strong>Stock alto:</strong> {{ $producto->stock_alto }}</p>
            @if($producto->imagen_url)
                <img src="{{ $producto->imagen_url }}" alt="Imagen del producto" class="img-fluid mt-2" style="max-width:200px;">
            @endif
            <div class="mt-3">
                <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning">Editar</a>
                <a href="{{ route('productos.index') }}" class="btn btn-link">Volver</a>
            </div>
        </div>
    </div>
</div>
@endsection
