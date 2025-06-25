@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 max-w-lg mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ isset($producto) ? 'Editar Producto' : 'Crear Producto' }}</h2>

        <form method="POST" action="{{ isset($producto) ? route('productos.update', $producto) : route('productos.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($producto)) @method('PUT') @endif

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre ?? '') }}" class="w-full border rounded-xl p-2 @error('nombre') border-red-500 @enderror">
                @error('nombre') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Código</label>
                <input type="text" name="codigo" value="{{ old('codigo', $producto->codigo ?? '') }}" class="w-full border rounded-xl p-2 @error('codigo') border-red-500 @enderror">
                @error('codigo') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Stock</label>
                <input type="number" name="stock" min="0" value="{{ old('stock', $producto->stock ?? 0) }}" class="w-full border rounded-xl p-2 @error('stock') border-red-500 @enderror">
                @error('stock') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Categoría</label>
                <select name="categoria_id" class="w-full border rounded-xl p-2 @error('categoria_id') border-red-500 @enderror">
                    <option value="">Seleccione...</option>
                    @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ old('categoria_id', $producto->categoria_id ?? '') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                    @endforeach
                </select>
                @error('categoria_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Almacén</label>
                <select name="almacen_id" class="w-full border rounded-xl p-2 @error('almacen_id') border-red-500 @enderror">
                    <option value="">Seleccione...</option>
                    @foreach($almacenes as $almacen)
                    <option value="{{ $almacen->id }}" {{ old('almacen_id', $producto->almacen_id ?? '') == $almacen->id ? 'selected' : '' }}>
                        {{ $almacen->nombre }}
                    </option>
                    @endforeach
                </select>
                @error('almacen_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Descripción</label>
                <textarea name="descripcion" class="w-full border rounded-xl p-2 @error('descripcion') border-red-500 @enderror">{{ old('descripcion', $producto->descripcion ?? '') }}</textarea>
                @error('descripcion') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Foto</label>
                <input type="file" name="foto" class="w-full border rounded-xl p-2 @error('foto') border-red-500 @enderror">
                @if(isset($producto) && $producto->foto)
                    <p class="mt-2 text-sm">Actual: <img src="{{ asset('storage/'.$producto->foto) }}" class="w-24 h-24 object-cover rounded"></p>
                @endif
                @error('foto') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('productos.index') }}" class="px-4 py-2 bg-gray-300 rounded-xl">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection
