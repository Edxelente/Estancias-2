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

        $productos = $query->paginate(15);
        return view('Producto.index', compact('productos'));
    }

    public function dashboard()
{
    // Obtener todos los productos
    $productos = Producto::all();

    // Calcular las ganancias totales basadas en el stock disponible
    $ganancias = $productos->sum(function ($producto) {
        if ($producto->stock > 0) {
            // Calcular el costo unitario del producto
            $gananciaPorUnidad = $producto->stock * $producto->precio;
            // Calcular la ganancia por unidad
            // Multiplicar por el stock disponible para obtener la ganancia total por producto
            return $gananciaPorUnidad;
        }
        return 0; // No hay ganancias si no hay stock
    });

    // Contar el total de productos
    $totalProductos = $productos->count();

    // Contar los productos con bajo stock (menos de 10 unidades)
    $bajoStock = $productos->where('stock', '<', 10)->count();

    // Retornar la vista con las variables calculadas
    return view('Producto.dashboard', [
        'totalProductos' => $totalProductos,
        'bajoStock' => $bajoStock,
        'ganancias' => $ganancias,
    ]);
}


    public function create()
    {
        return view('Producto.create');
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
        return view('Producto.edit', compact('producto'));
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

    public function inventario()
    {
        $productos = Producto::all();

        // Métricas
        $totalProductos = $productos->count();
        $productosBajoStock = $productos->where('stock', '<', 10)->count();
        $valorInventario = $productos->sum(fn($producto) => $producto->stock * $producto->costo);
        $ingresosEsperados = $productos->sum(fn($producto) => $producto->stock * $producto->precio);

        return view('Producto.inventario', compact('productos', 'totalProductos', 'productosBajoStock', 'valorInventario', 'ingresosEsperados'));
    }
    
}
