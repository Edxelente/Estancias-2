@extends('layouts.app')

@section('content')
    <h1>Reporte de Inventario</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Stock</th>
                <th>Costo</th>
                <th>Precio</th>
                <th>Valor Inventario</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventarios as $inventario)
                <tr>
                    <td>{{ $inventario->nombre }}</td>
                    <td>{{ $inventario->stock }}</td>
                    <td>{{ $inventario->costo }}</td>
                    <td>{{ $inventario->precio }}</td>
                    <td>{{ $inventario->valor_inventario }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
