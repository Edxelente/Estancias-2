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
            <a href="/inventario" class="menu-button">Inventario</a>
            <a href="/ventas" class="menu-button">Ventas</a>
            <a href="/dashboard" class="menu-button">Ganancias</a>
            <a href="/productos" class="menu-button">Productos</a>
        </div>
    </div>
</body>
</html>
