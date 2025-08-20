@extends('layouts.app')

@section('title', 'Registrar Trabajo')

@section('content')
<div class="p-6 max-w-3xl mx-auto space-y-6">

    <div class="bg-base-100 p-6 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold mb-4">
            Registrar trabajo en proyecto: {{ $proyecto->name }}
        </h1>

        <form action="{{ route('modulos.trabajos.store', $proyecto->id) }}" method="POST" class="space-y-4">
            @csrf

            <!-- Descripción -->
            <div class="form-control">
                <label class="label font-semibold">Descripción del trabajo</label>
                <textarea name="descripcion" class="textarea textarea-bordered w-full" rows="4"
                          placeholder="Ejemplo: Realicé la documentación del módulo X..." required>{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-2">
                <a href="{{ route('modulos.trabajos.index', $proyecto->id) }}" class="btn btn-outline">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection
