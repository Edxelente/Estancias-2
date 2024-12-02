@extends('layouts.app')

@section('title', 'Lista de Clientes')

@section('css')
<link href="{{ asset('css/Clientes/clientes.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="clientes-container">
<form method="GET" action="{{ route('clientes.index') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="buscar" class="form-control" placeholder="Buscar cliente..." value="{{ request('buscar') }}">
        <button type="submit" class="btn btn-info">Buscar</button>
    </div>
</form>
    <h1>Lista de Clientes</h1>
    <a href="{{ route('clientes.create') }}">Registrar Nuevo Cliente</a>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>
                        <a href="{{ route('clientes.edit', $cliente) }}">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
