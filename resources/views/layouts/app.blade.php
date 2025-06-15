<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('app.name', 'Laravel') }}</title>
  @vite('resources/css/app.css')
  @livewireStyles
</head>
<body class="bg-gray-100 font-inter antialiased">

    <div class="flex min-h-screen">
        <!-- Sidebar Toggle Checkbox (Hidden) - Controls the mobile sidebar visibility -->
        <input id="menu-toggle" type="checkbox" class="hidden peer">

        <!-- Sidebar -->
        <aside class="bg-gradient-to-br from-blue-700 to-blue-900 text-white w-64 shadow-lg
                      transform md:translate-x-0 fixed md:static inset-y-0 left-0 z-40
                      transition-transform duration-300 ease-in-out -translate-x-full
                      flex flex-col rounded-r-2xl md:rounded-none overflow-hidden">
            <div class="p-6 text-2xl font-bold border-b border-blue-600 flex items-center justify-center">
                <!-- Admin Panel Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" d="M11.078 14.122a.75.75 0 0 0-1.077-.077l-3.5 3.5a.75.75 0 0 0 1.06 1.06l3.5-3.5a.75.75 0 0 0-.076-1.078Z" clip-rule="evenodd" />
                    <path fill-rule="evenodd" d="M15.75 4.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm.75 6a.75.75 0 0 0 0 1.5H18a.75.75 0 0 0 0-1.5h-.75Zm-.75 9.75a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 0-1.5h-.75ZM12 9a.75.75 0 0 0 0 1.5h.008a.75.75 0 0 0 0-1.5H12ZM4.5 15.75a.75.75 0 0 0 1.5 0v-.75a.75.75 0 0 0-1.5 0v.75ZM6.75 12a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 0-1.5h-.75ZM.75 12a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 0-1.5H.75ZM15 6.75a.75.75 0 0 0 0 1.5h.008a.75.75 0 0 0 0-1.5H15Zm0 12a.75.75 0 0 0 0 1.5h.008a.75.75 0 0 0 0-1.5H15Z" clip-rule="evenodd" />
                </svg>
                Admin Panel
            </div>
            <nav class="p-6 space-y-3 flex-grow">
                <a href="#" class="block p-3 rounded-xl hover:bg-blue-600 focus:bg-blue-600 focus:outline-none transition-colors duration-200 flex items-center">
                    <!-- Dashboard Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59-5.117 8.25 8.25 0 0 1-14.59 5.117ZM12 7.5a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V8.25A.75.75 0 0 1 12 7.5Z" clip-rule="evenodd" />
                    </svg>
                    Dashboard
                </a>
                <!-- Update this href to your actual Laravel route -->
                <a href="{{ route('users.index') ?? '#' }}" class="block p-3 rounded-xl hover:bg-blue-600 focus:bg-blue-600 focus:outline-none transition-colors duration-200 flex items-center">
                    <!-- Usuarios Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 17.25a.75.75 0 0 1 .75-1.5h15.75a.75.75 0 0 1 .75.75v.75c0 1.95-1.571 3.525-3.513 3.593L15 21a2.25 2.25 0 0 1-4.5 0v-.087a3.525 3.525 0 0 0-1.053-.294 3.525 3.525 0 0 0-1.053.294v.087a2.25 2.25 0 0 1-4.5 0v-.087c-.93-.067-1.838-.283-2.652-.636A4.52 4.52 0 0 1 .75 19.5v-.75Zm0-1.5H2.25V19.5c0 .414.336.75.75.75h.396a.75.75 0 0 1-.001-1.5Z" clip-rule="evenodd" />
                    </svg>
                    Usuarios
                </a>
                <a href="{{ route('roles.index') ?? '#' }}" class="block p-3 rounded-xl hover:bg-blue-600 focus:bg-blue-600 focus:outline-none transition-colors duration-200 flex items-center">
                    <!-- Usuarios Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 17.25a.75.75 0 0 1 .75-1.5h15.75a.75.75 0 0 1 .75.75v.75c0 1.95-1.571 3.525-3.513 3.593L15 21a2.25 2.25 0 0 1-4.5 0v-.087a3.525 3.525 0 0 0-1.053-.294 3.525 3.525 0 0 0-1.053.294v.087a2.25 2.25 0 0 1-4.5 0v-.087c-.93-.067-1.838-.283-2.652-.636A4.52 4.52 0 0 1 .75 19.5v-.75Zm0-1.5H2.25V19.5c0 .414.336.75.75.75h.396a.75.75 0 0 1-.001-1.5Z" clip-rule="evenodd" />
                    </svg>
                    Roles
                </a>
                <a href="{{ route('empleados.index') ?? '#' }}" class="block p-3 rounded-xl hover:bg-blue-600 focus:bg-blue-600 focus:outline-none transition-colors duration-200 flex items-center">
                    <!-- Usuarios Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 17.25a.75.75 0 0 1 .75-1.5h15.75a.75.75 0 0 1 .75.75v.75c0 1.95-1.571 3.525-3.513 3.593L15 21a2.25 2.25 0 0 1-4.5 0v-.087a3.525 3.525 0 0 0-1.053-.294 3.525 3.525 0 0 0-1.053.294v.087a2.25 2.25 0 0 1-4.5 0v-.087c-.93-.067-1.838-.283-2.652-.636A4.52 4.52 0 0 1 .75 19.5v-.75Zm0-1.5H2.25V19.5c0 .414.336.75.75.75h.396a.75.75 0 0 1-.001-1.5Z" clip-rule="evenodd" />
                    </svg>
                    Empleados
                </a>
                <a href="{{ route('almacenes.index') ?? '#' }}" class="block p-3 rounded-xl hover:bg-blue-600 focus:bg-blue-600 focus:outline-none transition-colors duration-200 flex items-center">
                    <!-- Usuarios Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 17.25a.75.75 0 0 1 .75-1.5h15.75a.75.75 0 0 1 .75.75v.75c0 1.95-1.571 3.525-3.513 3.593L15 21a2.25 2.25 0 0 1-4.5 0v-.087a3.525 3.525 0 0 0-1.053-.294 3.525 3.525 0 0 0-1.053.294v.087a2.25 2.25 0 0 1-4.5 0v-.087c-.93-.067-1.838-.283-2.652-.636A4.52 4.52 0 0 1 .75 19.5v-.75Zm0-1.5H2.25V19.5c0 .414.336.75.75.75h.396a.75.75 0 0 1-.001-1.5Z" clip-rule="evenodd" />
                    </svg>
                    Almacenes
                </a>
                <a href="{{ route('categorias.index') ?? '#' }}" class="block p-3 rounded-xl hover:bg-blue-600 focus:bg-blue-600 focus:outline-none transition-colors duration-200 flex items-center">
                    <!-- Usuarios Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 17.25a.75.75 0 0 1 .75-1.5h15.75a.75.75 0 0 1 .75.75v.75c0 1.95-1.571 3.525-3.513 3.593L15 21a2.25 2.25 0 0 1-4.5 0v-.087a3.525 3.525 0 0 0-1.053-.294 3.525 3.525 0 0 0-1.053.294v.087a2.25 2.25 0 0 1-4.5 0v-.087c-.93-.067-1.838-.283-2.652-.636A4.52 4.52 0 0 1 .75 19.5v-.75Zm0-1.5H2.25V19.5c0 .414.336.75.75.75h.396a.75.75 0 0 1-.001-1.5Z" clip-rule="evenodd" />
                    </svg>
                    Categorias
                </a>
                <a href="{{ route('proveedores.index') ?? '#' }}" class="block p-3 rounded-xl hover:bg-blue-600 focus:bg-blue-600 focus:outline-none transition-colors duration-200 flex items-center">
                    <!-- Usuarios Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 17.25a.75.75 0 0 1 .75-1.5h15.75a.75.75 0 0 1 .75.75v.75c0 1.95-1.571 3.525-3.513 3.593L15 21a2.25 2.25 0 0 1-4.5 0v-.087a3.525 3.525 0 0 0-1.053-.294 3.525 3.525 0 0 0-1.053.294v.087a2.25 2.25 0 0 1-4.5 0v-.087c-.93-.067-1.838-.283-2.652-.636A4.52 4.52 0 0 1 .75 19.5v-.75Zm0-1.5H2.25V19.5c0 .414.336.75.75.75h.396a.75.75 0 0 1-.001-1.5Z" clip-rule="evenodd" />
                    </svg>
                    proveedores
                </a>
                <a href="{{ route('clientes.index') ?? '#' }}" class="block p-3 rounded-xl hover:bg-blue-600 focus:bg-blue-600 focus:outline-none transition-colors duration-200 flex items-center">
                    <!-- Usuarios Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 17.25a.75.75 0 0 1 .75-1.5h15.75a.75.75 0 0 1 .75.75v.75c0 1.95-1.571 3.525-3.513 3.593L15 21a2.25 2.25 0 0 1-4.5 0v-.087a3.525 3.525 0 0 0-1.053-.294 3.525 3.525 0 0 0-1.053.294v.087a2.25 2.25 0 0 1-4.5 0v-.087c-.93-.067-1.838-.283-2.652-.636A4.52 4.52 0 0 1 .75 19.5v-.75Zm0-1.5H2.25V19.5c0 .414.336.75.75.75h.396a.75.75 0 0 1-.001-1.5Z" clip-rule="evenodd" />
                    </svg>
                    clientes
                </a>
                <a href="{{ route('tipo_pagos.index') ?? '#' }}" class="block p-3 rounded-xl hover:bg-blue-600 focus:bg-blue-600 focus:outline-none transition-colors duration-200 flex items-center">
                    <!-- Usuarios Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 17.25a.75.75 0 0 1 .75-1.5h15.75a.75.75 0 0 1 .75.75v.75c0 1.95-1.571 3.525-3.513 3.593L15 21a2.25 2.25 0 0 1-4.5 0v-.087a3.525 3.525 0 0 0-1.053-.294 3.525 3.525 0 0 0-1.053.294v.087a2.25 2.25 0 0 1-4.5 0v-.087c-.93-.067-1.838-.283-2.652-.636A4.52 4.52 0 0 1 .75 19.5v-.75Zm0-1.5H2.25V19.5c0 .414.336.75.75.75h.396a.75.75 0 0 1-.001-1.5Z" clip-rule="evenodd" />
                    </svg>
                    Formas de Pago
                </a>
                <a href="{{ route('productos.index') ?? '#' }}" class="block p-3 rounded-xl hover:bg-blue-600 focus:bg-blue-600 focus:outline-none transition-colors duration-200 flex items-center">
                    <!-- Usuarios Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 17.25a.75.75 0 0 1 .75-1.5h15.75a.75.75 0 0 1 .75.75v.75c0 1.95-1.571 3.525-3.513 3.593L15 21a2.25 2.25 0 0 1-4.5 0v-.087a3.525 3.525 0 0 0-1.053-.294 3.525 3.525 0 0 0-1.053.294v.087a2.25 2.25 0 0 1-4.5 0v-.087c-.93-.067-1.838-.283-2.652-.636A4.52 4.52 0 0 1 .75 19.5v-.75Zm0-1.5H2.25V19.5c0 .414.336.75.75.75h.396a.75.75 0 0 1-.001-1.5Z" clip-rule="evenodd" />
                    </svg>
                    Productos
                </a>
                <a href="{{ route('nota_entradas.index') ?? '#' }}" class="block p-3 rounded-xl hover:bg-blue-600 focus:bg-blue-600 focus:outline-none transition-colors duration-200 flex items-center">
                    <!-- Usuarios Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 17.25a.75.75 0 0 1 .75-1.5h15.75a.75.75 0 0 1 .75.75v.75c0 1.95-1.571 3.525-3.513 3.593L15 21a2.25 2.25 0 0 1-4.5 0v-.087a3.525 3.525 0 0 0-1.053-.294 3.525 3.525 0 0 0-1.053.294v.087a2.25 2.25 0 0 1-4.5 0v-.087c-.93-.067-1.838-.283-2.652-.636A4.52 4.52 0 0 1 .75 19.5v-.75Zm0-1.5H2.25V19.5c0 .414.336.75.75.75h.396a.75.75 0 0 1-.001-1.5Z" clip-rule="evenodd" />
                    </svg>
                    Nota de Entrada
                </a>
                <a href="{{ route('nota_salidas.index') ?? '#' }}" class="block p-3 rounded-xl hover:bg-blue-600 focus:bg-blue-600 focus:outline-none transition-colors duration-200 flex items-center">
                    <!-- Usuarios Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 17.25a.75.75 0 0 1 .75-1.5h15.75a.75.75 0 0 1 .75.75v.75c0 1.95-1.571 3.525-3.513 3.593L15 21a2.25 2.25 0 0 1-4.5 0v-.087a3.525 3.525 0 0 0-1.053-.294 3.525 3.525 0 0 0-1.053.294v.087a2.25 2.25 0 0 1-4.5 0v-.087c-.93-.067-1.838-.283-2.652-.636A4.52 4.52 0 0 1 .75 19.5v-.75Zm0-1.5H2.25V19.5c0 .414.336.75.75.75h.396a.75.75 0 0 1-.001-1.5Z" clip-rule="evenodd" />
                    </svg>
                    Nota de Salida
                </a>
                <!-- Add more navigation items here -->
            </nav>
            <div class="p-6 border-t border-blue-600 mt-auto">
                <button id="logoutButton" class="block p-3 rounded-xl bg-blue-800 hover:bg-blue-700 transition-colors duration-200 text-center font-semibold flex items-center justify-center">
                    <!-- Logout Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.5 3.75A1.5 1.5 0 0 0 6 5.25v13.5a1.5 1.5 0 0 0 1.5 1.5h6a1.5 1.5 0 0 0 1.5-1.5V15a.75.75 0 0 1 1.5 0v3.75a3 3 0 0 1-3 3h-6a3 3 0 0 1-3-3V5.25a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3V9A.75.75 0 0 1 16.5 9V5.25a1.5 1.5 0 0 0-1.5-1.5h-6ZM17.25 9a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 0 1.5h-3a.75.75 0 0 1-.75-.75ZM15.75 12a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 0 1.5h-4.5a.75.75 0 0 1-.75-.75ZM15.75 15a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 0 1.5h-4.5a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                    </svg>
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
