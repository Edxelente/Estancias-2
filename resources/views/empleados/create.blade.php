@extends('layouts.app')
@section('title', 'Registrar Empleado')
@section('css')
<link href="{{ asset('css/Empleados/registrar.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="form-page">
    <h1>Registrar Nuevo Empleado</h1>

    <form method="POST" action="{{ route('empleados.store') }}" class="form-container">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="{{ old('nombre') }}" required>
        </div>
        <div class="form-group">
            <label for="email">Correo:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" value="{{ old('telefono') }}" required>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" value="{{ old('direccion') }}">
        </div>
        <div class="form-group">
            <label for="rol_trabajo_id">Rol:</label>
            <select name="rol_trabajo_id" required>
                <option value="" disabled selected>Selecciona un rol</option>
                @foreach ($roles as $rol)
                    <option value="{{ $rol->id }}" {{ old('rol_trabajo_id') == $rol->id ? 'selected' : '' }}>
                        {{ $rol->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="salario">Salario:</label>
            <input type="number" name="salario" value="{{ old('salario') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
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
</div>
@endsection
