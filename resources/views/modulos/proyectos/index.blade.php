@extends('layouts.app')

@section('title', 'Proyectos de semilleros')

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
                    <h1 class="text-2xl font-bold">Proyectos de semilleros</h1>
                    <p class="text-sm opacity-70">Gestión de proyectos</p>
                </div>
                <a href="{{ route('modulos.proyectos.create') }}" class="btn btn-primary btn-md gap-2">
                    + Crear proyecto
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Fase</th>
                            <th>Líder</th>
                            <th>Semillero</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($proyectos as $proyecto)
                            <tr>
                                <td>{{ $proyecto->id }}</td>
                                <td>{{ $proyecto->name }}</td>
                                <td class="max-w-xs whitespace-normal break-words">
                                    {{ $proyecto->description }}
                                </td>
                                <td>
                                    @php
                                        $fases = [
                                            '1' => 'Propuesta',
                                            '2' => 'Análisis',
                                            '3' => 'Diseño',
                                            '4' => 'Desarrollo',
                                            '5' => 'Prueba',
                                            '6' => 'Implantación',
                                        ];
                                    @endphp
                                    <span class="badge badge-info">
                                        {{ $fases[$proyecto->fase] ?? 'N/A' }}
                                    </span>
                                </td>
                                <td>{{ $proyecto->lider->name ?? 'Sin asignar' }}</td>
                                <td>{{ $proyecto->semillero->name ?? 'Sin semillero' }}</td>
                                <td class="flex gap-2">
                                    {{-- Editar --}}
                                    <a href="{{ route('modulos.proyectos.edit', $proyecto->id) }}"
                                        class="btn btn-sm btn-warning btn-square tooltip" data-tip="Editar">
                                        ✏️
                                    </a>

                                    {{-- Eliminar --}}
                                    <form action="{{ route('modulos.proyectos.destroy', $proyecto->id) }}" method="POST"
                                        onsubmit="return confirm('¿Seguro de eliminar este proyecto?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-error btn-square tooltip"
                                            data-tip="Eliminar">
                                            🗑️
                                        </button>
                                    </form>

    <form action="{{ route('modulos.proyectos.updateFase', $proyecto->id) }}" method="POST" class="flex items-center gap-2">
        @csrf
        @method('PATCH')

        <select name="fase" class="select select-bordered select-sm" onchange="this.form.submit()">
            <option value="1" @selected($proyecto->fase == 1)>Propuesta</option>
            <option value="2" @selected($proyecto->fase == 2)>Análisis</option>
            <option value="3" @selected($proyecto->fase == 3)>Diseño</option>
            <option value="4" @selected($proyecto->fase == 4)>Desarrollo</option>
            <option value="5" @selected($proyecto->fase == 5)>Prueba</option>
            <option value="6" @selected($proyecto->fase == 6)>Implantación</option>
        </select>
    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-6 opacity-50">
                                    No hay proyectos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
