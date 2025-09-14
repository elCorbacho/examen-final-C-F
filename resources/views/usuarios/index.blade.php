@extends('layouts.app')
@section('content')
<div class="authentication-wrapper authentication-cover d-flex justify-content-center">
    <div class="authentication-inner row justify-content-center w-100 m-0">
        <!-- Usuarios Card -->
        <div class="d-flex col-lg-10 align-items-center authentication-bg p-0 justify-content-center mx-auto">
            <div class="w-100 p-4 p-sm-5">
                <div class="mb-2">
                    <h4 class="mb-0">Usuarios</h4>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="{{ route('usuarios.create') }}" class="btn btn-success">Nuevo usuario</a>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-secondary">Cerrar sesión</button>
                    </form>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>RUT</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Email</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($usuarios as $usuario)
                                        <tr>
                                            <td>{{ $usuario->id }}</td>
                                            <td>{{ $usuario->rut }}</td>
                                            <td>{{ $usuario->nombre }}</td>
                                            <td>{{ $usuario->apellido }}</td>
                                            <td>{{ $usuario->email }}</td>
                                            <td>
                                                <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-info btn-sm me-1">Ver</a>
                                                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning btn-sm me-1">Editar</a>
                                                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro?')">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Usuarios Card -->
    </div>
</div>
@endsection
