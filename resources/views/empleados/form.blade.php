@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 max-w-lg mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">
            {{ isset($empleado) ? 'Editar Empleado' : 'Crear Empleado' }}
        </h2>

        <form method="POST" action="{{ isset($empleado) ? route('empleados.update', $empleado) : route('empleados.store') }}">
            @csrf
            @if(isset($empleado))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">CI</label>
                <input type="text" name="ci" value="{{ old('ci', $empleado->ci ?? '') }}" class="w-full border rounded-xl p-2 @error('ci') border-red-500 @enderror">
                @error('ci') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $empleado->nombre ?? '') }}" class="w-full border rounded-xl p-2 @error('nombre') border-red-500 @enderror">
                @error('nombre') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Sexo</label>
                <select name="sexo" class="w-full border rounded-xl p-2">
                    <option value="">Seleccione</option>
                    <option value="M" {{ old('sexo', $empleado->sexo ?? '') == 'M' ? 'selected' : '' }}>Masculino</option>
                    <option value="F" {{ old('sexo', $empleado->sexo ?? '') == 'F' ? 'selected' : '' }}>Femenino</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Cargo</label>
                <input type="text" name="cargo" value="{{ old('cargo', $empleado->cargo ?? '') }}" class="w-full border rounded-xl p-2">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Dirección</label>
                <input type="text" name="direccion" value="{{ old('direccion', $empleado->direccion ?? '') }}" class="w-full border rounded-xl p-2">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Teléfono</label>
                <input type="text" name="telefono" value="{{ old('telefono', $empleado->telefono ?? '') }}" class="w-full border rounded-xl p-2">
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('empleados.index') }}" class="px-4 py-2 bg-gray-300 rounded-xl">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection
