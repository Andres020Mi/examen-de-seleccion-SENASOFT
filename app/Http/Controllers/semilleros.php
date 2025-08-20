<?php

namespace App\Http\Controllers;

use App\Models\semillero;
use Illuminate\Http\Request;

class semilleros extends Controller
{
     public function index()
    {
        $semilleros = semillero::latest()->get();
        return view('modulos.semilleros.index', compact('semilleros'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        return view('modulos.semilleros.create');
    }

    /**
     * Guardar un nuevo semillero
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:5',
        ]);

        semillero::create($request->only('name', 'description'));

        return redirect()
            ->route('modulos.semilleros.index')
            ->with('success', 'Semillero creado correctamente ✅');
    }

    /**
     * Eliminar un semillero
     */
    public function destroy(semillero $semillero)
    {
        $semillero->delete();

        return redirect()
            ->route('modulos.semilleros.index')
            ->with('success', 'Semillero eliminado correctamente 🗑️');
    } 
}
