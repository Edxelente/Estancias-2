<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Usamos asset() para cargar el CSS -->
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
<div class="login-container">
        <!-- Contenedor del logo -->
        <div class="logo-container">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Bertha" class="logo">
        </div>
        <h1>Iniciar Sesión</h1>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="username">Nombre de Usuario</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn">Iniciar Sesión</button>
        </form>
        <p>¿No tienes una cuenta? <a href="{{ route('register') }}">Regístrate aquí</a></p>
    </div>
</body>
</html>

