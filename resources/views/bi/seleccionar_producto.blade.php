@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">🔎 Seleccionar Producto para Predicción</h2>

    <form onsubmit="event.preventDefault(); const id = this.producto_id.value; if(id) window.location.href='/bi/prediccion/' + id;">
        <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 space-y-4 sm:space-y-0">
            <select name="producto_id" class="border border-gray-300 rounded-lg p-2 w-full sm:w-80" required>
                <option value="">-- Selecciona un producto --</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg w-full sm:w-auto">
                Ver Predicción 📈
            </button>

            <button type="button" onclick="const id = this.form.producto_id.value; if(id) window.location.href='/bi/recomendacion-compra/' + id;" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                Ver Compra Sugerida 🛒
            </button>
        </div>
    </form>
</div>
@endsection
