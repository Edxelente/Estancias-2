<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('Producto.index', compact('productos')); // Cambiar 'productos' a 'Producto'
    }

    public function create()
    {
        return view('Producto.create'); // Cambiar 'productos' a 'Producto'
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
        return view('Producto.edit', compact('producto')); // Cambiar 'productos' a 'Producto'
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
