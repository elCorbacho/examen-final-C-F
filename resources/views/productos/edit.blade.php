@extends('layouts.app')
@section('content')
<div class="authentication-wrapper authentication-cover d-flex justify-content-center">
    <div class="authentication-inner row justify-content-center w-100 m-0">
        <!-- Edit Producto Card -->
        <div class="d-flex col-lg-6 align-items-center authentication-bg p-0 justify-content-center mx-auto">
            <div class="w-100 p-4 p-sm-5">
                <div class="mb-4 text-center">
                    <h4 class="mb-2">Editar producto</h4>
                    <p class="mb-4">Modifica los datos del producto</p>
                </div>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('productos.update', $producto->id) }}" class="mb-3">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="sku" class="form-label">SKU</label>
                        <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku', $producto->sku) }}" required placeholder="SKU del producto">
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required placeholder="Nombre del producto">
                    </div>
                    <div class="mb-3">
                        <label for="descripcion_corta" class="form-label">Descripción corta</label>
                        <input type="text" class="form-control" id="descripcion_corta" name="descripcion_corta" value="{{ old('descripcion_corta', $producto->descripcion_corta) }}" placeholder="Breve descripción">
                    </div>
                    <div class="mb-3">
                        <label for="descripcion_larga" class="form-label">Descripción larga</label>
                        <textarea class="form-control" id="descripcion_larga" name="descripcion_larga" placeholder="Descripción detallada">{{ old('descripcion_larga', $producto->descripcion_larga) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="imagen_url" class="form-label">URL de imagen</label>
                        <input type="url" class="form-control" id="imagen_url" name="imagen_url" value="{{ old('imagen_url', $producto->imagen_url) }}" placeholder="https://...">
                    </div>
                    <div class="mb-3">
                        <label for="precio_neto" class="form-label">Precio Neto</label>
                        <input type="number" step="0.01" class="form-control" id="precio_neto" name="precio_neto" value="{{ old('precio_neto', $producto->precio_neto) }}" required placeholder="0.00">
                    </div>
                    <div class="mb-3">
                        <label for="precio_con_iva" class="form-label">Precio con IVA</label>
                        <input type="number" step="0.01" class="form-control" id="precio_con_iva" name="precio_con_iva" value="{{ old('precio_con_iva', $producto->precio_con_iva) }}" required placeholder="0.00">
                    </div>
                    <div class="mb-3">
                        <label for="stock_actual" class="form-label">Stock actual</label>
                        <input type="number" class="form-control" id="stock_actual" name="stock_actual" value="{{ old('stock_actual', $producto->stock_actual) }}" required placeholder="Cantidad actual">
                    </div>
                    <div class="mb-3">
                        <label for="stock_minimo" class="form-label">Stock mínimo</label>
                        <input type="number" class="form-control" id="stock_minimo" name="stock_minimo" value="{{ old('stock_minimo', $producto->stock_minimo) }}" required placeholder="Mínimo permitido">
                    </div>
                    <div class="mb-3">
                        <label for="stock_bajo" class="form-label">Stock bajo</label>
                        <input type="number" class="form-control" id="stock_bajo" name="stock_bajo" value="{{ old('stock_bajo', $producto->stock_bajo) }}" required placeholder="Alerta de bajo stock">
                    </div>
                    <div class="mb-3">
                        <label for="stock_alto" class="form-label">Stock alto</label>
                        <input type="number" class="form-control" id="stock_alto" name="stock_alto" value="{{ old('stock_alto', $producto->stock_alto) }}" required placeholder="Alerta de sobre stock">
                    </div>
                    <button type="submit" class="btn btn-primary d-grid w-100">Actualizar</button>
                    <a href="{{ route('productos.index') }}" class="btn btn-link d-block text-center mt-2">Volver</a>
                </form>
            </div>
        </div>
        <!-- /Edit Producto Card -->
    </div>
</div>
@endsection
