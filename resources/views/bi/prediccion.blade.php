@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">📈 Predicción de Demanda - Producto {{ $producto->nombre }}</h2>
        
        <a href="{{ route('bi.select') ?? '#' }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
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
        <div class="bg-white p-6 rounded-xl shadow mb-8">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">Proyección de demanda futura</h3>
            {{-- Aseguramos que el contenedor del canvas tenga una altura y ancho flexible --}}
            <div class="w-full h-80 sm:h-96 lg:h-[400px]"> {{-- Altura responsiva --}}
                <canvas id="chart"></canvas>
            </div>
        </div>

        <div class="text-sm text-gray-500 p-4 bg-white rounded-xl shadow mb-8"> {{-- Añadí p-4, bg-white, etc. para que sea un card --}}
            <p class="mb-2"><strong>Leyenda del Gráfico:</strong></p>
            <p class="flex items-center mb-1"><span class="inline-block w-4 h-4 rounded-full mr-2 bg-blue-600"></span> <strong>Demanda esperada:</strong> Proyección central generada por el modelo Prophet.</p>
            <p class="flex items-center mb-1"><span class="inline-block w-4 h-4 rounded-full mr-2 bg-red-500"></span> <strong>Máximo estimado:</strong> Margen superior de confianza (demanda máxima posible).</p>
            <p class="flex items-center"><span class="inline-block w-4 h-4 rounded-full mr-2 bg-yellow-400"></span> <strong>Mínimo estimado:</strong> Margen inferior de confianza (demanda mínima posible).</p>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const data = @json($datos);

            // Opciones comunes para los gráficos para responsividad
            const commonChartOptions = {
                responsive: true,
                maintainAspectRatio: false, // Permite que el contenedor padre controle el tamaño
                plugins: {
                    legend: {
                        position: 'top', // Para líneas, la leyenda arriba es común
                        labels: {
                            font: {
                                size: window.innerWidth < 640 ? 10 : 12 // Tamaño de fuente para leyenda
                            }
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    },
                    title: {
                        display: false // Ya tenemos un h3 para el título del gráfico
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Fecha',
                            color: '#6b7280',
                            font: { size: window.innerWidth < 640 ? 12 : 14 } // Tamaño de fuente para título de eje
                        },
                        ticks: {
                            font: { size: window.innerWidth < 640 ? 10 : 12 }, // Tamaño de fuente para etiquetas de ticks
                            maxRotation: 45, // Rotar un poco para evitar superposición en fechas
                            minRotation: 45
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Cantidad Estimada',
                            color: '#6b7280',
                            font: { size: window.innerWidth < 640 ? 12 : 14 }
                        },
                        beginAtZero: true,
                        ticks: {
                            font: { size: window.innerWidth < 640 ? 10 : 12 }
                        }
                    }
                }
            };


            const ctx = document.getElementById('chart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.map(item => item.ds),
                    datasets: [
                        {
                            label: 'Demanda esperada',
                            data: data.map(item => item.yhat),
                            borderColor: '#3b82f6', // blue-600
                            backgroundColor: 'rgba(59, 130, 246, 0.2)', // blue-600 con transparencia
                            tension: 0.3,
                            fill: false,
                            pointRadius: 3, // Tamaño de los puntos
                            pointHoverRadius: 5
                        },
                        {
                            label: 'Máximo estimado',
                            data: data.map(item => item.yhat_upper),
                            borderColor: '#ef4444', // red-500
                            borderDash: [5, 5], // Línea punteada
                            tension: 0.3,
                            fill: false,
                            pointRadius: 0, // Sin puntos para las líneas de confianza
                            pointHoverRadius: 0
                        },
                        {
                            label: 'Mínimo estimado',
                            data: data.map(item => item.yhat_lower),
                            borderColor: '#facc15', // yellow-400
                            borderDash: [5, 5],
                            tension: 0.3,
                            fill: false,
                            pointRadius: 0,
                            pointHoverRadius: 0
                        }
                    ]
                },
                options: commonChartOptions
            });
        </script>
    @endif
</div>
@endsection