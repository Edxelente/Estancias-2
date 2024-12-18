@extends('layouts.app')

@section('title', 'Panel de Estadísticas')

@section('css')
    <link href="{{ asset('css/Productos/estadisticas.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="dashboard-container">
<div class="container">
    <h1 class="title">Panel de Estadísticas</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-primary mb-3">
                <div class="card-body">
                    <h4>Total de Productos</h4>
                    <p>{{ $totalProductos }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-danger mb-3">
                <div class="card-body">
                    <h4>Productos con Bajo Stock</h4>
                    <p>{{ $bajoStock }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success mb-3">
                <div class="card-body">
                    <h4>Ganancias Potenciales</h4>
                    <p>${{ $ganancias }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
