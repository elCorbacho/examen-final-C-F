@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Iniciar sesión</h2>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="mb-3">
            <label for="login" class="form-label">RUT o Email</label>
            <input type="text" class="form-control" id="login" name="login" value="{{ old('login') }}" required autofocus>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
        <a href="{{ route('register') }}" class="btn btn-link">Registrarse</a>
    </form>
</div>
@endsection
