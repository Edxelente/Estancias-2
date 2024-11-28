@extends('layouts.app')

@section('content')
    <h1>Configurar Roles de Usuarios</h1>

    <!-- Formulario para asignar un rol a un usuario -->
    <form action="{{ route('roles.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="roles">Rol</label>
            <select name="roles" id="roles" class="form-control">
                @foreach($roles as $role)
                    <option value="{{ $roles->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Rol</button>
    </form>
@endsection
