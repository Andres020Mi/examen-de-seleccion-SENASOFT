@extends('layouts.app')

@section('title', 'Agregar integrante')

@section('content')
<div class="p-6 max-w-3xl mx-auto space-y-6">

    <div class="bg-base-100 p-6 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Agregar integrante</h1>

        <form action="{{ route('modulos.integrantes.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Seleccionar usuario -->
            <div class="form-control">
                <label class="label font-semibold">Usuario</label>
                <select name="user_id" class="select select-bordered w-full" required>
                    <option value="" disabled selected>Seleccione un usuario</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Seleccionar proyecto (solo proyectos liderados por el usuario actual) -->
            <div class="form-control">
                <label class="label font-semibold">Proyecto</label>
                <select name="proyecto_id" class="select select-bordered w-full" required>
                    <option value="" disabled selected>Seleccione un proyecto</option>
                    @foreach($proyectos as $proyecto)
                        <option value="{{ $proyecto->id }}">{{ $proyecto->name }}</option>
                    @endforeach
                </select>
                @error('proyecto_id')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-2">
                <a href="{{ route('modulos.integrantes.index') }}" class="btn btn-outline">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection
