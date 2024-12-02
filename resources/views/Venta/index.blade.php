@extends('layouts.app')

@section('title', 'Listado de Ventas')
@section('css')
    <link href="{{ asset('css/Ventas/index.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container-venta">
<form method="GET" action="{{ route('ventas.index') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="buscar" class="form-control" placeholder="Buscar venta..." value="{{ request('buscar') }}">
        <button type="submit" class="btn btn-info">Buscar</button>
    </div>
</form>
    <h1>Listado de Ventas</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('ventas.create') }}" class="btn btn-primary mb-3">Registrar Venta</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
            <tr>
                <td>{{ $venta->producto->nombre }}</td>
                <td>{{ $venta->cantidad }}</td>
                <td>${{ number_format($venta->total, 2) }}</td>
                <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $ventas->links() }}
</div>
@endsection
