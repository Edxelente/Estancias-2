@extends('layouts.app')
@section('title', 'Reportes')
@section('css')
    <link href="{{ asset('css/Reporte/index.css') }}" rel="stylesheet">
@endsection
@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('reportes.reabastecimiento') }}" class="btn btn-primary" style="margin-right: 10px;">Ir a Reabastecimiento</a>
    <a href="{{ route('reportes.productosMasVendidos') }}" class="btn btn-primary">Productos Más Vendidos</a>
    <a href="{{ route('reportes.rentabilidad') }}" class="btn btn-primary">Análisis de Rentabilidad</a>
    <a href="{{ route('reportes.comparacionVentas') }}" class="btn btn-primary">Comparación de Ventas</a>
    <a href="{{ route('reportes.clientesGastado') }}" class="btn btn-primary">Total Gastado por Cliente</a>
</div>
    <h1>Reportes</h1>

    <!-- Métricas principales -->
    <div style="display: flex; gap: 20px; margin-bottom: 20px;">
        <div style="border: 1px solid #ccc; padding: 20px;">
            <h3>Total de Productos</h3>
            <p><strong>{{ $productos->count() }}</strong></p>
        </div>
        <div style="border: 1px solid #ccc; padding: 20px;">
            <h3>Productos con Bajo Stock</h3>
            <p><strong>{{ $productos->where('stock', '<', 10)->count() }}</strong></p>
        </div>
        <div style="border: 1px solid #ccc; padding: 20px;">
            <h3>Total de Clientes</h3>
            <p><strong>{{ $clientes->count() }}</strong></p>
        </div>
        <div style="border: 1px solid #ccc; padding: 20px;">
            <h3>Total de Ventas</h3>
            <p><strong>${{ number_format($ventas->sum('total'), 2) }}</strong></p>
        </div>
    </div>
 
    <!-- Tabla de productos -->
    <h2>Inventario</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Stock</th>
                <th>Costo ($)</th>
                <th>Precio ($)</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($productos as $producto)
                <tr>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td>${{ number_format($producto->costo, 2) }}</td>
                    <td>${{ number_format($producto->precio, 2) }}</td>
                    <td>
                        @if ($producto->stock < 10)
                            <span class="bajo-stock">Bajo stock</span>
                        @else
                            <span class="suficiente-stock">Suficiente</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay productos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Tabla de ventas -->
    <h2>Ventas</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID Venta</th>
                <th>Cliente</th>
                <th>Total ($)</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ventas as $venta)
                <tr>
                    <td>{{ $venta->id }}</td>
                    <td>{{ $venta->cliente->nombre ?? 'N/A' }}</td>
                    <td>${{ number_format($venta->total, 2) }}</td>
                    <td>{{ $venta->created_at->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay ventas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Tabla de clientes -->
    <h2>Clientes</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID Cliente</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->telefono }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay clientes registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
