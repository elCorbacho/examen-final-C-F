@extends('layouts.app')
@section('content')
<div class="authentication-wrapper authentication-cover d-flex justify-content-center">
    <div class="authentication-inner row justify-content-center w-100 m-0">
        <!-- Detalle Usuario Card -->
        <div class="d-flex col-lg-6 align-items-center authentication-bg p-0 justify-content-center mx-auto">
            <div class="w-100 p-4 p-sm-5">
                <div class="mb-4 text-center">
                    <h4 class="mb-2">Detalle de usuario</h4>
                </div>
                <div class="card shadow-sm">
                    <div class="card-body text-start">
                        <div class="d-flex justify-content-end mb-3 gap-2">
                            <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning">Editar</a>
                            <a href="{{ route('usuarios.index') }}" class="btn btn-link">Volver</a>
                        </div>
                        <h5 class="card-title mb-3">{{ $usuario->nombre }} {{ $usuario->apellido }}</h5>
                        <p class="card-text mb-1"><strong>RUT:</strong> {{ $usuario->rut }}</p>
                        <p class="card-text mb-1"><strong>Email:</strong> {{ $usuario->email }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Detalle Usuario Card -->
    </div>
</div>
@endsection
