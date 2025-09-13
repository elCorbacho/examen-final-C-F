@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Clientes</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('clientes.create') }}" class="btn btn-success mb-2">Nuevo cliente</a>
    <a href="{{ route('usuarios.index') }}" class="btn btn-link">Usuarios</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>RUT Empresa</th>
                <th>Rubro</th>
                <th>Razón Social</th>
                <th>Teléfono</th>
                <th>Contacto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->rut_empresa }}</td>
                    <td>{{ $cliente->rubro }}</td>
                    <td>{{ $cliente->razon_social }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->contacto_nombre }}<br>{{ $cliente->contacto_correo }}</td>
                    <td>
                        <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline">
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
@endsection
