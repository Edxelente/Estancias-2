@extends('layouts.app')

@section('content')
    <h1>Reporte de Clientes</h1>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%;">
        <thead>
            <tr>
                <th>ID Cliente</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Total de Compras</th>
                <th>Total Gastado ($)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->ventas->count() }}</td>
                    <td>${{ number_format($cliente->total_gastado, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No hay clientes registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
