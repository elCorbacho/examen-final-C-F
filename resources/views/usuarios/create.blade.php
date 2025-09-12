@extends('layouts.app')

@section('title', 'Crear Usuario')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary me-3">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h1 class="h3 mb-0">
                <i class="bi bi-person-plus me-2"></i>
                Crear Nuevo Usuario
            </h1>
        </div>

        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('usuarios.store') }}" method="POST">
                    @csrf

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
                                       value="{{ old('rut') }}"
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
                                       value="{{ old('email') }}"
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
                                       value="{{ old('nombre') }}"
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
                                       value="{{ old('apellido') }}"
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

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <i class="bi bi-lock me-1"></i>
                                    Contraseña <span class="text-danger">*</span>
                                </label>
                                <input type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       id="password"
                                       name="password"
                                       placeholder="Mínimo 6 caracteres"
                                       required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">
                                    <i class="bi bi-lock-fill me-1"></i>
                                    Confirmar Contraseña <span class="text-danger">*</span>
                                </label>
                                <input type="password"
                                       class="form-control @error('password_confirmation') is-invalid @enderror"
                                       id="password_confirmation"
                                       name="password_confirmation"
                                       placeholder="Repite la contraseña"
                                       required>
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
                        <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i>
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-1"></i>
                            Crear Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-3">
            <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i>
                <strong>Información:</strong> Los campos marcados con <span class="text-danger">*</span> son obligatorios.
                La contraseña debe tener al menos 6 caracteres.
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
</script>
@endsection
