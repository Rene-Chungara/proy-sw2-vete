@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 max-w-lg mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ isset($tipo_pago) ? 'Editar Tipo de Pago' : 'Crear Tipo de Pago' }}</h2>

        <form method="POST" action="{{ isset($tipo_pago) ? route('tipo_pagos.update', $tipo_pago) : route('tipo_pagos.store') }}">
            @csrf
            @if(isset($tipo_pago)) @method('PUT') @endif

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $tipo_pago->nombre ?? '') }}" class="w-full border rounded-xl p-2 @error('nombre') border-red-500 @enderror">
                @error('nombre') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('tipo_pagos.index') }}" class="px-4 py-2 bg-gray-300 rounded-xl">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection
