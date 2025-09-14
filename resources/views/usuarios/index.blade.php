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
                    <!-- Modal Vuexy de éxito al crear usuario -->
                    <div class="modal fade" id="creacionExitoModal" tabindex="-1" aria-labelledby="creacionExitoLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow">
                          <div class="modal-header bg-success text-white rounded-top">
                            <h5 class="modal-title" id="creacionExitoLabel">
                              <i class="ti ti-check-circle me-2"></i>Usuario creado
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                          </div>
                          <div class="modal-body text-center">
                            <i class="ti ti-check display-4 text-success mb-3"></i>
                            <p class="mb-0">{{ session('success') }}</p>
                          </div>
                          <div class="modal-footer border-0 justify-content-center">
                            <button type="button" class="btn" style="background-color: #7367f0; color: #fff;" data-bs-dismiss="modal">Aceptar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <script>
                      document.addEventListener('DOMContentLoaded', function() {
                        var modal = new bootstrap.Modal(document.getElementById('creacionExitoModal'));
                        modal.show();
                      });
                    </script>
                @endif
                @if(session('login_success'))
                <!-- Modal de éxito -->
                <div class="modal fade" id="loginExitosoModal" tabindex="-1" aria-labelledby="loginExitosoLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="loginExitosoLabel">Login exitoso</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                      </div>
                      <div class="modal-body">
                        {{ session('login_success') }}
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Aceptar</button>
                      </div>
                    </div>
                  </div>
                </div>
                <script>
                  document.addEventListener('DOMContentLoaded', function() {
                    var modal = new bootstrap.Modal(document.getElementById('loginExitosoModal'));
                    modal.show();
                  });
                </script>
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
                                                <div class="btn-group" role="group" aria-label="Acciones">
                                                    <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-info btn-sm" title="Ver"><i class="ti ti-eye"></i></a>
                                                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning btn-sm" title="Editar"><i class="ti ti-pencil"></i></a>
                                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="mostrarModalEliminarUsuario('form-eliminar-{{ $usuario->id }}')">
                                                      <i class="ti ti-trash"></i>
                                                    </button>
                                                    <form id="form-eliminar-{{ $usuario->id }}" action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:none;">
                                                      @csrf
                                                      @method('DELETE')
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
        <!-- /Usuarios Card -->
    </div>
</div>

<!-- Modal Eliminar Usuario (Vuexy style) -->
<div class="modal fade" id="eliminarUsuarioModal" tabindex="-1" aria-labelledby="eliminarUsuarioLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-danger text-white rounded-top">
        <h5 class="modal-title" id="eliminarUsuarioLabel">
          <i class="ti ti-trash me-2"></i>Eliminar usuario
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body text-center">
        <p class="mb-0">¿Seguro que deseas eliminar este usuario?</p>
      </div>
      <div class="modal-footer border-0 justify-content-center">
        <button type="button" class="btn btn-danger px-4" id="confirmarEliminarUsuario">Sí</button>
        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>

<script>
  let formEliminarId = null;
  function mostrarModalEliminarUsuario(formId) {
    formEliminarId = formId;
    var modal = new bootstrap.Modal(document.getElementById('eliminarUsuarioModal'));
    modal.show();
  }
  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('confirmarEliminarUsuario').onclick = function() {
      if(formEliminarId) document.getElementById(formEliminarId).submit();
    };
  });
</script>
@endsection
