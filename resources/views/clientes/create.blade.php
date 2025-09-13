@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Crear cliente</h2>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('clientes.store') }}">
        @csrf
        <div class="mb-3">
            <label for="rut_empresa" class="form-label">RUT Empresa</label>
            <input type="text" class="form-control" id="rut_empresa" name="rut_empresa" value="{{ old('rut_empresa') }}" required>
        </div>
        <div class="mb-3">
            <label for="rubro" class="form-label">Rubro</label>
            <input type="text" class="form-control" id="rubro" name="rubro" value="{{ old('rubro') }}" required>
        </div>
        <div class="mb-3">
            <label for="razon_social" class="form-label">Razón Social</label>
            <input type="text" class="form-control" id="razon_social" name="razon_social" value="{{ old('razon_social') }}" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}">
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion') }}">
        </div>
        <div class="mb-3">
            <label for="contacto_nombre" class="form-label">Nombre de contacto</label>
            <input type="text" class="form-control" id="contacto_nombre" name="contacto_nombre" value="{{ old('contacto_nombre') }}">
        </div>
        <div class="mb-3">
            <label for="contacto_correo" class="form-label">Correo de contacto</label>
            <input type="email" class="form-control" id="contacto_correo" name="contacto_correo" value="{{ old('contacto_correo') }}">
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-link">Volver</a>
    </form>
</div>
@endsection
