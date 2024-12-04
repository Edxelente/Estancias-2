@extends('layouts.app')

@section('title', 'Sugerencia de Reabastecimiento')

@section('content')
    <h1>Sugerencia de Reabastecimiento</h1>
    <table class="table">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Stock Actual</th>
            <th>Ventas Diarias Promedio</th>
            <th>Días Restantes</th>
            <th>Reabastecimiento Necesario</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->stock }}</td>
                <td>{{ $producto->ventas_diarias_promedio }}</td>
                <td>{{ $producto->dias_restantes }}</td> 
                <td>{{ $producto->reabastecimiento }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
