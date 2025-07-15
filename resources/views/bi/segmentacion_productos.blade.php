@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">📦 Segmentación de Productos por Rotación</h2>
    </div>

    {{-- Buscador --}}
    <div class="mb-6">
        <form method="GET" action="{{ route('bi.rotacion.producto') }}" class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 space-y-3 sm:space-y-0">
            <div class="relative">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $search }}" 
                    placeholder="Buscar producto..." 
                    class="w-full sm:w-80 px-4 py-2 pl-10 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <select name="categoria" class="px-7 py-2 border border-gray-300 rounded-xl">
                <option value="">Todas las categorías</option>
                <option value="Alta" {{ $categoria == 'Alta' ? 'selected' : '' }}>Alta</option>
                <option value="Media" {{ $categoria == 'Media' ? 'selected' : '' }}>Media</option>
                <option value="Baja" {{ $categoria == 'Baja' ? 'selected' : '' }}>Baja</option>
            </select>

            <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-xl shadow-md">
                Buscar
            </button>

            @if($search)
                <a href="{{ route('bi.rotacion.producto') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold py-2 px-4 rounded-xl shadow-md">
                    Limpiar
                </a>
            @endif
        </form>
    </div>

    {{-- Resultados --}}
    @if($productos->count())
        <div class="bg-white shadow rounded-xl overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100 text-gray-700 font-semibold">
                    <tr>
                        <th class="px-4 py-2 text-left">Producto</th>
                        <th class="px-4 py-2 text-left">Stock</th>
                        <th class="px-4 py-2 text-left">Vendidos</th>
                        <th class="px-4 py-2 text-left">Días entre ventas</th>
                        <th class="px-4 py-2 text-left text-indigo-600">Categoría</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($productos as $producto)
                        <tr>
                            <td class="px-4 py-2 font-medium text-gray-900">{{ $producto['nombre'] }}</td>
                            <td class="px-4 py-2">{{ $producto['stock'] }}</td>
                            <td class="px-4 py-2">{{ $producto['total_vendido'] }}</td>
                            <td class="px-4 py-2">{{ number_format($producto['dias_entre_ventas'], 1) }}</td>
                            <td class="px-4 py-2 font-semibold text-indigo-700">{{ $producto['categoria_rotacion'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-yellow-100 text-yellow-800 px-4 py-3 rounded shadow mt-4">
            No hay datos disponibles.
        </div>
    @endif
</div>
@endsection
