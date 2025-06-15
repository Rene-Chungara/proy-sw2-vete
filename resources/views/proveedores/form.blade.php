@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 max-w-lg mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ isset($proveedor) ? 'Editar Proveedor' : 'Crear Proveedor' }}</h2>

        <form method="POST" action="{{ isset($proveedor) ? route('proveedores.update', $proveedor) : route('proveedores.store') }}">
            @csrf
            @if(isset($proveedor)) @method('PUT') @endif

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $proveedor->nombre ?? '') }}" class="w-full border rounded-xl p-2 @error('nombre') border-red-500 @enderror">
                @error('nombre') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Teléfono</label>
                <input type="text" name="telefono" value="{{ old('telefono', $proveedor->telefono ?? '') }}" class="w-full border rounded-xl p-2 @error('telefono') border-red-500 @enderror">
                @error('telefono') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Correo</label>
                <input type="email" name="correo" value="{{ old('correo', $proveedor->correo ?? '') }}" class="w-full border rounded-xl p-2 @error('correo') border-red-500 @enderror">
                @error('correo') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Ciudad</label>
                <input type="text" name="ciudad" value="{{ old('ciudad', $proveedor->ciudad ?? '') }}" class="w-full border rounded-xl p-2 @error('ciudad') border-red-500 @enderror">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">País</label>
                <input type="text" name="pais" value="{{ old('pais', $proveedor->pais ?? '') }}" class="w-full border rounded-xl p-2 @error('pais') border-red-500 @enderror">
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('proveedores.index') }}" class="px-4 py-2 bg-gray-300 rounded-xl">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection
