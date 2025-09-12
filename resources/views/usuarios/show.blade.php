@extends('layouts.app')

@section('title', 'Ver Usuario')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary me-3">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h1 class="h3 mb-0">
                <i class="bi bi-person me-2"></i>
                Perfil de Usuario
            </h1>
        </div>

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="d-flex align-items-center">
                            <div class="avatar bg-white text-primary rounded-circle d-flex align-items-center justify-content-center me-3"
                                 style="width: 50px; height: 50px; font-size: 20px; font-weight: bold;">
                                {{ strtoupper(substr($usuario->nombre, 0, 1) . substr($usuario->apellido, 0, 1)) }}
                            </div>
                            <div>
                                <h5 class="mb-0">{{ $usuario->nombre }} {{ $usuario->apellido }}</h5>
                                <small class="opacity-75">ID: {{ $usuario->id }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('usuarios.edit', $usuario->id) }}">
                                        <i class="bi bi-pencil me-2"></i>
                                        Editar Usuario
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('usuarios.destroy', $usuario->id) }}"
                                          method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-trash me-2"></i>
                                            Eliminar Usuario
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">
                                <i class="bi bi-card-text me-1"></i>
                                RUT
                            </h6>
                            <p class="h5 mb-0">{{ $usuario->rut }}</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">
                                <i class="bi bi-envelope me-1"></i>
                                Correo Electrónico
                            </h6>
                            <p class="h5 mb-0">
                                <a href="mailto:{{ $usuario->email }}" class="text-decoration-none">
                                    {{ $usuario->email }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">
                                <i class="bi bi-person me-1"></i>
                                Nombre
                            </h6>
                            <p class="h5 mb-0">{{ $usuario->nombre }}</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">
                                <i class="bi bi-person me-1"></i>
                                Apellido
                            </h6>
                            <p class="h5 mb-0">{{ $usuario->apellido }}</p>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h6 class="text-muted mb-2">
                                <i class="bi bi-calendar-plus me-1"></i>
                                Fecha de Registro
                            </h6>
                            <p class="mb-0">
                                @if($usuario->created_at)
                                    {{ $usuario->created_at->format('d/m/Y H:i:s') }}
                                    <br>
                                    <small class="text-muted">
                                        ({{ $usuario->created_at->diffForHumans() }})
                                    </small>
                                @else
                                    <span class="text-muted">No disponible</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <h6 class="text-muted mb-2">
                                <i class="bi bi-calendar-check me-1"></i>
                                Última Actualización
                            </h6>
                            <p class="mb-0">
                                @if($usuario->updated_at)
                                    {{ $usuario->updated_at->format('d/m/Y H:i:s') }}
                                    <br>
                                    <small class="text-muted">
                                        ({{ $usuario->updated_at->diffForHumans() }})
                                    </small>
                                @else
                                    <span class="text-muted">No disponible</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>
                        Volver al Listado
                    </a>
                    <div>
                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil me-1"></i>
                            Editar Usuario
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estadísticas adicionales -->
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-shield-check display-6 text-success"></i>
                        <h6 class="card-title mt-2">Estado</h6>
                        <span class="badge bg-success">Activo</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-calendar-event display-6 text-primary"></i>
                        <h6 class="card-title mt-2">Días Registrado</h6>
                        <strong>
                            {{ $usuario->created_at ? $usuario->created_at->diffInDays(now()) : 0 }}
                        </strong>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-clock display-6 text-info"></i>
                        <h6 class="card-title mt-2">Última Actividad</h6>
                        <small class="text-muted">
                            {{ $usuario->updated_at ? $usuario->updated_at->diffForHumans() : 'N/A' }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
