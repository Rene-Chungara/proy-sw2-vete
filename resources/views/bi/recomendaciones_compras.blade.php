@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">🛒 Recomendación de Compra - {{ $producto->nombre }}</h2>
        <a href="{{ route('bi.select') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Volver
        </a>
    </div>

    @if(isset($datos['message']))
        <div class="bg-yellow-100 text-yellow-800 px-4 py-3 rounded shadow">
            {{ $datos['message'] }}
        </div>
    @else
        <div class="bg-white shadow rounded-xl p-6">
            <p><strong>Producto ID:</strong> {{ $datos['producto_id'] }}</p>
            <p><strong>Stock Actual:</strong> {{ $datos['stock_actual'] }}</p>
            <p><strong>Demanda Estimada (30 días):</strong> {{ $datos['demanda_30_dias'] }}</p>
            <p class="text-green-700 font-semibold"><strong>Compra Sugerida:</strong> {{ $datos['compra_sugerida'] }}</p>
        </div>
    @endif
</div>
@endsection
