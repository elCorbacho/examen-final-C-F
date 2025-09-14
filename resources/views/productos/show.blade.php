@extends('layouts.app')
@section('content')
<div class="authentication-wrapper authentication-cover d-flex justify-content-center">
    <div class="authentication-inner row justify-content-center w-100 m-0">
        <!-- Detalle Producto Card -->
        <div class="d-flex col-lg-6 align-items-center authentication-bg p-0 justify-content-center mx-auto">
            <div class="w-100 p-4 p-sm-5">
                <div class="mb-4 text-center">
                    <h4 class="mb-2">Detalle de producto</h4>
                </div>
                <div class="card shadow-sm">
                    <div class="card-body text-start">
                        <div class="d-flex justify-content-end mb-3 gap-2">
                            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning">Editar</a>
                            <a href="{{ route('productos.index') }}" class="btn btn-link">Volver</a>
                        </div>
                        <h5 class="card-title mb-3">{{ $producto->nombre }}</h5>
                        <p class="card-text mb-1"><strong>SKU:</strong> {{ $producto->sku }}</p>
                        <p class="card-text mb-1"><strong>Descripción corta:</strong> {{ $producto->descripcion_corta }}</p>
                        <p class="card-text mb-1"><strong>Descripción larga:</strong> {{ $producto->descripcion_larga }}</p>
                        <p class="card-text mb-1"><strong>Precio Neto:</strong> {{ $producto->precio_neto }}</p>
                        <p class="card-text mb-1"><strong>Precio con IVA:</strong> {{ $producto->precio_con_iva }}</p>
                        <p class="card-text mb-1"><strong>Stock actual:</strong> {{ $producto->stock_actual }}</p>
                        <p class="card-text mb-1"><strong>Stock mínimo:</strong> {{ $producto->stock_minimo }}</p>
                        <p class="card-text mb-1"><strong>Stock bajo:</strong> {{ $producto->stock_bajo }}</p>
                        <p class="card-text mb-3"><strong>Stock alto:</strong> {{ $producto->stock_alto }}</p>
                        @if($producto->imagen_url)
                            <img src="{{ $producto->imagen_url }}" alt="Imagen del producto" class="img-fluid mt-2 mb-3" style="max-width:200px;">
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- /Detalle Producto Card -->
    </div>
</div>
@endsection
