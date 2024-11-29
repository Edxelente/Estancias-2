@extends('layouts.app')

@section('title', 'Ver Usuario')

@section('content')
<h1>Detalles del Usuario</h1>

<div class="card">
    <div class="card-body">
        <p><strong>Nombre:</strong> {{ $user->name }}</p>
        <p><strong>Rol:</strong> {{ $user->role ? $user->role->name : 'Sin rol asignado' }}</p>  <!-- Verifica si el rol existe -->

        <a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-warning">Editar</a>

        <!-- Eliminar usuario -->
        <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
        </form>
    </div>
</div>

<a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver a la lista</a>
@endsection
