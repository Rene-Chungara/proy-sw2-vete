@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 max-w-lg mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ isset($almacen) ? 'Editar Almacén' : 'Crear Almacén' }}</h2>

        <form method="POST" action="{{ isset($almacen) ? route('almacenes.update', $almacen->id) : route('almacenes.store') }}">
            @csrf
            @if(isset($almacen)) @method('PUT') @endif

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $almacen->nombre ?? '') }}" class="w-full border rounded-xl p-2 @error('nombre') border-red-500 @enderror">
                @error('nombre') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Ubicación</label>
                <input type="text" name="ubicacion" value="{{ old('ubicacion', $almacen->ubicacion ?? '') }}" class="w-full border rounded-xl p-2 @error('ubicacion') border-red-500 @enderror">
                @error('ubicacion') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Capacidad</label>
                <input type="number" name="capacidad" min="0" value="{{ old('capacidad', $almacen->capacidad ?? 0) }}" class="w-full border rounded-xl p-2 @error('capacidad') border-red-500 @enderror">
                @error('capacidad') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('almacenes.index') }}" class="px-4 py-2 bg-gray-300 rounded-xl">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection
