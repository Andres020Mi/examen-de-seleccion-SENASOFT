@extends('layouts.app')

@section('title', 'Crear Semillero')

@section('content')
<div class="p-6 max-w-3xl mx-auto space-y-6">

    <div class="bg-base-100 p-6 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Crear nuevo semillero</h1>

        <form action="{{ route('modulos.semilleros.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="form-control">
                <label class="label font-semibold">Nombre</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="input input-bordered w-full" placeholder="Nombre del semillero" required>
                @error('name')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-control">
                <label class="label font-semibold">Descripción</label>
                <textarea name="description" class="textarea textarea-bordered w-full" rows="4" placeholder="Descripción del semillero" required>{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('modulos.semilleros.index') }}" class="btn btn-outline">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection