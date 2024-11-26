<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="register-container">
        <h1>Registro</h1>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="username">Nombre de Usuario</label>
                <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" required>
                @error('username')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
                @error('password')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Registrarse</button>
        </form>

        <p>¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a></p>
    </div>
</body>
</html>
