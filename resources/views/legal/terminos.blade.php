<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Términos y Condiciones') }}</title>

    @vite('resources/css/app.css')
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />

    <style>
        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden; /* Evita el scroll horizontal */
        }

        /* Animación de entrada */
        @keyframes fadeInSlideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInSlideUp 0.6s ease-out forwards;
        }

        /* Estilos para el contenido "prose" */
        .prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
            font-weight: 700; /* Extra bold */
            line-height: 1.2;
            margin-top: 1.5em;
            margin-bottom: 0.8em;
        }
        .prose p {
            margin-bottom: 1em;
            line-height: 1.6;
        }
        .prose ul {
            list-style-type: disc;
            margin-left: 1.5em;
            margin-bottom: 1em;
            padding-left: 0;
        }
        .prose ul li {
            margin-bottom: 0.5em;
        }
        .prose a {
            text-decoration: underline;
            color: #2563eb; /* blue-600 */
        }
        .prose strong {
            font-weight: 600; /* Semibold */
        }

        /* FIX: Asegurar que Material Symbols se aplique correctamente */
        .material-icons-fix {
            font-family: 'Material Symbols Outlined' !important;
            font-weight: normal !important;
            font-style: normal !important;
            font-size: 24px !important; /* Ajusta el tamaño si es necesario */
            line-height: 1 !important;
            letter-spacing: normal !important;
            text-transform: none !important;
            display: inline-block !important;
            white-space: nowrap !important;
            word-wrap: normal !important;
            direction: ltr !important;
            -webkit-font-feature-settings: 'liga' !important;
            -webkit-font-smoothing: antialiased !important;
            -moz-osx-font-smoothing: grayscale !important;
            vertical-align: middle;
        }
    </style>
</head>
<body class="h-full font-inter antialiased bg-gray-100 text-gray-900 flex flex-col">

    <header class="bg-gray-800 text-gray-300 py-4 px-6 sm:px-10 flex justify-between items-center shadow-lg relative z-20">
        <div class="flex items-center space-x-2">
            <span class="material-symbols-outlined text-3xl text-cyan-400">
                data_thresholding
            </span>
            <span class="text-2xl font-bold text-white">Admin Panel</span>
        </div>

        <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 border border-gray-700 rounded-lg text-gray-300 hover:text-white hover:bg-gray-700 transition-colors duration-200">
            <span class="material-symbols-outlined align-middle text-lg mr-2">arrow_back</span> Volver
        </a>
    </header>

    <main class="flex-1 py-12 px-4 sm:px-6 lg:px-8 overflow-y-auto"> {{-- main toma el resto del espacio y permite scroll --}}
        <div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-2xl border border-gray-200 p-8 sm:p-10 lg:p-12 animate-fade-in-up">
            
            <div class="text-center mb-10">
                <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 mb-4">Términos y Condiciones del Servicio</h1>
                <p class="text-gray-600 text-lg">Última actualización: {{ date('d') }} de {{ date('F', strtotime('now')) }} de {{ date('Y') }}</p>
            </div>

            <div class="prose max-w-none text-gray-700">
                <p>Bienvenido/a a <b>C&C SOFT.</b> Al acceder y utilizar nuestro software y servicios (en adelante, "el Servicio"), usted acepta estar sujeto/a a los siguientes términos y condiciones ("Términos de Servicio"). Si no está de acuerdo con todos los términos y condiciones de este acuerdo, no podrá acceder al Servicio.</p>

                <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">1. Aceptación de los Términos</h2>
                <p>Este acuerdo establece los términos y condiciones legalmente vinculantes para su uso del Servicio. Al utilizar el Servicio de cualquier manera, usted acepta estos Términos de Servicio. Estos Términos se aplican a todos los usuarios del Servicio.</p>

                <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">2. Descripción del Servicio</h2>
                <p><b>C&C SOFT</b> es un software de gestión de inventario y ventas con funcionalidades de inteligencia de negocio (BI), diseñado para ayudar a las empresas a optimizar sus operaciones, analizar datos de ventas y stock, y realizar predicciones de demanda.</p>

                <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">3. Registro de Cuenta</h2>
                <ul>
                    <li>Para acceder a ciertas funciones del Servicio, deberá registrar una cuenta.</li>
                    <li>Usted se compromete a proporcionar información de registro precisa, completa y actualizada.</li>
                    <li>Usted es responsable de mantener la confidencialidad de su contraseña y de todas las actividades que ocurran bajo su cuenta.</li>
                    <li>Debe notificarnos inmediatamente sobre cualquier uso no autorizado de su cuenta.</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">4. Licencia de Uso</h2>
                <p>Se le otorga una licencia limitada, no exclusiva, intransferible y revocable para utilizar el Servicio únicamente para fines comerciales internos y de acuerdo con estos Términos de Servicio.</p>

                <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">5. Propiedad Intelectual</h2>
                <ul>
                    <li>El Servicio y su contenido original, características y funcionalidad son y seguirán siendo propiedad exclusiva de <b>C&C SOFT</b> y sus licenciantes.</li>
                    <li>Usted no podrá modificar, copiar, distribuir, transmitir, mostrar, ejecutar, reproducir, publicar, licenciar, crear obras derivadas, transferir o vender ninguna información, software, productos o servicios obtenidos del Servicio.</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">6. Datos del Usuario y Privacidad</h2>
                <ul>
                    <li>Usted conserva la propiedad de todos los datos que cargue, transmita o procese a través del Servicio ("Sus Datos").</li>
                    <li>Usted nos otorga una licencia mundial, no exclusiva, libre de regalías, para usar, reproducir, adaptar, publicar y distribuir Sus Datos únicamente con el propósito de operar, mejorar y proporcionar el Servicio.</li>
                    <li>La recopilación y el uso de Sus Datos están sujetos a nuestra Política de Privacidad, la cual forma parte integral de estos Términos. Se recomienda leer nuestra <a href="#" class="text-blue-600 hover:underline font-medium">Política de Privacidad</a> para entender nuestras prácticas.</li>
                    <li>Usted es responsable de la legalidad, fiabilidad, integridad, exactitud y calidad de Sus Datos.</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">7. Conducta del Usuario</h2>
                <p>Usted acepta no utilizar el Servicio para:</p>
                <ul>
                    <li>Actividades ilegales o que infrinjan derechos de terceros.</li>
                    <li>Cargar o transmitir virus, malware o cualquier código destructivo.</li>
                    <li>Interferir o interrumpir el Servicio o los servidores o redes conectados al Servicio.</li>
                    <li>Intentar obtener acceso no autorizado a cualquier parte del Servicio o a otras cuentas.</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">8. Tarifas y Pagos (si aplica)</h2>
                <p>Si el Servicio es de pago, usted acepta pagar todas las tarifas aplicables de acuerdo con los términos de facturación vigentes en el momento en que se devuelva una tarifa. Nos reservamos el derecho de cambiar nuestras tarifas en cualquier momento, con previo aviso.</p>

                <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">9. Terminación</h2>
                <p>Podemos terminar o suspender su cuenta inmediatamente, sin previo aviso ni responsabilidad, por cualquier motivo, incluyendo sin limitación, si usted incumple los Términos de Servicio. Al terminar su cuenta, su derecho a usar el Servicio cesará inmediatamente.</p>

                <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">10. Limitación de Responsabilidad</h2>
                <p>En la máxima medida permitida por la ley aplicable, en ningún caso <b>C&C SOFT</b>, ni sus directores, empleados, socios, agentes, proveedores o afiliados, serán responsables de daños indirectos, incidentales, especiales, consecuentes o punitivos, incluyendo sin limitación, pérdida de ganancias, datos, uso, fondo de comercio u otras pérdidas intangibles, resultantes de (i) su acceso o uso o incapacidad de acceso o uso del Servicio; (ii) cualquier conducta o contenido de terceros en el Servicio; (iii) cualquier contenido obtenido del Servicio; y (iv) acceso no autorizado, uso o alteración de sus transmisiones o contenido, ya sea basado en garantía, contrato, agravio (incluida negligencia) o cualquier otra teoría legal, hayamos sido informados o no de la posibilidad de tales daños, e incluso si se determina que un remedio establecido en este documento ha fallado en su propósito esencial.</p>

                <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">11. Exención de Garantías</h2>
                <p>Su uso del Servicio es bajo su propio riesgo. El Servicio se proporciona "TAL CUAL" y "SEGÚN DISPONIBILIDAD", sin garantías de ningún tipo, ya sean expresas o implícitas, incluyendo, pero no limitado a, garantías implícitas de comerciabilidad, idoneidad para un propósito particular, no infracción o curso de ejecución.</p>
                <p><b>C&C SOFT</b> no garantiza que el Servicio funcionará de manera ininterrumpida, segura o disponible en cualquier momento o lugar particular; que los errores o defectos serán corregidos; que el Servicio esté libre de virus u otros componentes dañinos; o que los resultados del uso del Servicio cumplirán con sus requisitos.</p>

                <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">12. Ley Aplicable</h2>
                <p>Estos Términos se regirán e interpretarán de acuerdo con las leyes del Estado Plurinacional de Bolivia, sin tener en cuenta sus disposiciones sobre conflicto de leyes.</p>

                <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">13. Cambios a los Términos</h2>
                <p>Nos reservamos el derecho, a nuestra entera discreción, de modificar o reemplazar estos Términos en cualquier momento. Si una revisión es material, intentaremos proporcionar al menos 30 días de aviso antes de que los nuevos términos entren en vigencia. Lo que constituye un cambio material se determinará a nuestra entera discreción.</p>

                <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">14. Contacto</h2>
                <p>Si tiene alguna pregunta sobre estos Términos de Servicio, por favor contáctenos a través de:</p>
                <p>Email: <a href="mailto:chungara.rene@ficct.uagrm.edu.bo" class="text-blue-600 hover:underline font-medium">chungara.rene@ficct.uagrm.edu.bo</a></p>
                <p>Dirección: Av. Busch, 4to Anillo, Calle 6 Centro Empresarial Mediterraneo, Piso 10, Santa Cruz de la Sierra, Bolivia</p>
            </div>

            <div class="mt-10 text-center">
                <a href="{{ url()->previous() }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full shadow-lg text-white bg-blue-600 hover:bg-blue-700 transform hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <span class="material-symbols-outlined align-middle text-lg mr-2 material-icons-fix">arrow_back</span> Entendido, Volver
                </a>
            </div>

        </div>
    </main>

    <footer class="bg-gray-800 text-gray-300 text-center p-6 text-sm mt-auto"> {{-- mt-auto empuja el footer hacia abajo --}}
        <p>&copy; {{ date('Y') }} {{ config('app.name', 'Tu Empresa') }}. Todos los derechos reservados.</p>
    </footer>

</body>
</html>