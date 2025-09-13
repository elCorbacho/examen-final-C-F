@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Detalle de usuario</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $usuario->nombre }} {{ $usuario->apellido }}</h5>
            <p class="card-text"><strong>RUT:</strong> {{ $usuario->rut }}</p>
            <p class="card-text"><strong>Email:</strong> {{ $usuario->email }}</p>
            <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('usuarios.index') }}" class="btn btn-link">Volver</a>
        </div>
    </div>
</div>
@endsection
