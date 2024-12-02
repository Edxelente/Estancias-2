@extends('layouts.app')

@section('title', 'Registrar Cliente')

@section('css')
<link href="{{ asset('css/Clientes/clientes.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="clientes-container">
    <h1>Registrar Cliente</h1>
    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>
        </div>
        <div>
            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" id="email">
        </div>
        <div>
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono">
        </div>
        <button type="submit">Guardar</button>
    </form>
</div>
@endsection
