@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 max-w-lg mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ isset($cliente) ? 'Editar Cliente' : 'Crear Cliente' }}</h2>

        <form method="POST" action="{{ isset($cliente) ? route('clientes.update', $cliente) : route('clientes.store') }}">
            @csrf
            @if(isset($cliente)) @method('PUT') @endif

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $cliente->nombre ?? '') }}" class="w-full border rounded-xl p-2 @error('nombre') border-red-500 @enderror">
                @error('nombre') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">CI</label>
                <input type="text" name="ci" value="{{ old('ci', $cliente->ci ?? '') }}" class="w-full border rounded-xl p-2 @error('ci') border-red-500 @enderror">
                @error('ci') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('clientes.index') }}" class="px-4 py-2 bg-gray-300 rounded-xl">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection
