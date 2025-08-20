@extends('layouts.app')

@section('title', 'Integrantes de mis proyectos')

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
                <h1 class="text-2xl font-bold">Integrantes de mis proyectos</h1>
                <p class="text-sm opacity-70">Gestión de integrantes</p>
            </div>
            <a href="{{ route('modulos.integrantes.create') }}" class="btn btn-primary btn-md gap-2">
                + Agregar integrante
            </a>
        </div>

        @forelse ($proyectos as $proyecto)
            <div class="mb-8">
                <h2 class="text-lg font-semibold mb-2">
                    Proyecto: <span class="text-primary">{{ $proyecto->name }}</span>
                </h2>
                <p class="text-sm opacity-70 mb-4">{{ $proyecto->description }}</p>

                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($proyecto->integrantes as $integrante)
                                <tr>
                                    <td>{{ $integrante->id }}</td>
                                    <td>{{ $integrante->user->name ?? 'Sin nombre' }}</td>
                                    <td>{{ $integrante->user->email ?? '-' }}</td>
                                    <td class="flex gap-2">
                                        {{-- Eliminar --}}
                                        <form action="{{ route('modulos.integrantes.destroy', $integrante) }}" method="POST"
                                            onsubmit="return confirm('¿Seguro de eliminar este integrante?')">
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
                                    <td colspan="4" class="text-center py-4 opacity-50">
                                        No hay integrantes registrados en este proyecto.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @empty
            <div class="text-center py-6 opacity-50">
                No tienes proyectos registrados.
            </div>
        @endforelse
    </div>
</div>
@endsection
