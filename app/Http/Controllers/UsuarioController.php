<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        // Aquí puedes agregar la lógica para manejar los usuarios
        return view('usuarios.index'); // Redirige a la vista usuarios.index
    }
}


