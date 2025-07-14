@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">

    {{-- Título Principal --}}
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">
        📊 Dashboard de Inteligencia de Negocio - Inventarios
    </h2>
    <div class="flex justify-center mb-6">
        <form method="POST" action="{{ route('bi.actualizar') }}">
            @csrf
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-lg shadow">
                🔄 Actualizar Datos BI
            </button>
        </form>
    </div>

    {{-- Primera fila de gráficos --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        {{-- ABC Chart --}}
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h3 class="text-xl font-semibold text-center text-gray-700 mb-4">
                Clasificación ABC de Productos
            </h3>
            <div class="h-64">
                <canvas id="abcChart"></canvas>
            </div>
        </div>

        {{-- Stock vs ROP Chart --}}
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h3 class="text-xl font-semibold text-center text-gray-700 mb-4">
                Stock Actual vs Punto de Reorden (ROP)
            </h3>
            <div class="h-64">
                <canvas id="stockROPChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Segunda fila de gráficos --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        {{-- Productos Cercanos al ROP --}}
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h3 class="text-xl font-semibold text-center text-gray-700 mb-4">
                Productos Cerca del Punto de Reorden (ROP)
            </h3>
            <div class="h-64">
                <canvas id="ropProductsChart"></canvas>
            </div>
        </div>

        {{-- Valor por categoría ABC --}}
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h3 class="text-xl font-semibold text-center text-gray-700 mb-4">
                Valor Total de Inventario por Categoría ABC
            </h3>
            <div class="h-64">
                <canvas id="abcValueChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Tabla de Recomendaciones --}}
    <div class="bg-white rounded-2xl shadow-md p-6 mb-10">
        <h3 class="text-xl font-semibold text-center text-gray-700 mb-6">
            📦 Recomendaciones de Inventario por Producto
        </h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">Producto</th>
                        <th class="px-4 py-3 text-left">Stock Actual</th>
                        <th class="px-4 py-3 text-left">Cantidad Óptima (EOQ)</th>
                        <th class="px-4 py-3 text-left">Punto Reorden (ROP)</th>
                        <th class="px-4 py-3 text-left">Categoría ABC</th>
                        <th class="px-4 py-3 text-left">Estado</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($bi as $row)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $row->producto }}</td>
                            <td class="px-4 py-2">
                                {{ $row->stock }}
                                @if($row->stock <= $row->rop)
                                    <span class="ml-2 text-red-500 font-semibold text-xs">
                                        <i class="fas fa-exclamation-triangle"></i> Bajo
                                    </span>
                                @else
                                    <span class="ml-2 text-green-600 text-xs">
                                        <i class="fas fa-check-circle"></i> OK
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ number_format($row->eoq, 0) }} unid.</td>
                            <td class="px-4 py-2">{{ number_format($row->rop, 0) }} unid.</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 rounded-full text-xs font-medium 
                                    {{ $row->clasificacion_abc === 'A' ? 'bg-blue-100 text-blue-800' : ($row->clasificacion_abc === 'B' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ $row->clasificacion_abc }}
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                @if($row->stock <= $row->rop)
                                    <span class="inline-block px-2 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded-full">¡Reponer!</span>
                                @else
                                    <span class="inline-block px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">Normal</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Configuración base para todos los gráficos para responsividad
    const commonChartOptions = {
        responsive: true,
        maintainAspectRatio: false, // Esencial para controlar el tamaño con el contenedor padre
        plugins: {
            legend: {
                position: 'bottom', // Generalmente mejor para móviles
                labels: {
                    boxWidth: 20,
                    font: {
                        size: window.innerWidth < 640 ? 10 : 12 // Tamaño de fuente más pequeño en móvil
                    }
                }
            },
            tooltip: {
                // Puedes personalizar tooltips aquí si lo necesitas
            }
        },
        scales: { // Sólo para gráficos de barras/líneas
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Unidades',
                    font: {
                        size: window.innerWidth < 640 ? 10 : 12 // Tamaño de fuente más pequeño en móvil
                    }
                },
                ticks: {
                    font: {
                        size: window.innerWidth < 640 ? 10 : 12 // Tamaño de fuente más pequeño en móvil
                    }
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Producto',
                    font: {
                        size: window.innerWidth < 640 ? 10 : 12 // Tamaño de fuente más pequeño en móvil
                    }
                },
                ticks: {
                    font: {
                        size: window.innerWidth < 640 ? 10 : 12 // Tamaño de fuente más pequeño en móvil
                    },
                    autoSkip: true, // Auto-skip labels to avoid overlap
                    maxRotation: 0, // No rotar etiquetas en móvil
                    minRotation: 0
                }
            }
        }
    };


    // Gráfico de Clasificación ABC
    const abcCtx = document.getElementById('abcChart').getContext('2d');
    new Chart(abcCtx, {
        type: 'pie',
        data: {
            labels: ['Clase A (Más Importantes)', 'Clase B (Importancia Media)', 'Clase C (Menos Críticos)'],
            datasets: [{
                data: [
                    {{ $abcChart['A'] ?? 0 }},
                    {{ $abcChart['B'] ?? 0 }},
                    {{ $abcChart['C'] ?? 0 }}
                ],
                backgroundColor: ['#3b82f6', '#10b981', '#f59e0b'],
                hoverOffset: 4
            }]
        },
        options: {
            ...commonChartOptions,
            scales: {} // Pie charts don't have scales
        }
    });

    // Gráfico de Comparación Stock vs ROP
    const stockROPCtx = document.getElementById('stockROPChart').getContext('2d');
    const biData = @json($bi);

    const relevantProducts = biData.filter(item => item.stock > 0).slice(0, window.innerWidth < 640 ? 5 : 10);
    const productNames = relevantProducts.map(item => item.producto);
    const productStocks = relevantProducts.map(item => item.stock);
    const productROPs = relevantProducts.map(item => item.rop);

    new Chart(stockROPCtx, {
        type: 'bar',
        data: {
            labels: productNames,
            datasets: [{
                label: 'Stock Actual',
                data: productStocks,
                backgroundColor: 'rgba(59, 130, 246, 0.7)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 1
            }, {
                label: 'Punto de Reorden (ROP)',
                data: productROPs,
                backgroundColor: 'rgba(239, 68, 68, 0.7)',
                borderColor: 'rgba(239, 68, 68, 1)',
                borderWidth: 1
            }]
        },
        options: {
            ...commonChartOptions,
            plugins: {
                ...commonChartOptions.plugins,
                legend: {
                    position: 'top',
                    labels: {
                        boxWidth: 20,
                        font: {
                            size: window.innerWidth < 640 ? 10 : 12
                        }
                    }
                }
            }
        }
    });

    // --- Nuevos Gráficos ---

    // 1. Gráfico de Productos Cerca del ROP (Bar Chart)
    const ropProductsCtx = document.getElementById('ropProductsChart').getContext('2d');

    const criticalProducts = biData.filter(item => item.stock <= item.rop * 1.2).slice(0, window.innerWidth < 640 ? 5 : 10);
    const criticalProductNames = criticalProducts.map(item => item.producto);
    const criticalProductStocks = criticalProducts.map(item => item.stock);
    const criticalProductROPs = criticalProducts.map(item => item.rop);

    new Chart(ropProductsCtx, {
        type: 'bar',
        data: {
            labels: criticalProductNames,
            datasets: [
                {
                    label: 'Stock Actual',
                    data: criticalProductStocks,
                    backgroundColor: 'rgba(239, 68, 68, 0.7)',
                    borderColor: 'rgba(239, 68, 68, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Punto de Reorden (ROP)',
                    data: criticalProductROPs,
                    backgroundColor: 'rgba(245, 158, 11, 0.7)',
                    borderColor: 'rgba(245, 158, 11, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            ...commonChartOptions,
            plugins: {
                ...commonChartOptions.plugins,
                legend: {
                    position: 'top',
                    labels: {
                        boxWidth: 20,
                        font: {
                            size: window.innerWidth < 640 ? 10 : 12
                        }
                    }
                }
            }
        }
    });

    // 2. Gráfico de Valor de Inventario por Categoría ABC (Doughnut Chart)
    const abcValueCtx = document.getElementById('abcValueChart').getContext('2d');

    const calculateABCValue = (data) => {
        let valueA = 0;
        let valueB = 0;
        let valueC = 0;

        data.forEach(item => {
            const itemValue = item.stock * (item.precio || 1);
            if (item.clasificacion_abc === 'A') {
                valueA += itemValue;
            } else if (item.clasificacion_abc === 'B') {
                valueB += itemValue;
            } else if (item.clasificacion_abc === 'C') {
                valueC += itemValue;
            }
        });
        return { valueA, valueB, valueC };
    };

    const { valueA, valueB, valueC } = calculateABCValue(biData);

    new Chart(abcValueCtx, {
        type: 'doughnut',
        data: {
            labels: ['Valor Clase A', 'Valor Clase B', 'Valor Clase C'],
            datasets: [{
                data: [valueA, valueB, valueC],
                backgroundColor: ['#3b82f6', '#10b981', '#f59e0b'],
                hoverOffset: 4
            }]
        },
        options: {
            ...commonChartOptions,
            scales: {}
        }
    });

</script>
@endsection