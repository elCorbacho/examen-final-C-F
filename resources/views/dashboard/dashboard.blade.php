@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dashboard</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Usuarios</div>
                <div class="card-body">
                    <h3 class="card-title">{{ $usuarios }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Productos</div>
                <div class="card-body">
                    <h3 class="card-title">{{ $productos }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Clientes</div>
                <div class="card-body">
                    <h3 class="card-title">{{ $clientes }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
