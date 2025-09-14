@extends('layouts.app')
@section('content')
<div class="authentication-wrapper authentication-cover d-flex justify-content-center">
    <div class="authentication-inner row justify-content-center w-100 m-0">
        <!-- Detalle Cliente Card -->
        <div class="d-flex col-lg-6 align-items-center authentication-bg p-0 justify-content-center mx-auto">
            <div class="w-100 p-4 p-sm-5">
                <div class="mb-4 text-center">
                    <h4 class="mb-2">Detalle de cliente</h4>
                </div>
                <div class="card shadow-sm">
                    <div class="card-body text-start">
                        <div class="d-flex justify-content-end mb-3 gap-2">
                            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning">Editar</a>
                            <a href="{{ route('clientes.index') }}" class="btn btn-link">Volver</a>
                        </div>
                        <h5 class="card-title mb-3">{{ $cliente->razon_social }}</h5>
                        <p class="card-text mb-1"><strong>RUT Empresa:</strong> {{ $cliente->rut_empresa }}</p>
                        <p class="card-text mb-1"><strong>Rubro:</strong> {{ $cliente->rubro }}</p>
                        <p class="card-text mb-1"><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
                        <p class="card-text mb-1"><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
                        <p class="card-text mb-1"><strong>Contacto:</strong> {{ $cliente->contacto_nombre }} ({{ $cliente->contacto_correo }})</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Detalle Cliente Card -->
    </div>
</div>
@endsection
