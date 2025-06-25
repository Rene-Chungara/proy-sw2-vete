<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>C&C SOFT</title>

    @vite('resources/css/app.css')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />

    <style>
        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden; /* Evita el scroll horizontal si hay elementos fuera de vista */
        }

        /* Animación para los elementos al cargar */
        @keyframes fadeInSlideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in-up {
            animation: fadeInSlideUp 0.6s ease-out forwards;
        }
        /* Retrasos para animaciones secuenciales */
        .animate-delay-1 { animation-delay: 0.2s; }
        .animate-delay-2 { animation-delay: 0.4s; }
        .animate-delay-3 { animation-delay: 0.6s; }
        .animate-delay-4 { animation-delay: 0.8s; }
    </style>
</head>
<body class="h-full antialiased text-gray-900 flex flex-col bg-gray-100">

    <header class="bg-gray-800 text-gray-300 py-4 px-6 sm:px-10 flex justify-between items-center shadow-lg relative z-20">
        <div class="flex items-center space-x-2 animate-fade-in-up">
            <span class="material-symbols-outlined text-3xl text-cyan-400">
                data_thresholding
            </span>
            <span class="text-2xl font-bold text-white">Admin Panel</span>
        </div>

        <div class="flex items-center space-x-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-300 hover:text-white px-4 py-2 rounded-lg border border-gray-700 hover:border-blue-500 transition-colors duration-300 animate-fade-in-up animate-delay-1">
                    <span class="material-symbols-outlined align-middle text-lg mr-1">dashboard</span> Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="font-semibold text-white px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 shadow-md transition-all duration-300 animate-fade-in-up animate-delay-1">
                    <span class="material-symbols-outlined align-middle text-lg mr-1">login</span> Iniciar Sesión
                </a>
            @endauth
        </div>
    </header>

    <main class="flex-1 flex flex-col items-center justify-center text-center p-8 bg-gray-100">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl p-8 sm:p-12 shadow-2xl border border-gray-200 animate-fade-in-up animate-delay-3">
            <span class="material-symbols-outlined text-6xl text-blue-600 mb-6">
                analytics
            </span>
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-gray-800 mb-6 leading-tight">
                Potencia tu Negocio <br class="hidden sm:inline"> con Datos Inteligentes
            </h1>
            <p class="text-lg sm:text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                Transforma tus datos de inventario y ventas en decisiones estratégicas. Nuestra plataforma te ayuda a optimizar, predecir y crecer.
            </p>
            <div class="space-y-4 sm:space-y-0 sm:space-x-6 flex flex-col sm:flex-row justify-center">
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-full shadow-lg text-white bg-blue-600 hover:bg-blue-700 transform hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <span class="material-symbols-outlined align-middle text-lg mr-2">arrow_forward</span> Empezar Ahora
                </a>
                <a href="#features" class="inline-flex items-center justify-center px-8 py-3 border border-gray-300 text-base font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 transform hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300">
                    <span class="material-symbols-outlined align-middle text-lg mr-2">info</span> Más Información
                </a>
            </div>
        </div>
    </main>

    <section id="features" class="bg-gray-50 py-16 px-8 text-center border-t border-gray-200">
        <h2 class="text-3xl font-bold text-gray-800 mb-10 animate-fade-in-up animate-delay-4">¿Por Qué Elegirnos?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-6xl mx-auto">
            <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200 transform hover:scale-105 transition-transform duration-300 animate-fade-in-up animate-delay-5">
                <span class="material-symbols-outlined text-6xl mx-auto mb-4 text-blue-500">query_stats</span>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Análisis Inteligente</h3>
                <p class="text-gray-600">Obtén insights profundos sobre tu inventario y ventas con herramientas de BI avanzadas.</p>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200 transform hover:scale-105 transition-transform duration-300 animate-fade-in-up animate-delay-6">
                <span class="material-symbols-outlined text-6xl mx-auto mb-4 text-cyan-500">trending_up</span>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Predicciones Precisas</h3>
                <p class="text-gray-600">Anticipa la demanda futura y optimiza tus niveles de stock para maximizar ganancias.</p>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200 transform hover:scale-105 transition-transform duration-300 animate-fade-in-up animate-delay-7">
                <span class="material-symbols-outlined text-6xl mx-auto mb-4 text-indigo-500">manage_accounts</span>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Gestión Simplificada</h3>
                <p class="text-gray-600">Una interfaz intuitiva y potente para administrar todos los aspectos de tu negocio.</p>
            </div>
        </div>
    </section>

    <footer class="bg-gray-800 text-gray-300 text-center p-6 text-sm">
        <p>&copy; {{ date('Y') }} C&CSOFT. Todos los derechos reservados.</p>
    </footer>

</body>
</html>