<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
     /**
     * Muestra la vista de configuración.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('configuraciones.index');
    }
  
    public function showRoles(User $user)
    {
        $roles = Roles::all();
        return view('configuraciones.roles', compact('user', 'roles'));
    }


    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,id',
        ]);

        $user->role_id = $request->role;
        $user->save();

        return redirect()->route('roles.show', $user->id)->with('success', 'Rol actualizado exitosamente.');
    }
    
    public function showRegisterForm()
{
    $roles = Roles::all(); // Obtener todos los roles desde la base de datos
    return view('auth.register', compact('roles')); // Pasar los roles a la vista
}

}
