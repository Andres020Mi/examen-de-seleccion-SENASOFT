@extends('layouts.app')

@section('title', 'Trabajos de todos los proyectos')

@section('content')
<div class="p-6 max-w-6xl mx-auto space-y-6">

    <div class="bg-base-100 p-6 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold mb-6">
            Trabajos realizados en todos los proyectos
        </h1>

        @forelse($proyectos as $proyecto)
            <div class="border rounded-xl p-4 mb-6 shadow-sm">
                <div class="flex justify-between items-center mb-3">
                    <h2 class="text-xl font-semibold text-primary">
                        📌 {{ $proyecto->name }}
                    </h2>
                    <a href="{{ route('modulos.trabajos.create', $proyecto->id) }}" class="btn btn-sm btn-primary">
                        ➕ Registrar trabajo
                    </a>
                </div>

                @if($proyecto->trabajos->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Descripción</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($proyecto->trabajos as $trabajo)
                                    <tr>
                                        <td>{{ $trabajo->user->name }}</td>
                                        <td>{{ $trabajo->descripcion }}</td>
                                        <td>{{ $trabajo->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500">No hay trabajos registrados en este proyecto.</p>
                @endif
            </div>
        @empty
            <p class="text-gray-500">No hay proyectos creados aún.</p>
        @endforelse
    </div>
</div>
@endsection
