@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
<h1>Usuarios</h1>

<!-- Mensaje de éxito -->
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Botón para crear un nuevo usuario -->
<a href="{{ route('usuarios.create') }}" class="btn btn-primary mb-3">Agregar Nuevo Usuario</a>

<!-- Tabla de usuarios -->
<table class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->role ? $user->role->name : 'Sin rol asignado' }}</td>
            <td>
                <a href="{{ route('usuarios.show', $user->id) }}" class="btn btn-info">Ver</a>
                <a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Paginación -->
{{ $users->links() }}
@endsection
