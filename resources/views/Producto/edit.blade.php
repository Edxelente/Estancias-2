@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')
<div class="container">
    <h1 class="title">Editar Producto</h1>

    <!-- Si hay errores, se muestran aquí -->
    @if ($errors->any())
        <div class="alert error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario de edición -->
    <form action="{{ route('productos.update', $producto->id) }}" method="POST" class="form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre del Producto</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" id="stock" name="stock" value="{{ old('stock', $producto->stock) }}" class="form-control" required min="0">
        </div>

        <div class="form-group">
            <label for="costo">Costo</label>
            <input type="number" id="costo" name="costo" value="{{ old('costo', $producto->costo) }}" class="form-control" required min="0" step="0.01">
        </div>

        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" value="{{ old('precio', $producto->precio) }}" class="form-control" required min="0" step="0.01">
        </div>

        <button type="submit" class="btn submit-btn">Actualizar Producto</button>
    </form>

    <div class="back-btn">
        <a href="{{ route('productos.index') }}" class="btn back-btn">Volver al Inventario</a>
    </div>
</div>
@endsection
