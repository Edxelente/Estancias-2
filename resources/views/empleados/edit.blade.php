@extends('layouts.app')
@section('title', 'Editar Empleado')
@section('css')
<link href="{{ asset('css/Empleados/editar.css') }}" rel="stylesheet">
@endsection
@section('content')
<h1>Editar Empleado</h1>

<form action="{{ route('empleados.update', $empleado->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="{{ old('nombre', $empleado->nombre) }}" required>
    </div>
    <div>
        <label for="email">Correo Electrónico:</label>
        <input type="email" name="email" value="{{ old('email', $empleado->email) }}" required>
    </div>
    <div>
        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" value="{{ old('telefono', $empleado->telefono) }}">
    </div>
    <div>
        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" value="{{ old('direccion', $empleado->direccion) }}" required>
    </div>
    <div>
        <label for="rol_trabajo_id">Rol:</label>
        <select name="rol_trabajo_id" required>
            <option value="" disabled>Selecciona un rol</option>
            @foreach ($roles as $rol)
                <option value="{{ $rol->id }}" {{ $empleado->rol_trabajo_id == $rol->id ? 'selected' : '' }}>
                    {{ $rol->nombre }}
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="salario">Salario:</label>
        <input type="number" name="salario" value="{{ old('salario', $empleado->salario) }}" required>
    </div>
    <button type="submit">Actualizar</button>
</form>

@if ($errors->any())
    <div class="error-container">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection
