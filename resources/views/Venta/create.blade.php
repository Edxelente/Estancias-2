@extends('layouts.app')

@section('title', 'Registrar Venta')
@section('css')
    <link href="{{ asset('css/Ventas/crear.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container-crear">
    <h1>Registrar Venta</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf

        <!-- Selección de producto -->
        <div class="form-group">
            <label for="producto_id">Producto</label>
            <select name="producto_id" id="producto_id" class="form-control" required>
                <option value="">Selecciona un producto</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}">
                        {{ $producto->nombre }} (Stock: {{ $producto->stock }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Selección de cliente -->
        <div class="form-group">
            <label for="cliente_id">Cliente</label>
            <select name="cliente_id" id="cliente_id" class="form-control" required>
                <option value="">Selecciona un cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">
                        {{ $cliente->nombre }} ({{ $cliente->telefono ?? 'Sin telefono' }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Cantidad -->
        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" required>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Venta</button>
    </form>
</div>
@endsection
