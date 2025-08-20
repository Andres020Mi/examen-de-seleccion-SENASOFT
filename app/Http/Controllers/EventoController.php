<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
     /**
     * Mostrar todos los eventos
     */
    public function index()
    {
        // Traer todos los eventos ordenados por fecha más reciente
        $eventos = Evento::orderBy('fecha', 'desc')->get();


       

        return view('modulos.eventos.index', compact('eventos'));
    }


      public function calendario()
    {
        // Traer todos los eventos ordenados por fecha más reciente
    $eventos = Evento::orderBy('fecha', 'desc')->get();

    // Transformar datos a arreglo simple que entienda FullCalendar
    $eventosCalendario = $eventos->map(function($evento) {
        return [
            'title' => $evento->nombre,
            'start' => $evento->fecha,
            'description' => $evento->descripcion,
        ];
    })->toArray();

    return view('modulos.eventos.calendario', compact('eventosCalendario'));
    }

    /**
     * Mostrar formulario para crear evento
     */
    public function create()
    {
        return view('modulos.eventos.create');
    }

    /**
     * Guardar evento en la BD
     */
    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        Evento::create($request->all());

        return redirect()->route('modulos.eventos.index')
                         ->with('success', 'Evento creado correctamente.');
    }
}
