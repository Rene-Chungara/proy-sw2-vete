@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            📈 Predicción de Demanda - Producto {{ $producto->nombre }}
        </h2>

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
        @php
            $horizontes = ['mensual' => '30 días', 'trimestral' => '3 meses', 'semestral' => '6 meses', 'anual' => '12 meses'];
        @endphp

        @foreach($horizontes as $clave => $titulo)
            @if(isset($datos[$clave]))
                <div class="bg-white p-6 rounded-xl shadow mb-8">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700">
                        Proyección: {{ ucfirst($clave) }} ({{ $titulo }})
                    </h3>
                    <div class="w-full h-80 sm:h-96 lg:h-[400px]">
                        <canvas id="chart_{{ $clave }}"></canvas>
                    </div>
                </div>
            @endif
        @endforeach

        <div class="text-sm text-gray-600 p-4 bg-white rounded-xl shadow mb-8">
            <p class="mb-2 font-semibold">📌 Leyenda del Gráfico:</p>
            <p class="flex items-center mb-1"><span class="inline-block w-4 h-4 rounded-full mr-2 bg-blue-600"></span> <strong>Demanda esperada:</strong> Predicción base</p>
            <p class="flex items-center mb-1"><span class="inline-block w-4 h-4 rounded-full mr-2 bg-red-500"></span> <strong>Máximo estimado:</strong> Intervalo superior</p>
            <p class="flex items-center"><span class="inline-block w-4 h-4 rounded-full mr-2 bg-yellow-400"></span> <strong>Mínimo estimado:</strong> Intervalo inferior</p>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const datasets = @json($datos);

            for (const [key, series] of Object.entries(datasets)) {
                const ctx = document.getElementById(`chart_${key}`).getContext('2d');

                const labels = series.map(item => new Date(item.ds).toLocaleDateString('es-ES'));
                const yhat = series.map(item => item.yhat);
                const upper = series.map(item => item.yhat_upper);
                const lower = series.map(item => item.yhat_lower);

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Demanda esperada',
                                data: yhat,
                                borderColor: '#3b82f6',
                                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                                tension: 0.3,
                                fill: false,
                                pointRadius: 2,
                                pointHoverRadius: 4
                            },
                            {
                                label: 'Máximo estimado',
                                data: upper,
                                borderColor: '#ef4444',
                                borderDash: [5, 5],
                                tension: 0.3,
                                fill: false,
                                pointRadius: 0
                            },
                            {
                                label: 'Mínimo estimado',
                                data: lower,
                                borderColor: '#facc15',
                                borderDash: [5, 5],
                                tension: 0.3,
                                fill: false,
                                pointRadius: 0
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    font: {
                                        size: window.innerWidth < 640 ? 10 : 12
                                    }
                                }
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false
                            }
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Fecha',
                                    font: {
                                        size: 12
                                    }
                                },
                                ticks: {
                                    maxRotation: 45,
                                    minRotation: 45
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Cantidad Estimada',
                                    font: {
                                        size: 12
                                    }
                                },
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        </script>
    @endif
</div>
@endsection
