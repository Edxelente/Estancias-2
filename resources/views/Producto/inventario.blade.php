@extends('layouts.app')

@section('title', 'Inventario de Productos')

@section('css')
    <link href="{{ asset('css/Productos/inventario.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-inventario">
    <h1>Inventario de Productos</h1>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total de Productos</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalProductos }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Bajo Stock</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $productosBajoStock }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Valor del Inventario</div>
                <div class="card-body">
                    <h5 class="card-title">${{ number_format($valorInventario, 2) }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Ingresos Esperados</div>
                <div class="card-body">
                    <h5 class="card-title">${{ number_format($ingresosEsperados, 2) }}</h5>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Stock</th>
                <th>Costo Unitario</th>
                <th>Precio Unitario</th>
                <th>Valor Total</th>
                <th>Ingreso Potencial</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->stock }}</td>
                <td>${{ number_format($producto->costo, 2) }}</td>
                <td>${{ number_format($producto->precio, 2) }}</td>
                <td>${{ number_format($producto->stock * $producto->costo, 2) }}</td>
                <td>${{ number_format($producto->stock * $producto->precio, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
