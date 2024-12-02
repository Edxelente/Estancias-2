@extends('layouts.app')

@section('title', 'Crear Producto')

@section('css')
    <!-- Cargar archivo CSS específico para la vista de productos -->
    <link href="{{ asset('css/Productos/crear.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-crear">
    <h1 class="title">Crear Nuevo Producto</h1>

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

    <!-- Formulario de creación -->
    <form action="{{ route('productos.store') }}" method="POST" class="form">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre del Producto</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" id="stock" name="stock" value="{{ old('stock') }}" class="form-control" required min="0">
        </div>

        <div class="form-group">
            <label for="costo">Costo</label>
            <input type="number" id="costo" name="costo" value="{{ old('costo') }}" class="form-control" required min="0" step="0.01">
        </div>

        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" value="{{ old('precio') }}" class="form-control" required min="0" step="0.01">
        </div>

        <button type="submit" class="btn submit-btn">Crear Producto</button>
    </form>

    <div class="back-btn">
        <a href="{{ route('productos.index') }}" class="btn back-btn">Volver al Inventario</a>
    </div>
</div>

<script>
    document.querySelector("form").addEventListener("submit", function(event) {
        const nombre = document.querySelector("[name='nombre']").value;
        const stock = document.querySelector("[name='stock']").value;

        if (!nombre || !stock || stock < 0) {
            alert("Por favor, completa todos los campos correctamente.");
            event.preventDefault();
        }
    });
</script>

@endsection
