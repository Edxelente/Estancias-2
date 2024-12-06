<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Cliente;

class VentaController extends Controller
{
    public function index(Request $request)
    {
        $ventas = Venta::with('producto', 'cliente'); 
        // Búsqueda avanzada
        if ($request->has('buscar')) {
            $ventas = $ventas->where(function($query) use ($request) {
                $query->whereHas('producto', function($query) use ($request) {
                    $query->where('nombre', 'like', '%' . $request->buscar . '%');
                })
                ->orWhereHas('cliente', function($query) use ($request) {
                    $query->where('nombre', 'like', '%' . $request->buscar . '%');
                })
                ->orWhere('created_at', 'like', '%' . $request->buscar . '%');
            });
        }
        
        
        // Aquí la paginación debería aplicarse sobre el resultado filtrado
        $ventas = $ventas->paginate(15);
        

        // Obtener el total gastado por cada cliente
        $clientes = Cliente::withSum('ventas', 'total')->get(); // Suma de las ventas por cada cliente

        return view('Venta.index', compact('ventas', 'clientes'));
    }

    public function create()
    {
        $productos = Producto::all(); // Listar todos los productos para seleccionar
        $clientes = Cliente::all();   // Listar todos los clientes para seleccionar
    
        return view('Venta.create', compact('productos', 'clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cliente_id' => 'required|exists:clientes,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        // Validar si hay suficiente stock
        if ($producto->stock < $request->cantidad) {
            return redirect()->back()->withErrors(['cantidad' => 'No hay suficiente stock disponible.']);
        }

        // Calcular el total de la venta
        $total = $producto->precio * $request->cantidad;

        // Crear la venta
        Venta::create([
            'producto_id' => $producto->id,
            'cliente_id' => $request->cliente_id,
            'cantidad' => $request->cantidad,
            'total' => $total,
        ]);

        // Actualizar el stock del producto
        $producto->update(['stock' => $producto->stock - $request->cantidad]);

        return redirect()->route('ventas.index')->with('success', 'Venta registrada con éxito.');
    }
}
