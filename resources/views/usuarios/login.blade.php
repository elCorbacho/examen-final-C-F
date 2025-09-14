@extends('layouts.app')
@section('content')
<div class="authentication-wrapper authentication-cover">
    <div class="authentication-inner row m-0">
        <!-- Login Card -->
        <div class="d-flex col-lg-4 align-items-center authentication-bg p-0">
            <div class="w-100 p-4 p-sm-5">
                <div class="mb-4 text-center">
                    <h4 class="mb-2">Bienvenido👋</h4>
                    <p class="mb-4">Por favor, inicia sesión para continuar</p>
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
                <form method="POST" action="{{ route('login.post') }}" class="mb-3">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Ingresa tu email">
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control" name="password" required placeholder="············">
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                    </div>
                    <div class="mb-3 d-flex justify-content-between">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember-me" name="remember">
                            <label class="form-check-label" for="remember-me">Recordarme</label>
                        </div>
                        <!-- Puedes agregar un link de "¿Olvidaste tu contraseña?" aquí si lo deseas -->
                    </div>
                    <button type="submit" class="btn btn-primary d-grid w-100">Entrar</button>
                </form>
                <p class="text-center">
                    <span>¿No tienes cuenta?</span>
                    <a href="{{ route('register') }}">
                        <span>Registrarse</span>
                    </a>
                </p>
            </div>
        </div>
        <!-- /Login Card -->
        <div class="d-none d-lg-flex col-lg-8 align-items-center justify-content-center bg-body">
            <img src="{{ asset('assets/img/illustrations/Logo_IPSS.png') }}" alt="Login Illustration" class="img-fluid" style="max-width: 400px;">
        </div>
    </div>
</div>
@endsection
