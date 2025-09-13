@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Detalle de cliente</h2>
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $cliente->razon_social }}</h5>
            <p class="card-text"><strong>RUT Empresa:</strong> {{ $cliente->rut_empresa }}</p>
            <p class="card-text"><strong>Rubro:</strong> {{ $cliente->rubro }}</p>
            <p class="card-text"><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
            <p class="card-text"><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
            <p class="card-text"><strong>Contacto:</strong> {{ $cliente->contacto_nombre }} ({{ $cliente->contacto_correo }})</p>
            <div class="mt-3">
                <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning">Editar</a>
                <a href="{{ route('clientes.index') }}" class="btn btn-link">Volver</a>
            </div>
        </div>
    </div>
</div>
@endsection
