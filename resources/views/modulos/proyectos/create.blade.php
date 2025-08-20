@extends('layouts.app')

@section('title', 'Crear Proyecto')

@section('content')
<div class="p-6 max-w-3xl mx-auto space-y-6">

    <div class="bg-base-100 p-6 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Crear nuevo proyecto</h1>

        <form action="{{ route('modulos.proyectos.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Nombre -->
            <div class="form-control">
                <label class="label font-semibold">Nombre</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="input input-bordered w-full" placeholder="Nombre del proyecto" required>
                @error('name')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Descripción -->
            <div class="form-control">
                <label class="label font-semibold">Descripción</label>
                <textarea name="description" class="textarea textarea-bordered w-full" rows="4"
                          placeholder="Descripción del proyecto" required>{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Fase -->
            <div class="form-control">
                <label class="label font-semibold">Fase</label>
                <select name="fase" class="select select-bordered w-full" required>
                    <option value="1">Propuesta</option>
                    <option value="2">Análisis</option>
                    <option value="3">Diseño</option>
                    <option value="4">Desarrollo</option>
                    <option value="5">Prueba</option>
                    <option value="6">Implantación</option>
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
                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
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
                        <option value="{{ $semillero->id }}">{{ $semillero->name }}</option>
                    @endforeach
                </select>
                @error('semillero_id')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-2">
                <a href="{{ route('modulos.proyectos.index') }}" class="btn btn-outline">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection
