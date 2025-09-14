@extends('layouts.app')
@section('content')
<div class="authentication-wrapper authentication-cover d-flex justify-content-center">
    <div class="authentication-inner row justify-content-center w-100 m-0">
        <!-- Clientes Card -->
        <div class="d-flex col-lg-10 align-items-center authentication-bg p-0 justify-content-center mx-auto">
            <div class="w-100 p-4 p-sm-5">
                <div class="mb-2">
                    <h4 class="mb-0">Clientes</h4>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="{{ route('clientes.create') }}" class="btn btn-success">Nuevo cliente</a>
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
                                                <div class="btn-group" role="group" aria-label="Acciones">
                                                    <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-info btn-sm" title="Ver"><i class="ti ti-eye"></i></a>
                                                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning btn-sm" title="Editar"><i class="ti ti-pencil"></i></a>
                                                    <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm" title="Eliminar" onclick="return confirm('¿Seguro?')"><i class="ti ti-trash"></i></button>
                                                    </form>
                                                </div>
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
        <!-- /Clientes Card -->
    </div>
</div>
@endsection
