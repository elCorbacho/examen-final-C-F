@extends('layouts.app')
@section('content')
<div class="authentication-wrapper authentication-cover d-flex justify-content-center">
    <div class="authentication-inner row justify-content-center w-100 m-0">
        <!-- Edit User Card -->
        <div class="d-flex col-lg-5 align-items-center authentication-bg p-0 justify-content-center mx-auto">
            <div class="w-100 p-4 p-sm-5">
                <div class="mb-4 text-center">
                    <h4 class="mb-2">Editar usuario</h4>
                    <p class="mb-4">Modifica los datos del usuario</p>
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
                <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}" class="mb-3">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="rut" class="form-label">RUT</label>
                        <input type="text" class="form-control" id="rut" name="rut" value="{{ old('rut', $usuario->rut) }}" required placeholder="Ej: 12.345.678-9">
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" required placeholder="Tu nombre">
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido', $usuario->apellido) }}" required placeholder="Tu apellido">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $usuario->email) }}" required placeholder="ejemplo@email.com">
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label for="password" class="form-label">Contraseña <span class="text-muted">(dejar en blanco para no cambiar)</span></label>
                        <div class="input-group input-group-merge">
                            <input type="password" class="form-control" id="password" name="password" placeholder="············">
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                        <div class="input-group input-group-merge">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="············">
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary d-grid w-100">Actualizar</button>
                    <a href="{{ route('usuarios.index') }}" class="btn btn-link d-block text-center mt-2">Volver</a>
                </form>
            </div>
        </div>
        <!-- /Edit User Card -->
    </div>
</div>
@endsection
