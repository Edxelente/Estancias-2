<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\RolTrabajo;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::with('rolTrabajo')->get();
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        $roles = RolTrabajo::all();
    
        return view('empleados.create', compact('roles'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:empleados,email',
            'telefono' => 'required|string|max:15',
            'direccion' => 'nullable|string|max:255',
            'rol_trabajo_id' => 'required|exists:rol_trabajo,id',
            'salario' => 'required|numeric|min:0',
        ]);
    
        // Crear nuevo empleado
        $empleado = Empleado::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,  // Aquí estamos añadiendo la dirección
            'rol_trabajo_id' => $request->rol_trabajo_id,
            'salario' => $request->salario,
        ]);
    
        return redirect()->route('empleados.index')->with('success', 'Empleado creado con éxito.');
    }    

    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);
        $roles = RolTrabajo::all(); // Asegúrate de obtener los roles también
        return view('empleados.edit', compact('empleado', 'roles'));
    }

    public function update(Request $request, Empleado $empleado)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:empleados,email,' . $empleado->id,
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
            'rol_trabajo_id' => 'required|exists:rol_trabajo,id',
            'salario' => 'required|numeric|min:0',
        ]);

        $empleado->update($request->all());

        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado exitosamente.');
    }

    public function destroy(Empleado $empleado)
    {
        $empleado->delete();
        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado exitosamente.');
    }
}
