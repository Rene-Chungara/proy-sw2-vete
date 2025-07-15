<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite('resources/css/app.css')
    @livewireStyles
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 font-inter antialiased">

    <div class="flex min-h-screen">
        <!-- Sidebar Toggle Checkbox (Hidden) - Controls the mobile sidebar visibility -->
        <input id="menu-toggle" type="checkbox" class="hidden peer">

        <aside class="bg-gradient-to-br from-gray-900 to-gray-800 text-gray-300 w-64 shadow-2xl
               transform md:translate-x-0 fixed md:static inset-y-0 left-0 z-40
               transition-transform duration-300 ease-in-out -translate-x-full
               flex flex-col rounded-r-2xl md:rounded-none overflow-y-auto">

            <div class="p-6 text-2xl font-bold border-b border-gray-700 flex items-center justify-center space-x-3">
                <span class="material-symbols-outlined text-3xl text-cyan-400">
                    data_thresholding
                </span>
                <span class="text-white">Admin Panel</span>
            </div>

            <nav class="p-4 space-y-2 flex-grow">

                <div x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-3 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                        <div class="flex items-center">
                            <span class="material-symbols-outlined mr-3">analytics</span>
                            <span>Analisis</span>
                        </div>
                        <span class="material-symbols-outlined transition-transform" :class="{'rotate-90': open}">chevron_right</span>
                    </button>
                    <div x-show="open" x-transition class="pl-6 pt-2 space-y-2">
                        <a href="{{ route('bi.dashboard') ?? '#' }}" class="flex items-center p-2 rounded-lg hover:bg-gray-700 text-sm">
                            <span class="material-symbols-outlined mr-3 text-base">monitoring</span> Analisis BI
                        </a>
                        <a href="{{ route('bi.select') ?? '#' }}" class="flex items-center p-2 rounded-lg hover:bg-gray-700 text-sm">
                            <span class="material-symbols-outlined mr-3 text-base">insights</span> Prediccion de Ventas
                        </a>
                        <a href="{{ route('bi.precio.producto') ?? '#' }}" class="flex items-center p-2 rounded-lg hover:bg-gray-700 text-sm">
                            <span class="material-symbols-outlined mr-3 text-base">price_change</span> Sugerencia de precio
                        </a>
                        <a href="{{ route('bi.rotacion.producto') ?? '#' }}" class="flex items-center p-2 rounded-lg hover:bg-gray-700 text-sm">
                            <span class="material-symbols-outlined mr-3 text-base">segment</span> Segmentacion por Producto
                        </a>
                        <a href="{{ route('bi.clasificacion.proveedor') ?? '#' }}" class="flex items-center p-2 rounded-lg hover:bg-gray-700 text-sm">
                            <span class="material-symbols-outlined mr-3 text-base">inbox_text_person</span> Clasificacion de Proveedores
                        </a>
                    </div>
                </div>

                <div x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-3 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                        <div class="flex items-center">
                            <span class="material-symbols-outlined mr-3">storefront</span>
                            <span>Ventas</span>
                        </div>
                        <span class="material-symbols-outlined transition-transform" :class="{'rotate-90': open}">chevron_right</span>
                    </button>
                    <div x-show="open" x-transition class="pl-6 pt-2 space-y-2">
                        <a href="{{ route('nota_ventas.index') ?? '#' }}" class="flex items-center p-2 rounded-lg hover:bg-gray-700 text-sm">
                            <span class="material-symbols-outlined mr-3 text-base">receipt_long</span> Ventas
                        </a>
                        <a href="{{ route('clientes.index') ?? '#' }}" class="flex items-center p-2 rounded-lg hover:bg-gray-700 text-sm">
                            <span class="material-symbols-outlined mr-3 text-base">groups</span> Clientes
                        </a>
                        <a href="{{ route('tipo_pagos.index') ?? '#' }}" class="flex items-center p-2 rounded-lg hover:bg-gray-700 text-sm">
                            <span class="material-symbols-outlined mr-3 text-base">payments</span> Formas de Pago
                        </a>
                    </div>
                </div>

                <div x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-3 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                        <div class="flex items-center">
                            <span class="material-symbols-outlined mr-3">inventory_2</span>
                            <span>Inventario</span>
                        </div>
                        <span class="material-symbols-outlined transition-transform" :class="{'rotate-90': open}">chevron_right</span>
                    </button>
                    <div x-show="open" x-transition class="pl-6 pt-2 space-y-2">
                        <a href="{{ route('productos.index') ?? '#' }}" class="flex items-center p-2 rounded-lg hover:bg-gray-700 text-sm">
                            <span class="material-symbols-outlined mr-3 text-base">inventory</span> Productos
                        </a>
                        <a href="{{ route('categorias.index') ?? '#' }}" class="flex items-center p-2 rounded-lg hover:bg-gray-700 text-sm">
                            <span class="material-symbols-outlined mr-3 text-base">category</span> Categorías
                        </a>
                        <a href="{{ route('almacenes.index') ?? '#' }}" class="flex items-center p-2 rounded-lg hover:bg-gray-700 text-sm">
                            <span class="material-symbols-outlined mr-3 text-base">warehouse</span> Almacenes
                        </a>
                        <a href="{{ route('proveedores.index') ?? '#' }}" class="flex items-center p-2 rounded-lg hover:bg-gray-700 text-sm">
                            <span class="material-symbols-outlined mr-3 text-base">local_shipping</span> Proveedores
                        </a>
                        <a href="{{ route('nota_entradas.index') ?? '#' }}" class="flex items-center p-2 rounded-lg hover:bg-gray-700 text-sm">
                            <span class="material-symbols-outlined mr-3 text-base">input</span> Notas de Entrada
                        </a>
                        <a href="{{ route('nota_salidas.index') ?? '#' }}" class="flex items-center p-2 rounded-lg hover:bg-gray-700 text-sm">
                            <span class="material-symbols-outlined mr-3 text-base">output</span> Notas de Salida
                        </a>
                    </div>
                </div>

                <div x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-3 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                        <div class="flex items-center">
                            <span class="material-symbols-outlined mr-3">admin_panel_settings</span>
                            <span>Administración</span>
                        </div>
                        <span class="material-symbols-outlined transition-transform" :class="{'rotate-90': open}">chevron_right</span>
                    </button>
                    <div x-show="open" x-transition class="pl-6 pt-2 space-y-2">
                        <a href="{{ route('users.index') ?? '#' }}" class="flex items-center p-2 rounded-lg hover:bg-gray-700 text-sm">
                            <span class="material-symbols-outlined mr-3 text-base">manage_accounts</span> Usuarios
                        </a>
                        <a href="{{ route('empleados.index') ?? '#' }}" class="flex items-center p-2 rounded-lg hover:bg-gray-700 text-sm">
                            <span class="material-symbols-outlined mr-3 text-base">badge</span> Empleados
                        </a>
                        <a href="{{ route('roles.index') ?? '#' }}" class="flex items-center p-2 rounded-lg hover:bg-gray-700 text-sm">
                            <span class="material-symbols-outlined mr-3 text-base">shield_person</span> Roles y Permisos
                        </a>
                    </div>
                </div>
                
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-3 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                        <div class="flex items-center">
                            <span class="material-symbols-outlined mr-3">summarize</span>
                            <span>Reportes</span>
                        </div>
                        <span class="material-symbols-outlined transition-transform" :class="{'rotate-90': open}">chevron_right</span>
                    </button>
                    <div x-show="open" x-transition class="pl-6 pt-2 space-y-2">
                        <a href="{{ route('dashboard.reporte') ?? '#' }}" class="flex items-center p-2 rounded-lg hover:bg-gray-700 text-sm">
                            <span class="material-symbols-outlined mr-3 text-base">bar_chart</span> Reporte de Ventas
                        </a>
                        <a href="#" class="flex items-center p-2 rounded-lg hover:bg-gray-700 text-sm">
                            <span class="material-symbols-outlined mr-3 text-base">monitoring</span> Reporte de Inventario
                        </a>
                    </div>
                </div>

            </nav>

            <div class="p-4 border-t border-gray-700">
                <button id="logoutButton" class="w-full flex items-center justify-center p-3 rounded-lg bg-gray-700/50 hover:bg-red-600/80 transition-colors duration-200">
                    <span class="material-symbols-outlined mr-2">logout</span>
                    Salir
                </button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </aside>

        <!-- Main content area -->
        <div class="flex-1 flex flex-col">
            <!-- Overlay for mobile sidebar - Click to close sidebar on small screens -->
            <!-- IMPORTANT: This is now a div, and JavaScript directly handles its click to close the sidebar. -->
            <div id="sidebarOverlay" class="absolute inset-0 bg-black bg-opacity-50 z-30 hidden peer-checked:block overlay transition-opacity duration-300 ease-in-out opacity-0 md:hidden"></div>

            <!-- Header -->
            <header class="bg-white shadow-md p-4 flex justify-between items-center z-20 sticky top-0">
                <!-- Hamburger menu icon for mobile - Toggles the sidebar -->
                <label for="menu-toggle" class="cursor-pointer md:hidden text-gray-700 hover:text-gray-900 transition-colors duration-200">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </label>

                <!-- Dashboard Title (visible on larger screens) -->
                <div class="font-semibold text-xl text-gray-800 hidden md:block">
                    Dashboard
                </div>

                <!-- User Profile Section -->
                <div class="flex items-center space-x-4">
                    <button id="userProfileBtn" class="flex items-center p-2 rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <span class="text-gray-700 font-medium">{{ Auth::user()->name }}</span>
                        <!-- User Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2 text-gray-500" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M18.685 19.02a1.5 1.5 0 0 0 .2.235c.188.188.397.368.618.528A18.71 18.71 0 0 0 24 17.25c0-1.037-.112-2.057-.335-3.053A9.76 9.76 0 0 0 15.683 2.222a.75.75 0 0 0-.58-.222L12 2.252 8.897 2.002c-.313.08-.635.064-.933-.03-.248-.077-.49-.16-.726-.25L6.11 1.76l-.167-.03c-.23-.045-.455-.078-.674-.097A1.75 1.75 0 0 0 3.75 3v13.5a9.773 9.773 0 0 0 3.09 7.234 33.743 33.743 0 0 0 3.715 2.128l.217.098a.75.75 0 0 0 .762-.098l.217-.098c1.3-.597 2.536-1.343 3.715-2.128A9.773 9.773 0 0 0 20.25 16.5V3a.75.75 0 0 0-.75-.75h-.357c-.206 0-.393.078-.544.205Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-grow p-4 md:p-6 bg-gray-100 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- User Profile Modal -->
    <div id="userProfileModal" class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50">
        <div class="bg-white p-8 rounded-2xl shadow-2xl max-w-sm w-full mx-4 transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800">Perfil de Usuario</h3>
                <button id="closeModalBtn" class="text-gray-400 hover:text-gray-600 transition-colors duration-200 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="text-center">
                <img src="https://placehold.co/100x100/007BFF/FFFFFF?text={{ substr(Auth::user()->name, 0, 2) }}" alt="User Avatar" class="w-24 h-24 rounded-full mx-auto mb-4 border-4 border-blue-200 shadow-md">
                <h4 class="text-xl font-semibold text-gray-900 mb-1">{{ Auth::user()->name }}</h4>
                <p class="text-md text-gray-600 mb-4">{{ Auth::user()->email }}</p>
                <div class="bg-blue-50 p-4 rounded-xl text-blue-800 text-sm">
                    <p class="font-medium">Rol: {{ Auth::user()->rol_id ?? 'Usuario' }}</p>
                    <p>Ultimo inicio de sesion: {{ Auth::user()->last_login_at ? Auth::user()->last_login_at->format('F j, Y, g:i a') : 'Primera vez' }}</p>
                </div>
            </div>
            <div class="mt-8 flex justify-center">
                <button class="bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition-colors duration-200 font-semibold shadow-md">
                    Editar Perfil
                </button>
            </div>
        </div>
    </div>

    <!-- Custom Message Box Element for notifications (e.g., logout success) -->
    <div id="messageBox" class="message-box hidden"></div>

    <script>
        const style = document.createElement('style');
        style.innerHTML = `
            /* Ensure font-inter is applied if available from your Vite config */
            body {
                font-family: 'Inter', sans-serif;
            }
            /* Sidebar transition on mobile */
            #menu-toggle:checked ~ aside {
                transform: translateX(0);
            }
            #menu-toggle:checked ~ .flex-1 .overlay {
                display: block;
                opacity: 1;
            }
            /* Custom message box styling */
            .message-box {
                position: fixed;
                top: 20px;
                right: 20px;
                background-color: #28a745; /* Green for success */
                color: white;
                padding: 15px 20px;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                z-index: 1000;
                opacity: 0;
                transform: translateY(-20px);
                transition: opacity 0.3s ease, transform 0.3s ease;
            }
            .message-box.show {
                opacity: 1;
                transform: translateY(0);
            }
            .message-box.error {
                background-color: #dc3545; /* Red for error */
            }
        `;
        document.head.appendChild(style);

        document.getElementById('logoutButton').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        });

        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menu-toggle');
            // Referencia al nuevo div del overlay
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const userProfileBtn = document.getElementById('userProfileBtn');
            const userProfileModal = document.getElementById('userProfileModal');
            const modalContent = document.getElementById('modalContent');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const messageBox = document.getElementById('messageBox');
            const logoutButton = document.getElementById('logoutButton');
            const logoutForm = document.getElementById('logout-form');

            // Function to display a custom message notification
            function showMessage(message, type = 'success') {
                messageBox.textContent = message;
                messageBox.classList.remove('hidden', 'success', 'error'); // Reset classes
                messageBox.classList.add('show', type); // Add 'show' and type class
                setTimeout(() => {
                    messageBox.classList.remove('show');
                    setTimeout(() => {
                        messageBox.classList.add('hidden');
                    }, 300); // Hide after fade out
                }, 3000); // Display for 3 seconds
            }

            // Function to open the user profile modal with transition
            function openModal() {
                userProfileModal.classList.remove('hidden');
                userProfileModal.classList.add('flex'); // Use flex to center the modal
                setTimeout(() => {
                    modalContent.classList.remove('opacity-0', 'scale-95');
                    modalContent.classList.add('opacity-100', 'scale-100');
                }, 10); // Small delay for transition to start smoothly
            }

            // Function to close the user profile modal with transition
            function closeModal() {
                modalContent.classList.remove('opacity-100', 'scale-100');
                modalContent.classList.add('opacity-0', 'scale-95');
                setTimeout(() => {
                    userProfileModal.classList.remove('flex');
                    userProfileModal.classList.add('hidden');
                }, 300); // Wait for transition to complete before hiding
            }

            // Event listener for user profile button click
            if (userProfileBtn) {
                userProfileBtn.addEventListener('click', openModal);
            }

            // Event listener for close modal button click
            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', closeModal);
            }

            // Close modal when clicking outside the modal content area
            if (userProfileModal) {
                userProfileModal.addEventListener('click', function(event) {
                    if (event.target === userProfileModal) {
                        closeModal();
                    }
                });
            }

            // Handle logout functionality (placeholder for Laravel form submission)
            if (logoutButton && logoutForm) {
                logoutButton.addEventListener('click', function (event) {
                    event.preventDefault(); // Evita que el enlace haga scroll arriba
                    logoutForm.submit();    // Envía el formulario
                });
            }

            // Close sidebar when clicking the overlay on mobile
            // Ahora el overlay es un div y su clic se maneja directamente
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    menuToggle.checked = false; // Desmarcar el checkbox para cerrar el sidebar
                });
            }

            // Close sidebar if window is resized from mobile to desktop breakpoint
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 768) { // md breakpoint in Tailwind CSS
                    menuToggle.checked = false; // Ensure sidebar is closed on desktop view
                }
            });
        });
    </script>
    <script src="//unpkg.com/alpinejs" defer></script>
    @livewireScripts
</body>
