@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8" x-data="{ showDeleteConfirmModal: false, deleteFormAction: '' }">
    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-4 md:mb-0">
                <!-- Icono de Usuarios mejorado -->
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="inline-block mr-3 text-blue-600">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                Gestión de Usuarios
            </h2>
            <!-- Botón para crear usuario (ahora un enlace directo) -->
            <a href="{{ route('users.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-xl shadow-md transition duration-200 ease-in-out transform hover:scale-105 flex items-center">
                <!-- Icono de Añadir Usuario mejorado -->
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/>
                </svg>
                Nuevo Usuario
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative mb-6" role="alert">
                <strong class="font-bold">¡Éxito!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.style.display='none';">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Cerrar</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.697l-2.651 2.652a1.2 1.2 0 1 1-1.697-1.697L8.303 10 5.651 7.348a1.2 1.2 0 1 1 1.697-1.697L10 8.303l2.651-2.652a1.2 1.2 0 1 1 1.697 1.697L11.697 10l2.651 2.651a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
        @endif

        <div class="overflow-x-auto bg-white rounded-xl shadow-sm">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-xl">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-xl">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($users as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                            <!-- Enlace directo para editar usuario -->
                            <a href="{{ route('users.edit', $user) }}" class="text-blue-600 hover:text-blue-900 transition-colors duration-200 inline-flex items-center" title="Editar Usuario">
                                <!-- Icono de Editar mejorado -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                    <path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                                </svg>
                                Editar
                            </a>
                            <!-- Botón para eliminar usuario (mantiene modal de confirmación) -->
                            <button
                                @click="showDeleteConfirmModal = true; deleteFormAction = '{{ route('users.destroy', $user) }}'"
                                class="text-red-600 hover:text-red-900 transition-colors duration-200 inline-flex items-center"
                                title="Eliminar Usuario"
                            >
                                <!-- Icono de Eliminar mejorado -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                    <path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                </svg>
                                Eliminar
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500" colspan="4">No hay usuarios registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-8 flex justify-center">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Delete Confirmation Modal (se mantiene) -->
    <div
        x-show="showDeleteConfirmModal"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 p-4"
        @click.away="showDeleteConfirmModal = false"
        x-cloak
    >
        <div class="bg-white rounded-xl shadow-2xl p-6 w-full max-w-sm text-center" @click.stop>
            <div class="mb-6">
                <!-- Icono de Advertencia mejorado -->
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto text-red-500 mb-4">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
                <h3 class="text-xl font-bold text-gray-800 mb-2">¿Estás seguro?</h3>
                <p class="text-gray-600">Esta acción no se puede deshacer.</p>
            </div>
            <div class="flex justify-center space-x-3">
                <button type="button" @click="showDeleteConfirmModal = false" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-xl transition duration-200">
                    Cancelar
                </button>
                <form :action="deleteFormAction" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-xl shadow-md transition duration-200">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
