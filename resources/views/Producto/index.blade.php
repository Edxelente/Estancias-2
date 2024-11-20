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

    <div class="actions">
        <a href="{{ route('productos.create') }}" class="btn add-btn">Agregar Producto</a>
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
                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn delete-btn">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
