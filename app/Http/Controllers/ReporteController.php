<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Producto; 
use App\Models\Cliente;

class ReporteController extends Controller
{
    // Reporte de clientes
    public function clientesReporte()
    {
        $clientes = Cliente::with(['ventas' => function ($query) {
            $query->select('cliente_id', 'monto');
        }])->get();

        // Agregar cálculo del monto total gastado por cliente
        foreach ($clientes as $cliente) {
            $cliente->total_gastado = $cliente->ventas->sum('monto');
        }

        return view('reportes.clientes', compact('clientes'));
    }

        public function index()
    {
        $ventas = Venta::with('cliente')->get(); // Incluye información del cliente
        
        // Obtener todos los productos con los mismos cálculos que en la vista de productos
        $productos = Producto::all();

        // Agregar cálculo del valor total por producto (stock * precio)
        foreach ($productos as $producto) {
            $producto->valor_total = $producto->stock * $producto->precio;
        }

        $clientes = Cliente::all(); // Datos de clientes
        return view('reportes.index', compact('ventas', 'productos', 'clientes'));
    }
}
