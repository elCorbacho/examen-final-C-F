@extends('layouts.app')
@section('content')
<div class="authentication-wrapper authentication-cover d-flex justify-content-center">
    <div class="authentication-inner row justify-content-center w-100 m-0">
        <!-- Editar Cliente Card -->
        <div class="d-flex col-lg-6 align-items-center authentication-bg p-0 justify-content-center mx-auto">
            <div class="w-100 p-4 p-sm-5">
                <div class="mb-4 text-center">
                    <h4 class="mb-2">Editar cliente</h4>
                    <p class="mb-4">Modifica los datos del cliente</p>
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
                <form method="POST" action="{{ route('clientes.update', $cliente->id) }}" class="mb-3">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="rut_empresa" class="form-label">RUT Empresa</label>
                        <input type="text" class="form-control" id="rut_empresa" name="rut_empresa" value="{{ old('rut_empresa', $cliente->rut_empresa) }}" required placeholder="Ej: 12.345.678-9">
                    </div>
                    <div class="mb-3">
                        <label for="rubro" class="form-label">Rubro</label>
                        <input type="text" class="form-control" id="rubro" name="rubro" value="{{ old('rubro', $cliente->rubro) }}" required placeholder="Rubro de la empresa">
                    </div>
                    <div class="mb-3">
                        <label for="razon_social" class="form-label">Razón Social</label>
                        <input type="text" class="form-control" id="razon_social" name="razon_social" value="{{ old('razon_social', $cliente->razon_social) }}" required placeholder="Razón social">
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $cliente->telefono) }}" placeholder="Teléfono de contacto">
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion', $cliente->direccion) }}" placeholder="Dirección de la empresa">
                    </div>
                    <div class="mb-3">
                        <label for="contacto_nombre" class="form-label">Nombre de contacto</label>
                        <input type="text" class="form-control" id="contacto_nombre" name="contacto_nombre" value="{{ old('contacto_nombre', $cliente->contacto_nombre) }}" placeholder="Nombre del contacto">
                    </div>
                    <div class="mb-3">
                        <label for="contacto_correo" class="form-label">Correo de contacto</label>
                        <input type="email" class="form-control" id="contacto_correo" name="contacto_correo" value="{{ old('contacto_correo', $cliente->contacto_correo) }}" placeholder="correo@ejemplo.com">
                    </div>
                    <button type="submit" class="btn btn-primary d-grid w-100">Actualizar</button>
                    <a href="{{ route('clientes.index') }}" class="btn btn-link d-block text-center mt-2">Volver</a>
                </form>
            </div>
        </div>
        <!-- /Editar Cliente Card -->
    </div>
</div>
@endsection
