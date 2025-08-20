<?php

namespace App\Http\Controllers;

use App\Models\proyecto;
use App\Models\Trabajo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrabajoController extends Controller
{
     // Listar trabajos de un proyecto
    public function index()
{
    // Trae proyectos con los trabajos y usuarios relacionados
    $proyectos = Proyecto::with(['trabajos.user'])->get();

    return view('modulos.trabajos.index', compact('proyectos'));
}

    // Mostrar formulario de creación
    public function create($proyectoId)
    {
        $proyecto = proyecto::findOrFail($proyectoId);
        return view('modulos.trabajos.create', compact('proyecto'));
    }

    // Guardar en DB
    public function store(Request $request, $proyectoId)
    {
        $request->validate([
            'descripcion' => 'required|string|max:500',
        ]);

        Trabajo::create([
            'user_id' => Auth::id(),
            'descripcion' => $request->descripcion,
            'proyecto_id' => $proyectoId,
        ]);

        return redirect()->route('modulos.trabajos.index', $proyectoId)
                         ->with('success', 'Trabajo registrado correctamente.');
    }

    // Editar
    public function edit($id)
    {
        $trabajo = Trabajo::findOrFail($id);
        return view('modulos.trabajos.edit', compact('trabajo'));
    }

    // Actualizar
    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required|string|max:500',
        ]);

        $trabajo = Trabajo::findOrFail($id);
        $trabajo->update([
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('modulos.trabajos.index', $trabajo->proyecto_id)
                         ->with('success', 'Trabajo actualizado correctamente.');
    }

    // Eliminar
    public function destroy($id)
    {
        $trabajo = Trabajo::findOrFail($id);
        $trabajo->delete();

        return back()->with('success', 'Trabajo eliminado.');
    }
}
