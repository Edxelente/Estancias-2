@extends('layouts.app')

@section('title', 'Productos Más Vendidos')

@section('content')
    <h1>Productos Más Vendidos</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad Vendida</th>
                <th>Total Venta ($)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productosMasVendidos as $venta)
                <tr>
                    <td>{{ $venta->producto->nombre }}</td>
                    <td>{{ $venta->total_vendido }}</td> 
                    <td>${{ number_format($venta->total_venta, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
