<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <div class="login-container">
        <!-- Contenedor del logo -->
        <div class="logo-container">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Bertha" class="logo">
        </div>

        <!-- Título del formulario -->
        <h1>Registro</h1>

        <!-- Formulario de registro -->
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

    <!-- Selección de rol -->
    <div class="form-group">
        <label for="roles">Rol</label>
        <select name="roles" id="roles" class="form-control" required>
            <option value="" disabled selected>Selecciona un rol</option>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ old('roles') == $role->id ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
        @error('roles')
            <span class="error" style="color: red;">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="btn">Registrarse</button>
</form>
