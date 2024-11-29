<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Roles;

class UsuarioController extends Controller
{
    public function index()
    {
        // Usamos paginate para obtener una instancia de Paginator
        $users = User::with('role')->paginate(10);  // Paginamos la lista de usuarios
    
        return view('usuarios.index', compact('users'));
    }
    

    // Crear nuevo usuario
    public function create()
    {
        $roles = Roles::all();  // Traemos todos los roles disponibles
        return view('usuarios.create', compact('roles'));  // Pasamos la variable $roles a la vista
    }

    // Guardar nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);
    
        // Crear el nuevo usuario
        $user = User::create([
            'username' => $request->name,
            'password' => Hash::make($request->password),  // Encriptar la contraseña
        ]);
    
        // Asignar el rol al usuario
        $user->roles()->attach($request->role_id);  // Usamos attach() para la relación muchos a muchos
    
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado con éxito.');
    }
    

    // Mostrar perfil de usuario
    public function show(User $user)
    {
        return view('usuarios.show', compact('user'));
    }

    // Editar usuario
    public function edit(User $user)
    {
        return view('usuarios.edit', compact('user'));
    }

    // Actualizar usuario
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->update($request->only('username', 'role_id'));

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado con éxito.');
    }

    // Eliminar usuario
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado con éxito.');
    }
}
