@extends('layouts.app')

@section('title', 'Registrar Cliente')

@section('css')
<link href="{{ asset('css/Clientes/clientes.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="clientes-container">
    <h1>Actualizar Cliente</h1>
<form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $cliente->nombre) }}" required>
    
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="{{ old('email', $cliente->email) }}">

    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $cliente->telefono) }}">

    <button type="submit">Actualizar Cliente</button>
</form>
@endsection