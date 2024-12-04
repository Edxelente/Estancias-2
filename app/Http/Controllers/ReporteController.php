<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Producto; 
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function clientesReporte()
    {
        // Obtenemos los clientes con el total de ventas sumado
        $clientes = Cliente::withSum('ventas', 'total')->get();
        dd($clientes); // Para ver el resultado
        // Devolver la vista con los clientes
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

    public function sugerenciaReabastecimiento()
    {
        $productos = Producto::all(); // Obtener todos los productos
    
        foreach ($productos as $producto) {
            // Verificar si el producto tiene ventas en el último mes
            $ventasTotales = Venta::where('producto_id', $producto->id)
                ->whereBetween('created_at', [now()->subMonth(), now()]) // Solo ventas del último mes
                ->sum('cantidad'); // Sumar la cantidad vendida
    
            // Si no hay ventas, asignar promedio a 0
            if ($ventasTotales == 0) {
                $ventasPromedioDiarias = 0;
            } else {
                // Calcular el promedio de ventas diarias (ventas totales / días del mes)
                $ventasPromedioDiarias = $ventasTotales / now()->subMonth()->daysInMonth;
            }
    
            // Calcular los días restantes con el stock actual
            $diasRestantes = $ventasPromedioDiarias > 0 ? $producto->stock / $ventasPromedioDiarias : 0;
    
            // Sugerir reabastecimiento si el stock es bajo
            if ($diasRestantes < 10) {
                $producto->reabastecimiento = 'Sí'; // Marcar para reabastecer
            } else {
                $producto->reabastecimiento = 'No';
            }
    
            // Asignar el valor calculado para mostrar
            $producto->ventas_diarias_promedio = $ventasPromedioDiarias;
            $producto->dias_restantes = $diasRestantes;
        }
    
        return view('reportes.reabastecimiento', compact('productos'));
    }
    
    public function productosMasVendidos(Request $request)
    {
        // Filtrar por mes actual o periodo seleccionado
        $startDate = now()->startOfMonth();
        $endDate = now()->endOfMonth();
    
        // Obtener los productos más vendidos en el periodo seleccionado
        $productosMasVendidos = Venta::select('producto_id', DB::raw('sum(cantidad) as total_vendido'))
            ->with('producto') // Cargar los detalles del producto
            ->whereBetween('created_at', [$startDate, $endDate]) // Filtrar por el mes actual
            ->groupBy('producto_id')
            ->orderByDesc('total_vendido')
            ->get();
    
        // Calcular el total de ventas para cada producto
        foreach ($productosMasVendidos as $venta) {
            // Multiplicar la cantidad vendida por el precio de cada producto
            $producto = $venta->producto;
            $venta->total_venta = $producto->precio * $venta->total_vendido;
        }
    
        return view('reportes.productos_mas_vendidos', compact('productosMasVendidos'));
    }
    

    public function analisisRentabilidad()
    {
        // Obtener solo los productos con stock mayor a 0
        $productos = Producto::where('stock', '>', 0)->get();
    
        foreach ($productos as $producto) {
            // Calcular el costo unitario (costo total / cantidad en stock)
            $costoUnitario = $producto->costo / $producto->stock;
    
            // Calcular la rentabilidad por unidad
            $producto->rentabilidad = $producto->precio - $costoUnitario;
    
            // Calcular la rentabilidad total para todo el stock
            $producto->rentabilidad_total = $producto->rentabilidad * $producto->stock;
    
            // Calcular el margen de rentabilidad en porcentaje
            $producto->rentabilidad_porcentaje = (($producto->precio - $costoUnitario) / $costoUnitario) * 100;
        }
    
        // Pasar solo los productos con stock > 0 a la vista
        return view('reportes.rentabilidad', compact('productos'));
    }    

    public function comparacionVentas(Request $request)
{
    // Establecer valores predeterminados para ventas1 y ventas2
    $ventas1 = 0;
    $ventas2 = 0;

    $periodo = $request->input('periodo'); // 'diario', 'semanal', 'mensual'

    if ($periodo == 'diario') {
        $ventas1 = Venta::whereDate('created_at', today())->sum('total');
        $ventas2 = Venta::whereDate('created_at', today()->subDay())->sum('total');
    } elseif ($periodo == 'semanal') {
        $ventas1 = Venta::whereBetween('created_at', [now()->startOfWeek(), now()])->sum('total');
        $ventas2 = Venta::whereBetween('created_at', [now()->startOfWeek()->subWeek(), now()->subWeek()])->sum('total');
    } elseif ($periodo == 'mensual') {
        $ventas1 = Venta::whereBetween('created_at', [now()->startOfMonth(), now()])->sum('total');
        $ventas2 = Venta::whereBetween('created_at', [now()->startOfMonth()->subMonth(), now()->subMonth()])->sum('total');
    }

    $diferencia = $ventas1 - $ventas2;

    return view('reportes.comparacion_ventas', compact('ventas1', 'ventas2', 'diferencia'));
}

    public function totalGastadoPorCliente()
    {
        $clientes = Cliente::withSum('ventas', 'total')->get(); // Usar withSum para obtener el total gastado por cada cliente

        return view('reportes.clientes_gastado', compact('clientes'));
    }

}
