<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Cliente;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('producto')->paginate(10); // Cargar ventas con productos relacionados
        return view('Venta.index', compact('ventas'));
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
