<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::query();

        if ($request->has('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        $productos = $query->paginate(10);
        return view('producto.index', compact('productos'));
    }

    public function dashboard()
    {
        $totalProductos = Producto::count();
        $bajoStock = Producto::where('stock', '<', 10)->count();
        $ganancias = Producto::sum(DB::raw('precio - costo'));

        return view('producto.dashboard', compact('totalProductos', 'bajoStock', 'ganancias')); // Cambiar 'productos' a 'producto'
    }

    public function create()
    {
        return view('producto.create'); // Cambiar 'Producto' a 'producto'
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'stock' => 'required|integer|min:0',
            'costo' => 'required|numeric|min:0',
            'precio' => 'required|numeric|min:0',
        ]);

        Producto::create($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    public function edit(Producto $producto)
    {
        return view('producto.edit', compact('producto')); // Cambiar 'Producto' a 'producto'
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required',
            'stock' => 'required|integer|min:0',
            'costo' => 'required|numeric|min:0',
            'precio' => 'required|numeric|min:0',
        ]);

        $producto->update($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
