@extends('layouts.app')

@section('title', 'Eventos')

@section('content')
<div class="p-6 max-w-6xl mx-auto space-y-6">

    {{-- Alertas --}}
    @if (session('success'))
        <div class="alert alert-success shadow-md">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-error shadow-md">
            <ul class="list-disc ml-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-base-100 p-6 rounded-xl shadow-lg">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h1 class="text-2xl font-bold">Eventos</h1>
                <p class="text-sm opacity-70">Gestión de eventos registrados</p>
            </div>
            <a href="{{ route('modulos.eventos.create') }}" class="btn btn-primary btn-md gap-2">
                + Crear evento
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="table table-zebra w-full">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($eventos as $evento)
                        <tr>
                            <td>{{ $evento->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}</td>
                            <td>{{ $evento->nombre }}</td>
                            <td class="max-w-xs whitespace-normal break-words">
                                {{ $evento->descripcion }}
                            </td>
                            <td class="flex gap-2">
                                {{-- Editar --}}
                                <a href="{{ route('modulos.eventos.edit', $evento->id) }}" 
                                   class="btn btn-sm btn-warning btn-square tooltip" data-tip="Editar">
                                    ✏️
                                </a>
                                {{-- Eliminar --}}
                                <form action="{{ route('modulos.eventos.destroy', $evento->id) }}" method="POST"
                                    onsubmit="return confirm('¿Seguro de eliminar este evento?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-error btn-square tooltip" data-tip="Eliminar">
                                        🗑️
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-6 opacity-50">No hay eventos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
