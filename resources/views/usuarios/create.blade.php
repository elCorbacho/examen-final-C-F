@extends('layouts.app')
@section('content')
<div class="authentication-wrapper authentication-cover d-flex justify-content-center">
    <div class="authentication-inner row justify-content-center w-100 m-0">
        <!-- Create User Card -->
        <div class="d-flex col-lg-5 align-items-center authentication-bg p-0 justify-content-center mx-auto">
            <div class="w-100 p-4 p-sm-5">
                <div class="mb-4 text-center">
                    <h4 class="mb-2">Crear usuario</h4>
                    <p class="mb-4">Completa el formulario para crear un usuario</p>
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
                <form method="POST" action="{{ route('usuarios.store') }}" class="mb-3">
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
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required placeholder="ejemplo@email.com">
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
                    <button type="submit" class="btn btn-primary d-grid w-100">Crear</button>
                    <a href="{{ route('usuarios.index') }}" class="btn btn-link d-block text-center mt-2">Volver</a>
                </form>
            </div>
        </div>
        <!-- /Create User Card -->
    </div>
</div>
@endsection
