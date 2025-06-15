@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Detalle Nota de Entrada #{{ $nota_entrada->id }}</h2>

        <div class="mb-4">
            <strong>Fecha:</strong> {{ $nota_entrada->fecha }} <br>
            <strong>Proveedor:</strong> {{ $nota_entrada->proveedor->nombre }} <br>
            <strong>Monto:</strong> {{ $nota_entrada->monto }} <br>
            <strong>Descripción:</strong> {{ $nota_entrada->descripcion ?? 'N/A' }} <br>
        </div>

        <table class="w-full border rounded-xl">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2">Producto</th>
                    <th class="p-2">Cantidad</th>
                    <th class="p-2">Precio U.</th>
                    <th class="p-2">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($nota_entrada->detalles as $detalle)
                <tr>
                    <td class="p-2">{{ $detalle->producto->nombre }}</td>
                    <td class="p-2">{{ $detalle->cantidad }}</td>
                    <td class="p-2">{{ $detalle->precio_unitario }}</td>
                    <td class="p-2">{{ $detalle->subtotal }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            <a href="{{ route('nota_entradas.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-xl">Volver</a>
        </div>
    </div>
</div>
@endsection
