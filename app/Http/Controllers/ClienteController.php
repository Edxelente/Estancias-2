<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $clientes = Cliente::query();

        // Búsqueda avanzada
        if ($request->has('buscar')) {
            $clientes->where(function($query) use ($request) {
                $query->where('nombre', 'like', '%' . $request->buscar . '%')
                      ->orWhere('email', 'like', '%' . $request->buscar . '%')
                      ->orWhere('telefono', 'like', '%' . $request->buscar . '%');
            });
        }

        $clientes = $clientes->paginate(10);
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'nullable|email|unique:clientes,email',
            'telefono' => 'nullable|string|max:15',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente registrado exitosamente.');
    }

    public function edit($id)
{
    $cliente = Cliente::findOrFail($id);
    return view('clientes.edit', compact('cliente'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'email' => 'nullable|email|unique:clientes,email,' . $id,
        'telefono' => 'nullable|string|max:15',
    ]);

    $cliente = Cliente::findOrFail($id);
    $cliente->update($request->all());

    return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente.');
}
Z
}
