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
        return view('Producto.index', compact('productos')); // Aquí se usa 'Producto.index'
    }

    public function dashboard()
    {
        $totalProductos = Producto::count();
        $bajoStock = Producto::where('stock', '<', 10)->count();
        $ganancias = Producto::sum(DB::raw('precio - costo'));

        return view('Producto.dashboard', compact('totalProductos', 'bajoStock', 'ganancias')); // Aquí se usa 'Producto.dashboard'
    }

    public function create()
    {
        return view('Producto.create'); // Aquí se usa 'Producto.create'
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
        return view('Producto.edit', compact('producto')); // Aquí se usa 'Producto.edit'
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

