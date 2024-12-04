<!-- resources/views/configuracion/index.blade.php -->
@extends('layouts.app')

@section('content')
@section('title', 'Configuración')
    <h1>Configuración</h1>
    
    <!-- Opciones de configuración -->
    <div class="config-options">
        <h3>Gestionar Roles de Usuario</h3>
        <p>Aquí puedes configurar los roles de los usuarios del sistema.</p>
        <a href="{{ route('roles.index') }}" class="btn btn-primary">Gestionar Roles</a>
    </div>
    
@endsection
