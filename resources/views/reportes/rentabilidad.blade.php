@extends('layouts.app')

@section('title', 'Análisis de Rentabilidad')

@section('content')
    <h1>Análisis de Rentabilidad</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Stock</th>
                <th>Costo Total ($)</th>
                <th>Precio Unitario ($)</th>
                <th>Rentabilidad por Unidad ($)</th>
                <th>Rentabilidad Total ($)</th>
                <th>Rentabilidad (%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td>${{ number_format($producto->costo, 2) }}</td>
                    <td>${{ number_format($producto->precio, 2) }}</td>
                    <td>${{ number_format($producto->rentabilidad, 2) }}</td>
                    <td>${{ number_format($producto->rentabilidad_total, 2) }}</td>
                    <td>{{ number_format($producto->rentabilidad_porcentaje, 2) }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
