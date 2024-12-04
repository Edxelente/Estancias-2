<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostrar el formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesar el login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Intentar iniciar sesión con las credenciales proporcionadas
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended('welcome'); // Redirige al menu si la autenticación fue exitosa
        }

        return back()->withErrors([
            'username' => 'Las credenciales no son correctas.',
        ])->onlyInput('username');
    }

    // Mostrar el formulario de registro
    public function showRegisterForm()
    {
        // Obtener todos los roles
        $roles = Roles::all();
        // Pasar los roles a la vista
        return view('auth.register', compact('roles'));
    }

    // Procesar el registro
    public function register(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'username' => ['required', 'string', 'unique:users,username'], // Nombre de usuario único
            'password' => ['required', 'confirmed', 'min:8'], // Contraseña con confirmación y mínima de 8 caracteres
            'roles' => 'required|exists:roles,id', // Validar que el rol exista en la tabla 'roles'
        ]);

        // Crear el nuevo usuario
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), // Encriptar la contraseña antes de guardarla
        ]);

        // Asignar el rol al usuario
        $user->roles()->attach($request->roles);

        return redirect()->route('login')->with('success', 'Cuenta creada con éxito. Ahora puedes iniciar sesión.');
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
