@extends('layouts.app')

@section('title', 'Proyectos a los que perteneces')

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
                <h1 class="text-2xl font-bold">Proyectos a los que perteneces</h1>
                
            </div>
            
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
                                        '6' => 'Implantación'
                                    ];
                                @endphp
                                <span class="badge badge-info">
                                    {{ $fases[$proyecto->fase] ?? 'N/A' }}
                                </span>
                            </td>
                            <td>{{ $proyecto->lider->name ?? 'Sin asignar' }}</td>
                            <td>{{ $proyecto->semillero->name ?? 'Sin semillero' }}</td>
                           
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
