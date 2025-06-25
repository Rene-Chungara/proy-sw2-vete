@extends('layouts.app')

@section('content')
<div class="container mx-auto px-2 py-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Reportes</h2>

    <!-- KPI cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded-xl shadow text-center">
            <p class="text-gray-500">Total Ventas</p>
            <p class="text-2xl font-bold text-blue-600">Bs. {{ number_format($totalVentas, 2) }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl shadow text-center">
            <p class="text-gray-500">Movimientos</p>
            <p class="text-2xl font-bold text-green-600">{{ $movimientos }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl shadow text-center">
            <p class="text-gray-500">Cantidad Vendida</p>
            <p class="text-2xl font-bold text-indigo-600">{{ $cantidadVendida }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl shadow text-center">
            <p class="text-gray-500">Stock bajo (&lt;5)</p>
            <p class="text-2xl font-bold text-red-600">{{ $stockBajo }}</p>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white p-4 rounded-xl shadow">
            <h3 class="text-lg font-semibold mb-2">Ventas diarias (últimos 30 días)</h3>
            <canvas id="ventasDiaChart" height="200"></canvas>
        </div>
        <div class="bg-white p-4 rounded-xl shadow">
            <h3 class="text-lg font-semibold mb-2">Movimientos por producto</h3>
            <canvas id="movimientosChart" height="200"></canvas>
        </div>
        <div class="bg-white p-4 rounded-xl shadow">
            <h3 class="text-lg font-semibold mb-2">Top 5 productos</h3>
            <canvas id="productosTopChart" height="200"></canvas>
        </div>
        <div class="bg-white p-4 rounded-xl shadow">
            <h3 class="text-lg font-semibold mb-2">Ventas por tipo de pago</h3>
            <canvas id="tipoPagoChart" height="200"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('ventasDiaChart').getContext('2d'), {
    type: 'line',
    data: {
        labels: {!! json_encode($ventasDia->pluck('dia')) !!},
        datasets: [{
            label: 'Ventas diarias Bs.',
            data: {!! json_encode($ventasDia->pluck('total')) !!},
            borderColor: '#3b82f6',
            backgroundColor: 'rgba(59, 130, 246, 0.2)',
            fill: true
        }]
    }
});

new Chart(document.getElementById('movimientosChart').getContext('2d'), {
    type: 'bar',
    data: {
        labels: {!! json_encode($movimientosProducto->pluck('producto.nombre')) !!},
        datasets: [{
            label: 'Movimientos',
            data: {!! json_encode($movimientosProducto->pluck('cantidad')) !!},
            backgroundColor: '#10b981'
        }]
    }
});

new Chart(document.getElementById('productosTopChart').getContext('2d'), {
    type: 'pie',
    data: {
        labels: {!! json_encode($productosTop->pluck('producto.nombre')) !!},
        datasets: [{
            data: {!! json_encode($productosTop->pluck('total')) !!},
            backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6']
        }]
    }
});

new Chart(document.getElementById('tipoPagoChart').getContext('2d'), {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($tipoPago->pluck('tipoPago.nombre')) !!},
        datasets: [{
            data: {!! json_encode($tipoPago->pluck('total')) !!},
            backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444']
        }]
    }
});
</script>
@endsection
