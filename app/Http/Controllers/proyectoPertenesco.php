<?php

namespace App\Http\Controllers;

use App\Models\proyecto;
use Illuminate\Http\Request;

class proyectoPertenesco extends Controller
{
      // Listar proyectos
    public function index()
    {
        $proyectos = proyecto::with(['lider', 'semillero'])->get();
        return view('modulos.proyecto_pertenesco.index', compact('proyectos'));
    }
}
