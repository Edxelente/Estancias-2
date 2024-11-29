@extends('layouts.app')

@section('title', 'Crear Usuario')

@section('content')
<h1>Crear Nuevo Usuario</h1>

<form action="{{ route('usuarios.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="username">Nombre de Usuario</label>  <!-- Cambiar de 'name' a 'username' -->
        <input type="text" name="username" id="username" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirmar Contraseña</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="role_id">Rol</label>
        <select name="role_id" id="role_id" class="form-control" required>
            <option value="">Selecciona un rol</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Crear Usuario</button>
</form>

@endsection
