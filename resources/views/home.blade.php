@extends('layouts.app')

@section('title', 'Bienvenido')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="text-center mb-5">
            <h1 class="display-4 mb-3">
                <i class="bi bi-house-door me-3 text-primary"></i>
                Bienvenido al Sistema
            </h1>
            <p class="lead text-muted">Sistema de Gestión de Usuarios - Examen Final</p>
        </div>

        <div class="row g-4">
            <!-- Card de Usuarios -->
            <div class="col-md-6">
                <div class="card h-100 shadow hover-shadow">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-people display-1 text-primary"></i>
                        </div>
                        <h5 class="card-title">Gestión de Usuarios</h5>
                        <p class="card-text text-muted">
                            Administra usuarios del sistema: crear, editar, ver y eliminar registros de usuarios.
                        </p>
                        <div class="d-grid gap-2">
                            <a href="{{ route('usuarios.index') }}" class="btn btn-primary">
                                <i class="bi bi-eye me-1"></i>
                                Ver Usuarios
                            </a>
                            <a href="{{ route('usuarios.create') }}" class="btn btn-outline-primary">
                                <i class="bi bi-person-plus me-1"></i>
                                Crear Usuario
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card de Login -->
            <div class="col-md-6">
                <div class="card h-100 shadow hover-shadow">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-box-arrow-in-right display-1 text-success"></i>
                        </div>
                        <h5 class="card-title">Acceso al Sistema</h5>
                        <p class="card-text text-muted">
                            Inicia sesión para acceder a las funcionalidades completas del sistema.
                        </p>
                        <div class="d-grid gap-2">
                            @if(Auth::check())
                                <div class="alert alert-success">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Bienvenido, {{ Auth::user()->nombre }}!
                                </div>
                                <form action="{{ route('usuarios.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="bi bi-box-arrow-right me-1"></i>
                                        Cerrar Sesión
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('usuarios.login') }}" class="btn btn-success">
                                    <i class="bi bi-box-arrow-in-right me-1"></i>
                                    Iniciar Sesión
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estadísticas del sistema -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">
                            <i class="bi bi-graph-up me-1"></i>
                            Estadísticas del Sistema
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-4">
                                <div class="p-3">
                                    <i class="bi bi-people display-4 text-primary mb-2"></i>
                                    <h4>{{ \App\Models\usuario::count() }}</h4>
                                    <p class="text-muted mb-0">Usuarios Registrados</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3">
                                    <i class="bi bi-calendar-check display-4 text-success mb-2"></i>
                                    <h4>{{ \App\Models\usuario::whereDate('created_at', today())->count() }}</h4>
                                    <p class="text-muted mb-0">Registros Hoy</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3">
                                    <i class="bi bi-clock-history display-4 text-info mb-2"></i>
                                    <h4>{{ \App\Models\usuario::whereDate('updated_at', today())->count() }}</h4>
                                    <p class="text-muted mb-0">Actualizaciones Hoy</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información adicional -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="alert alert-info">
                    <h6 class="alert-heading">
                        <i class="bi bi-info-circle me-2"></i>
                        Funcionalidades Implementadas
                    </h6>
                    <ul class="mb-0">
                        <li><strong>CRUD Completo:</strong> Crear, Leer, Actualizar y Eliminar usuarios</li>
                        <li><strong>Autenticación:</strong> Sistema de login/logout</li>
                        <li><strong>Validaciones:</strong> Validación de datos en formularios</li>
                        <li><strong>Interfaz Moderna:</strong> Diseño responsivo con Bootstrap</li>
                        <li><strong>Notificaciones:</strong> Mensajes de éxito y error</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hover-shadow {
    transition: box-shadow 0.3s ease;
}

.hover-shadow:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}
</style>
@endsection
