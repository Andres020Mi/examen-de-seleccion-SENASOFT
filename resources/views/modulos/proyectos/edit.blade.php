@extends('layouts.app')

@section('title', 'Editar Proyecto')

@section('content')
<div class="p-6 max-w-3xl mx-auto space-y-6">

    <div class="bg-base-100 p-6 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Editar proyecto</h1>

        <form action="{{ route('modulos.proyectos.update', $proyecto->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Nombre -->
            <div class="form-control">
                <label class="label font-semibold">Nombre</label>
                <input type="text" name="name" value="{{ old('name', $proyecto->name) }}"
                       class="input input-bordered w-full" placeholder="Nombre del proyecto" required>
                @error('name')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Descripción -->
            <div class="form-control">
                <label class="label font-semibold">Descripción</label>
                <textarea name="description" class="textarea textarea-bordered w-full" rows="4"
                          placeholder="Descripción del proyecto" required>{{ old('description', $proyecto->description) }}</textarea>
                @error('description')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Fase -->
            <div class="form-control">
                <label class="label font-semibold">Fase</label>
                <select name="fase" class="select select-bordered w-full" required>
                    @php
                        $fases = [
                            1 => 'Propuesta',
                            2 => 'Análisis',
                            3 => 'Diseño',
                            4 => 'Desarrollo',
                            5 => 'Prueba',
                            6 => 'Implantación'
                        ];
                    @endphp
                    @foreach($fases as $id => $nombre)
                        <option value="{{ $id }}" {{ old('fase', $proyecto->fase) == $id ? 'selected' : '' }}>
                            {{ $nombre }}
                        </option>
                    @endforeach
                </select>
                @error('fase')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Líder -->
            <div class="form-control">
                <label class="label font-semibold">Líder del Proyecto</label>
                <select name="user_id" class="select select-bordered w-full" required>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ old('user_id', $proyecto->user_id) == $usuario->id ? 'selected' : '' }}>
                            {{ $usuario->name }}
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Semillero -->
            <div class="form-control">
                <label class="label font-semibold">Semillero</label>
                <select name="semillero_id" class="select select-bordered w-full" required>
                    @foreach($semilleros as $semillero)
                        <option value="{{ $semillero->id }}" {{ old('semillero_id', $proyecto->semillero_id) == $semillero->id ? 'selected' : '' }}>
                            {{ $semillero->name }}
                        </option>
                    @endforeach
                </select>
                @error('semillero_id')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-2">
                <a href="{{ route('modulos.proyectos.index') }}" class="btn btn-outline">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection
