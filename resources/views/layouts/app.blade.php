<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Página Base')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('productos.index') }}">Inventario</a></li>
                <li><a href="{{ route('productos.create') }}">Agregar Producto</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Café y Tacos Las Vías. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
