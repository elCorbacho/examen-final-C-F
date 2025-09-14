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
                                <!-- Modal Vuexy de éxito al crear producto -->
                                <div class="modal fade" id="creacionExitoModal" tabindex="-1" aria-labelledby="creacionExitoLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-header bg-success text-white rounded-top">
                                                <h5 class="modal-title" id="creacionExitoLabel">
                                                    <i class="ti ti-check-circle me-2"></i>Producto creado
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <i class="ti ti-check display-4 text-success mb-3"></i>
                                                <p class="mb-0">{{ session('success') }}</p>
                                            </div>
                                            <div class="modal-footer border-0 justify-content-center">
                                                <button type="button" class="btn" style="background-color: #7367f0; color: #fff;" data-bs-dismiss="modal">Aceptar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var modal = new bootstrap.Modal(document.getElementById('creacionExitoModal'));
                                        modal.show();
                                    });
                                </script>
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
                                                    <button type="button" class="btn btn-outline-danger btn-sm" title="Eliminar" onclick="mostrarModalEliminarProducto('form-eliminar-{{ $producto->id }}')"><i class="ti ti-trash"></i></button>
                                                    <form id="form-eliminar-{{ $producto->id }}" action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:none;">
                                                        @csrf
                                                        @method('DELETE')
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
<!-- Modal Eliminar Producto (Vuexy style) -->
<div class="modal fade" id="eliminarProductoModal" tabindex="-1" aria-labelledby="eliminarProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white rounded-top">
                <h5 class="modal-title" id="eliminarProductoLabel">
                    <i class="ti ti-trash me-2"></i>Eliminar producto
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body text-center">
                <p class="mb-0">¿Seguro que deseas eliminar este producto?</p>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn btn-danger px-4" id="confirmarEliminarProducto">Sí</button>
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<script>
    let formEliminarProductoId = null;
    function mostrarModalEliminarProducto(formId) {
        formEliminarProductoId = formId;
        var modal = new bootstrap.Modal(document.getElementById('eliminarProductoModal'));
        modal.show();
    }
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('confirmarEliminarProducto').onclick = function() {
            if(formEliminarProductoId) document.getElementById(formEliminarProductoId).submit();
        };
    });
</script>
@endsection
