@extends('layouts.app')
@section('content')
<div class="authentication-wrapper authentication-cover d-flex justify-content-center">
    <div class="authentication-inner row justify-content-center w-100 m-0">
        <!-- Register Card -->
        <div class="d-flex col-lg-5 align-items-center authentication-bg p-0 justify-content-center mx-auto">
            <div class="w-100 p-4 p-sm-5">
                <div class="mb-4 text-center">
                    <h4 class="mb-2">Crear cuenta</h4>
                    <p class="mb-4">Completa el formulario para registrarte</p>
                </div>
                                @if($errors->any())
                                        <div class="alert alert-danger">
                                                <ul class="mb-0">
                                                        @foreach($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                        @endforeach
                                                </ul>
                                        </div>
                                @endif

                                @if(session('success'))
<!-- Modal Vuexy de éxito al registrar usuario -->
<div class="modal fade" id="registroExitoModal" tabindex="-1" aria-labelledby="registroExitoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-success text-white rounded-top">
                <h5 class="modal-title" id="registroExitoLabel">
                    <i class="ti ti-check-circle me-2"></i>Registro exitoso
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body text-center">
                <i class="ti ti-check display-4 text-success mb-3"></i>
                <p class="mb-0">{{ session('success') }}</p>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn" style="background-color: #7367f0; color: #fff;" data-bs-dismiss="modal" id="aceptarRegistroBtn">Aceptar</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modal = new bootstrap.Modal(document.getElementById('registroExitoModal'));
        modal.show();
        document.getElementById('aceptarRegistroBtn').addEventListener('click', function() {
            window.location.href = "{{ route('login') }}";
        });
    });
</script>
@endif
                <form method="POST" action="{{ route('register.post') }}" class="mb-3">
                    @csrf
                    <div class="mb-3">
                        <label for="rut" class="form-label">RUT</label>
                        <input type="text" class="form-control" id="rut" name="rut" value="{{ old('rut') }}" required placeholder="Ej: 12.345.678-9">
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required placeholder="Tu nombre">
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido') }}" required placeholder="Tu apellido">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email') }}" required
                               placeholder="nombre.apellido@ventasfix.cl">
                        <div class="form-text">Debe tener el formato nombre.apellido@ventasfix.cl</div>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control" name="password" required placeholder="············">
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                        <div class="input-group input-group-merge">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="············">
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary d-grid w-100">Registrarse</button>
                </form>
                <p class="text-center">
                    <span>¿Ya tienes cuenta?</span>
                    <a href="{{ route('login') }}">
                        <span>Iniciar sesión</span>
                    </a>
                </p>
            </div>
        </div>
        <!-- /Register Card -->
    </div>
</div>
@endsection
