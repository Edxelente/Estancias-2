@extends('layouts.app')

@section('title', 'Inventario de Productos')

@section('css')
    <!-- Cargar archivo CSS específico para la vista de productos -->
    <link href="{{ asset('css/Productos/index.css') }}" rel="stylesheet">
@endsection

@section('content')

   <!-- Formulario de búsqueda -->
   <form method="GET" action="{{ route('productos.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar producto..." value="{{ request('buscar') }}">
            <button type="submit" class="btn btn-info">Buscar</button>
        </div>
    </form>

<div class="index-container">
    <h1>Inventario de Productos</h1>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Acciones -->
    <div class="mb-3">
        <a href="{{ route('productos.create') }}" class="btn btn-add">Agregar Producto</a>
    </div>

    <!-- Tabla de productos -->
    <table>
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
                <!-- Formatear Costo y Precio con el símbolo de $ -->
                <td>${{ number_format($producto->costo, 2) }}</td>
                <td>${{ number_format($producto->precio, 2) }}</td>
                <td>
                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
     <!-- Paginación -->
     {{ $productos->links('pagination::bootstrap-4', ['class' => 'custom-pagination']) }}
</div>
@endsection
