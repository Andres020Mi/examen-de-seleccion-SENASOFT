@extends('layouts.app')

@section('title', 'Semilleros de investigación')

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
                <h1 class="text-2xl font-bold">Semilleros de investigación</h1>
                <p class="text-sm opacity-70">Gestión de semilleros</p>
            </div>
            <a href="{{ route('modulos.semilleros.create') }}" class="btn btn-primary btn-md gap-2">
                + Crear semillero
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="table table-zebra w-full">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($semilleros as $semillero)
                        <tr>
                            <td>{{ $semillero->id }}</td>
                            <td>{{ $semillero->name }}</td>
                            <td class="max-w-xs whitespace-normal break-words">
                                {{ $semillero->description }}
                            </td>
                            <td class="flex gap-2">
                                {{-- Editar (sin ruta aún) --}}
                                <button class="btn btn-sm btn-warning btn-square tooltip" data-tip="Editar">
                                    ✏️
                                </button>
                                {{-- Eliminar --}}
                                <form action="{{ route('modulos.semilleros.destroy', $semillero->id) }}" method="POST"
                                    onsubmit="return confirm('¿Seguro de eliminar este semillero?')">
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
                            <td colspan="4" class="text-center py-6 opacity-50">No hay semilleros registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
