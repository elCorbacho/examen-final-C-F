@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-outline-secondary me-3">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h1 class="h3 mb-0">
                <i class="bi bi-pencil me-2"></i>
                Editar Usuario: {{ $usuario->nombre }} {{ $usuario->apellido }}
            </h1>
        </div>

        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <div class="d-flex align-items-center">
                    <div class="avatar bg-dark text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                         style="width: 40px; height: 40px; font-size: 16px;">
                        {{ strtoupper(substr($usuario->nombre, 0, 1) . substr($usuario->apellido, 0, 1)) }}
                    </div>
                    <div>
                        <h6 class="mb-0">Editando Usuario</h6>
                        <small>ID: {{ $usuario->id }} | RUT: {{ $usuario->rut }}</small>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="rut" class="form-label">
                                    <i class="bi bi-card-text me-1"></i>
                                    RUT <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       class="form-control @error('rut') is-invalid @enderror"
                                       id="rut"
                                       name="rut"
                                       value="{{ old('rut', $usuario->rut) }}"
                                       placeholder="Ej: 12345678-9"
                                       required>
                                @error('rut')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="bi bi-envelope me-1"></i>
                                    Correo Electrónico <span class="text-danger">*</span>
                                </label>
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       id="email"
                                       name="email"
                                       value="{{ old('email', $usuario->email) }}"
                                       placeholder="usuario@ejemplo.com"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">
                                    <i class="bi bi-person me-1"></i>
                                    Nombre <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       class="form-control @error('nombre') is-invalid @enderror"
                                       id="nombre"
                                       name="nombre"
                                       value="{{ old('nombre', $usuario->nombre) }}"
                                       placeholder="Nombre"
                                       required>
                                @error('nombre')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="apellido" class="form-label">
                                    <i class="bi bi-person me-1"></i>
                                    Apellido <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       class="form-control @error('apellido') is-invalid @enderror"
                                       id="apellido"
                                       name="apellido"
                                       value="{{ old('apellido', $usuario->apellido) }}"
                                       placeholder="Apellido"
                                       required>
                                @error('apellido')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h6 class="text-muted mb-3">
                        <i class="bi bi-lock me-1"></i>
                        Cambiar Contraseña (opcional)
                    </h6>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <i class="bi bi-lock me-1"></i>
                                    Nueva Contraseña
                                </label>
                                <input type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       id="password"
                                       name="password"
                                       placeholder="Dejar vacío para mantener la actual">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    Mínimo 6 caracteres. Dejar vacío si no desea cambiarla.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">
                                    <i class="bi bi-lock-fill me-1"></i>
                                    Confirmar Nueva Contraseña
                                </label>
                                <input type="password"
                                       class="form-control @error('password_confirmation') is-invalid @enderror"
                                       id="password_confirmation"
                                       name="password_confirmation"
                                       placeholder="Repetir nueva contraseña">
                                @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i>
                                Cancelar
                            </a>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-check-circle me-1"></i>
                                Guardar Cambios
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Información del usuario -->
        <div class="mt-3">
            <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i>
                <strong>Información:</strong>
                <ul class="mb-0 mt-2">
                    <li>Los campos marcados con <span class="text-danger">*</span> son obligatorios.</li>
                    <li>Para cambiar la contraseña, complete ambos campos de contraseña.</li>
                    <li>Si no desea cambiar la contraseña, deje los campos en blanco.</li>
                    <li>Usuario registrado el: {{ $usuario->created_at ? $usuario->created_at->format('d/m/Y H:i') : 'N/A' }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Formatear RUT mientras se escribe
    document.getElementById('rut').addEventListener('input', function(e) {
        let value = e.target.value.replace(/[^\dkK]/g, '');
        if (value.length > 1) {
            value = value.slice(0, -1) + '-' + value.slice(-1);
        }
        e.target.value = value;
    });

    // Validar confirmación de contraseña
    document.getElementById('password_confirmation').addEventListener('input', function(e) {
        const password = document.getElementById('password').value;
        const confirmation = e.target.value;

        if (password !== confirmation && confirmation.length > 0) {
            e.target.classList.add('is-invalid');
        } else {
            e.target.classList.remove('is-invalid');
        }
    });

    // Limpiar confirmación si se borra la contraseña principal
    document.getElementById('password').addEventListener('input', function(e) {
        const confirmation = document.getElementById('password_confirmation');
        if (e.target.value === '') {
            confirmation.value = '';
            confirmation.classList.remove('is-invalid');
        }
    });
</script>
@endsection
