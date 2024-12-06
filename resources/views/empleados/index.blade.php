@extends('layouts.app')

@section('title', 'Gestión de Empleados')

@section('css')
<link href="{{ asset('css/Empleados/index.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="empleados-page">
    <h1>Gestión de Empleados</h1>
    <a href="{{ route('empleados.create') }}" class="btn btn-primary">Registrar Empleado</a>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Rol</th>
                    <th>Salario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->nombre }}</td>
                    <td>{{ $empleado->email }}</td>
                    <td>{{ $empleado->telefono }}</td>
                    <td>{{ $empleado->direccion }}</td>
                    <td>{{ $empleado->rolTrabajo->nombre }}</td>
                    <td>${{ number_format($empleado->salario, 2) }}</td>
                    <td>
                        <a href="{{ route('empleados.edit', $empleado) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('empleados.destroy', $empleado) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
