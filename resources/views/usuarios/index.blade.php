@extends('layouts.app')

@section('title', 'Lista de Usuarios')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">
        <i class="bi bi-people me-2"></i>
        Gestión de Usuarios
    </h1>
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
        <i class="bi bi-person-plus me-1"></i>
        Nuevo Usuario
    </a>
</div>

<div class="card shadow">
    <div class="card-body">
        @if($usuarios->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">
                                <i class="bi bi-hash me-1"></i>
                                ID
                            </th>
                            <th scope="col">
                                <i class="bi bi-card-text me-1"></i>
                                RUT
                            </th>
                            <th scope="col">
                                <i class="bi bi-person me-1"></i>
                                Nombre Completo
                            </th>
                            <th scope="col">
                                <i class="bi bi-envelope me-1"></i>
                                Email
                            </th>
                            <th scope="col">
                                <i class="bi bi-calendar me-1"></i>
                                Fecha Registro
                            </th>
                            <th scope="col" class="text-center">
                                <i class="bi bi-gear me-1"></i>
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                        <tr>
                            <td>
                                <span class="badge bg-secondary">{{ $usuario->id }}</span>
                            </td>
                            <td>
                                <strong>{{ $usuario->rut }}</strong>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                                         style="width: 32px; height: 32px; font-size: 14px;">
                                        {{ strtoupper(substr($usuario->nombre, 0, 1) . substr($usuario->apellido, 0, 1)) }}
                                    </div>
                                    {{ $usuario->nombre }} {{ $usuario->apellido }}
                                </div>
                            </td>
                            <td>
                                <a href="mailto:{{ $usuario->email }}" class="text-decoration-none">
                                    {{ $usuario->email }}
                                </a>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $usuario->created_at ? $usuario->created_at->format('d/m/Y H:i') : 'N/A' }}
                                </small>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('usuarios.show', $usuario->id) }}"
                                       class="btn btn-outline-info btn-sm" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('usuarios.edit', $usuario->id) }}"
                                       class="btn btn-outline-warning btn-sm" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('usuarios.destroy', $usuario->id) }}"
                                          method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" title="Eliminar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-person-x display-1 text-muted"></i>
                <h4 class="text-muted mt-3">No hay usuarios registrados</h4>
                <p class="text-muted">Comienza agregando el primer usuario al sistema.</p>
                <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
                    <i class="bi bi-person-plus me-1"></i>
                    Crear Primer Usuario
                </a>
            </div>
        @endif
    </div>
</div>

@if($usuarios->count() > 0)
<div class="mt-3">
    <small class="text-muted">
        <i class="bi bi-info-circle me-1"></i>
        Total de usuarios: <strong>{{ $usuarios->count() }}</strong>
    </small>
</div>
@endif
@endsection
