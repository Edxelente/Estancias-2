<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal</title>
    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
</head>
<body>
    <div class="menu-container">
        <!-- Logo -->
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}"  alt="Logo de Tacos Bertha">
        </div>

        <!-- Botones -->
        <div class="menu-buttons">
            <a href="{{ route('reportes.index') }}" class="menu-button">Reportes</a> <!-- Nueva opción -->
            <a href="{{ route('productos.index') }}" class="menu-button">Productos</a>
            <a href="{{ route('ventas.index') }}" class="menu-button">Ventas</a>
            <a href="{{ route('inventario.index') }}" class="menu-button">Inventario</a> <!-- Nueva opción -->
            <a href="{{ route('dashboard') }}" class="menu-button">Ganancias</a>
        </div>
    </div>
</body>
</html>
