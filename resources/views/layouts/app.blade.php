<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Aplicación Laravel')</title>

    <!-- Estilos básicos -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    @yield('css') <!-- Espacio para incluir estilos específicos de cada página -->

</head>
<body>
    <div class="wrapper">
        <!-- Barra de navegación -->
        <header class="navbar">
            <div class="container">
                <a class="brand" href="{{ url('/') }}">Café y Tacos Las Vías</a>
                <nav>
                <ul class="nav">
                        <li><a href="{{ route('productos.index') }}">Productos</a></li>
                        <li><a href="{{ route('reportes.index') }}">Reportes</a></li> <!-- Nueva opción -->
                        <li><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
                        <li><a href="{{ route('configuracion') }}">Configuración</a></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <!-- Contenido principal -->
        <main class="content">
            <div class="container">
                @yield('content') <!-- Aquí se inyectará el contenido de cada página -->
            </div>
        </main>

        <!-- Pie de página -->
        <footer class="footer">
            <div class="container">
                <p>&copy; 2024 Café y Tacos Las Vías. Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>

    @yield('js') <!-- Espacio para incluir scripts específicos de cada página -->
</body>
</html>
