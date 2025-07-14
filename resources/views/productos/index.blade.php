@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8" x-data="{ showDeleteConfirmModal: false, deleteFormAction: '' }">
    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Gestión de Productos</h2>
            <div class="flex items-center space-x-4">
                <!-- Formulario de búsqueda -->
                <form method="GET" action="{{ route('productos.index') }}" class="flex items-center space-x-2">
                    <div class="relative">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Buscar productos..." 
                            class="w-64 px-4 py-2 pl-10 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-xl shadow-md">
                        Buscar
                    </button>
                    @if(request('search'))
                        <a href="{{ route('productos.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold py-2 px-4 rounded-xl shadow-md">
                            Limpiar
                        </a>
                    @endif
                </form>
                <a href="{{ route('productos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-xl shadow-md">Nuevo Producto</a>
            </div>
        </div>

        @if(request('search'))
        <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-xl">
            <p class="text-blue-800">
                <span class="font-semibold">Búsqueda:</span> "{{ request('search') }}" 
                <span class="text-sm">({{ $productos->total() }} resultado{{ $productos->total() !== 1 ? 's' : '' }} encontrado{{ $productos->total() !== 1 ? 's' : '' }})</span>
            </p>
        </div>
        @endif

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6">
            {{ session('success') }}
        </div>
        @endif

        <table class="min-w-full bg-white rounded-xl shadow-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Nombre</th>
                    <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Código</th>
                    <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Stock</th>
                    <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Categoría</th>
                    <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Almacén</th>
                    <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($productos as $producto)
                <tr>
                    <td class="px-4 py-2">{{ $producto->id }}</td>
                    <td class="px-4 py-2">{{ $producto->nombre }}</td>
                    <td class="px-4 py-2">{{ $producto->codigo }}</td>
                    <td class="px-4 py-2">{{ $producto->stock }}</td>
                    <td class="px-4 py-2">{{ $producto->categoria->nombre }}</td>
                    <td class="px-4 py-2">{{ $producto->almacen->nombre }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('productos.edit', $producto) }}" class="text-blue-600 hover:text-blue-900">Editar</a>
                        <button @click="showDeleteConfirmModal = true; deleteFormAction = '{{ route('productos.destroy', $producto) }}'" class="text-red-600 hover:text-red-900">Eliminar</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                        @if(request('search'))
                            <div class="flex flex-col items-center">
                                <svg class="h-12 w-12 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <p class="text-lg">No se encontraron productos con la búsqueda "{{ request('search') }}"</p>
                                <a href="{{ route('productos.index') }}" class="mt-2 text-blue-600 hover:text-blue-800">Ver todos los productos</a>
                            </div>
                        @else
                            <div class="flex flex-col items-center">
                                <svg class="h-12 w-12 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <p class="text-lg">No hay productos registrados</p>
                                <a href="{{ route('productos.create') }}" class="mt-2 text-blue-600 hover:text-blue-800">Crear primer producto</a>
                            </div>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $productos->links() }}
        </div>
    </div>

    <!-- Modal eliminación -->
    <div x-show="showDeleteConfirmModal" x-transition class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl p-6 max-w-sm w-full text-center" @click.away="showDeleteConfirmModal = false">
            <h3 class="text-xl font-bold mb-2 text-gray-800">¿Eliminar Producto?</h3>
            <p class="text-gray-600 mb-4">Esta acción no se puede deshacer.</p>
            <div class="flex justify-center space-x-3">
                <button @click="showDeleteConfirmModal = false" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-4 py-2 rounded-xl">Cancelar</button>
                <form :action="deleteFormAction" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-xl">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
