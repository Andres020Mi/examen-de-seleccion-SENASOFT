<?php

namespace App\Http\Controllers;

use App\Models\proyecto;
use App\Models\semillero;
use App\Models\User;
use Illuminate\Http\Request;

class proyectosController extends Controller
{
      // Listar proyectos
    public function index()
    {
        $proyectos = proyecto::with(['lider', 'semillero'])->get();
        return view('modulos.proyectos.index', compact('proyectos'));
    }

    // Mostrar formulario para crear
    public function create()
    {
        $usuarios = User::all();
        $semilleros = semillero::all();
        return view('modulos.proyectos.create', compact('usuarios', 'semilleros'));
    }

    // Guardar en DB
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'fase' => 'required|integer|min:1|max:6',
            'user_id' => 'required|exists:users,id',
            'semillero_id' => 'required|exists:semilleros,id',
        ]);

        proyecto::create($request->all());

        return redirect()->route('modulos.proyectos.index')->with('success', 'Proyecto creado correctamente.');
    }




    // Mostrar formulario de edición
public function edit(proyecto $proyecto)
{
    $usuarios = User::all();
    $semilleros = semillero::all();
    return view('modulos.proyectos.edit', compact('proyecto', 'usuarios', 'semilleros'));
}

// Actualizar en DB
public function update(Request $request, proyecto $proyecto)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'fase' => 'required|integer|min:1|max:6',
        'user_id' => 'required|exists:users,id',
        'semillero_id' => 'required|exists:semilleros,id',
    ]);

    $proyecto->update($request->all());

    return redirect()->route('modulos.proyectos.index')->with('success', 'Proyecto actualizado correctamente.');
}



    // Eliminar proyecto
    public function destroy(proyecto $proyecto)
    {
        $proyecto->delete();
        return redirect()->route('modulos.proyectos.index')->with('success', 'Proyecto eliminado correctamente.');
    }





    // Actualizar solo la fase
public function updateFase(Request $request, proyecto $proyecto)
{
    $request->validate([
        'fase' => 'required|integer|min:1|max:6',
    ]);

    $proyecto->update([
        'fase' => $request->fase
    ]);

    return redirect()->route('modulos.proyectos.index')->with('success', 'Fase actualizada correctamente.');
}
}
