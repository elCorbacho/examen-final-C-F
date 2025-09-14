@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex align-items-center mb-4">
        <h2 class="mb-0 fw-bold text-dark">Dashboard</h2>
    </div>
    <div class="row g-4">
        <!-- Usuarios Card -->
        <div class="col-12 col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-primary bg-gradient rounded-circle d-flex align-items-center justify-content-center me-3" style="width:56px;height:56px;">
                        <i class="ti ti-users text-white" style="font-size:2rem;"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Usuarios</div>
                        <div class="fs-2 fw-bold text-primary mb-0">{{ $usuarios }}</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Productos Card -->
        <div class="col-12 col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-success bg-gradient rounded-circle d-flex align-items-center justify-content-center me-3" style="width:56px;height:56px;">
                        <i class="ti ti-package text-white" style="font-size:2rem;"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Productos</div>
                        <div class="fs-2 fw-bold text-success mb-0">{{ $productos }}</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Clientes Card -->
        <div class="col-12 col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-info bg-gradient rounded-circle d-flex align-items-center justify-content-center me-3" style="width:56px;height:56px;">
                        <i class="ti ti-address-book text-white" style="font-size:2rem;"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Clientes</div>
                        <div class="fs-2 fw-bold text-info mb-0">{{ $clientes }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
