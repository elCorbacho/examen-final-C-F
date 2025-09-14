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
                    <!-- Modal Vuexy de éxito al crear cliente -->
                    <div class="modal fade" id="creacionExitoModal" tabindex="-1" aria-labelledby="creacionExitoLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow">
                          <div class="modal-header bg-success text-white rounded-top">
                            <h5 class="modal-title" id="creacionExitoLabel">
                              <i class="ti ti-check-circle me-2"></i>Cliente creado
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

                @if(session('deleted'))
                    <!-- Modal Vuexy de éxito al eliminar cliente -->
                    <div class="modal fade" id="eliminacionExitoModal" tabindex="-1" aria-labelledby="eliminacionExitoLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow">
                          <div class="modal-header bg-danger text-white rounded-top">
                            <h5 class="modal-title" id="eliminacionExitoLabel">
                              <i class="ti ti-trash me-2"></i>Cliente eliminado
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                          </div>
                          <div class="modal-body text-center">
                            <i class="ti ti-trash display-4 text-danger mb-3"></i>
                            <p class="mb-0">{{ session('deleted') }}</p>
                          </div>
                          <div class="modal-footer border-0 justify-content-center">
                            <button type="button" class="btn" style="background-color: #7367f0; color: #fff;" data-bs-dismiss="modal">Aceptar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <script>
                      document.addEventListener('DOMContentLoaded', function() {
                        var modal = new bootstrap.Modal(document.getElementById('eliminacionExitoModal'));
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
                                                    <button type="button" class="btn btn-outline-danger btn-sm" title="Eliminar" onclick="mostrarModalEliminarCliente('form-eliminar-{{ $cliente->id }}')"><i class="ti ti-trash"></i></button>
<form id="form-eliminar-{{ $cliente->id }}" action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:none;">
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
        <!-- /Clientes Card -->
    </div>
</div>

<!-- Modal Eliminar Cliente (Vuexy style) -->
<div class="modal fade" id="eliminarClienteModal" tabindex="-1" aria-labelledby="eliminarClienteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-danger text-white rounded-top">
        <h5 class="modal-title" id="eliminarClienteLabel">
          <i class="ti ti-trash me-2"></i>Eliminar cliente
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body text-center">
        <p class="mb-0">¿Seguro que deseas eliminar este cliente?</p>
      </div>
      <div class="modal-footer border-0 justify-content-center">
        <button type="button" class="btn btn-danger px-4" id="confirmarEliminarCliente">Sí</button>
        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
<script>
  let formEliminarClienteId = null;
  function mostrarModalEliminarCliente(formId) {
    formEliminarClienteId = formId;
    var modal = new bootstrap.Modal(document.getElementById('eliminarClienteModal'));
    modal.show();
  }
  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('confirmarEliminarCliente').onclick = function() {
      if(formEliminarClienteId) document.getElementById(formEliminarClienteId).submit();
    };
  });
</script>
@endsection
