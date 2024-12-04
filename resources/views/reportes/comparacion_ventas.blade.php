@extends('layouts.app')

@section('title', 'Comparación de Ventas')
@section('css')
    <link href="{{ asset('css/Reporte/comparacion.css') }}" rel="stylesheet">
@endsection
@section('content')
    <h1>Comparación de Ventas</h1>

    <form method="GET" action="{{ route('reportes.comparacionVentas') }}">
        <label for="periodo">Selecciona un período:</label>
        <select name="periodo" id="periodo">
            <option value="diario">Diario</option>
            <option value="semanal">Semanal</option>
            <option value="mensual">Mensual</option>
        </select>
        <button type="submit">Comparar</button>
    </form>

    <h2>Ventas en el Primer Período</h2>
    <p><strong>${{ number_format($ventas1, 2) }}</strong></p>

    <h2>Ventas en el Segundo Período</h2>
    <p><strong>${{ number_format($ventas2, 2) }}</strong></p>

    <h3>Diferencia de Ventas</h3>
    <p><strong>${{ number_format($diferencia, 2) }}</strong></p>
@endsection
