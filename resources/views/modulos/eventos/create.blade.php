@extends('layouts.app')

@section('title', 'Crear Evento')

@section('content')
<div class="p-6 max-w-3xl mx-auto space-y-6">

    <div class="bg-base-100 p-6 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Crear nuevo evento</h1>

        <form action="{{ route('modulos.eventos.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="form-control">
                <label class="label font-semibold">Fecha</label>
                <input type="date" name="fecha" value="{{ old('fecha') }}"
                    class="input input-bordered w-full" required>
                @error('fecha')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-control">
                <label class="label font-semibold">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}"
                    class="input input-bordered w-full" placeholder="Nombre del evento" required>
                @error('nombre')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-control">
                <label class="label font-semibold">Descripción</label>
                <textarea name="descripcion" class="textarea textarea-bordered w-full" rows="4" placeholder="Descripción del evento" required>{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('modulos.eventos.index') }}" class="btn btn-outline">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection
