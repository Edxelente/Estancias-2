@extends('layouts.app')
@section('css')
    <link href="{{ asset('css/Configuracion/gestionar.css') }}" rel="stylesheet">
@endsection
@section('title', 'Gestionar Usuarios')

@section('content')
    <h1>Gestionar Usuarios</h1>

    <!-- Mostrar mensajes de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabla de usuarios -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre de Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>
                        <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Botón para agregar un nuevo usuario -->
    <a href="{{ route('register') }}" class="btn btn-primary">Registrar Usuario</a>
@endsection
