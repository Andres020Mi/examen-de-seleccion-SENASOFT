<?php

namespace App\Http\Controllers;

use App\Models\integrante;
use App\Models\proyecto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class integrantes extends Controller
{

  public function index()
    {
        // Proyectos donde el usuario autenticado es el líder
        $proyectos = proyecto::with(['integrantes.user'])
            ->where('user_id', Auth::id())
            ->get();

        return view('modulos.integrantes.index', compact('proyectos'));
    }

    public function create()
    {
        // Proyectos liderados por el usuario autenticado
        $proyectos = proyecto::where('user_id', Auth::id())->get();

        // Todos los usuarios disponibles
        $usuarios = User::all();

        return view('modulos.integrantes.create', compact('usuarios', 'proyectos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'proyecto_id' => 'required|exists:proyectos,id',
        ]);

        // Validar que el proyecto realmente pertenece al líder actual
        $proyecto = proyecto::where('id', $request->proyecto_id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$proyecto) {
            return redirect()->route('modulos.integrantes.index')
                ->with('error', 'No puedes agregar integrantes a un proyecto que no lideras.');
        }

        Integrante::create($request->only(['user_id', 'proyecto_id']));

        return redirect()->route('modulos.integrantes.index')
            ->with('success', 'Integrante agregado correctamente.');
    }

    public function destroy(Integrante $integrante)
    {
        if ($integrante->proyecto->user_id !== Auth::id()) {
            return redirect()->route('modulos.integrantes.index')
                ->with('error', 'No puedes eliminar integrantes de proyectos que no lideras.');
        }

        $integrante->delete();

        return redirect()->route('modulos.integrantes.index')
            ->with('success', 'Integrante eliminado correctamente.');
    }
}
