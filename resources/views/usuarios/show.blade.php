@extends('layouts.app')
@section('content')
<div class="authentication-wrapper authentication-cover d-flex justify-content-center">
    <div class="authentication-inner row justify-content-center w-100 m-0">
        <!-- User Detail Card -->
        <div class="d-flex col-lg-5 align-items-center authentication-bg p-0 justify-content-center mx-auto">
            <div class="w-100 p-4 p-sm-5">
                <div class="mb-4 text-center">
                    <h4 class="mb-2">Detalle de usuario</h4>
                </div>
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">{{ $usuario->nombre }} {{ $usuario->apellido }}</h5>
                        <p class="card-text mb-1"><strong>RUT:</strong> {{ $usuario->rut }}</p>
                        <p class="card-text mb-3"><strong>Email:</strong> {{ $usuario->email }}</p>
                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning me-2">Editar</a>
                        <a href="{{ route('usuarios.index') }}" class="btn btn-link">Volver</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /User Detail Card -->
    </div>
</div>
@endsection
