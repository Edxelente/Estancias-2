@extends('layouts.app')

@section('title', 'Inventario de Productos')

@section('content')
<div class="container">
    <h1 class="title">Inventario de Productos</h1>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert success">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('productos.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar producto..." value="{{ request('buscar') }}">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>

    <div class="actions">
        <a href="{{ route('productos.create') }}" class="btn add-btn">Agregar Producto</a>
        <a href="{{ route('dashboard') }}" class="btn btn-info">Ir al Dashboard</a> <!-- Botón al dashboard -->
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Stock</th>
                <th>Costo</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->stock }}</td>
                <td>{{ $producto->costo }}</td>
                <td>{{ $producto->precio }}</td>
                <td>
                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn edit-btn">Editar</a>
                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn delete-btn">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $productos->links() }}
    </div>
</div>
@endsection
