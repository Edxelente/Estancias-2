@extends('layouts.app')

@section('title', 'Total Gastado por Cliente')

@section('content')
    <h1>Total Gastado por Cliente</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID Cliente</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Total Gastado ($)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>${{ number_format($cliente->ventas_sum_total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
