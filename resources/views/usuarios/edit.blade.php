@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<h1>Editar Usuario</h1>

<form action="{{ route('usuarios.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')  <!-- Necesario para actualizar el recurso -->
    
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="form-group">
        <label for="role_id">Rol</label>
        <select name="role_id" id="role_id" class="form-control" required>
            @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
</form>

@endsection
