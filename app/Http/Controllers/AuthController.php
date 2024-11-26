<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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
            'username' => 'required|string', // El nombre de usuario es requerido
            'password' => 'required|string', // La contraseña es requerida
        ]);

        // Intentar iniciar sesión con las credenciales proporcionadas
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard'); // Redirige al dashboard si la autenticación fue exitosa
        }

        return back()->withErrors([
            'username' => 'Las credenciales no son correctas.',
        ])->onlyInput('username');
    }

    // Mostrar el formulario de registro
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Procesar el registro
    public function register(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'username' => ['required', 'string', 'unique:users,username'], // Nombre de usuario único
            'password' => ['required', 'confirmed', 'min:8'], // Contraseña con confirmación y mínima de 8 caracteres
        ]);

        // Crear el nuevo usuario
        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), // Encriptar la contraseña antes de guardarla
        ]);

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
