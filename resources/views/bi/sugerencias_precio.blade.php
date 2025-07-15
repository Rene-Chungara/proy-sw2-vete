@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">💰 Sugerencias de Precios Dinámicos</h2>
    </div>

    {{-- Buscador --}}
    <div class="mb-6">
        <form method="GET" action="{{ route('bi.precio.producto') }}" class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 space-y-3 sm:space-y-0">
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

            <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-xl shadow-md">
                Buscar
            </button>

            @if($search)
                <a href="{{ route('bi.precio.producto') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold py-2 px-4 rounded-xl shadow-md">
                    Limpiar
                </a>
            @endif
        </form>
    </div>

    {{-- Resumen de búsqueda --}}
    @if($search)
        <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-xl">
            <p class="text-blue-800">
                <span class="font-semibold">Búsqueda:</span> "{{ $search }}" 
                <span class="text-sm">({{ $sugerencias->count() }} resultado{{ $sugerencias->count() !== 1 ? 's' : '' }})</span>
            </p>
        </div>
    @endif

    {{-- Tabla de sugerencias --}}
    @if($sugerencias->count())
        <div class="bg-white shadow rounded-xl overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100 text-gray-700 font-semibold">
                    <tr>
                        <th class="px-4 py-2 text-left">Producto</th>
                        <th class="px-4 py-2 text-left">Stock</th>
                        <th class="px-4 py-2 text-left">Vendidos</th>
                        <th class="px-4 py-2 text-left">Precio Actual</th>
                        <th class="px-4 py-2 text-left">Promedio Venta</th>
                        <th class="px-4 py-2 text-left text-green-600">Precio Sugerido</th>
                        <th class="px-4 py-2 text-left">Motivo</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($sugerencias as $item)
                        <tr>
                            <td class="px-4 py-2 font-medium text-gray-900">{{ $item['nombre'] }}</td>
                            <td class="px-4 py-2">{{ $item['stock'] }}</td>
                            <td class="px-4 py-2">{{ $item['vendidos'] }}</td>
                            <td class="px-4 py-2 text-blue-600">${{ number_format($item['precio_actual'], 2) }}</td>
                            <td class="px-4 py-2">${{ number_format($item['precio_promedio_venta'], 2) }}</td>
                            <td class="px-4 py-2 text-green-700 font-bold">${{ number_format($item['precio_sugerido'], 2) }}</td>
                            <td class="px-4 py-2 text-gray-700">{{ $item['sugerencia'] ?? '—' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-yellow-100 text-yellow-800 px-4 py-3 rounded shadow">
            No hay sugerencias disponibles.
        </div>
    @endif
</div>
@endsection
