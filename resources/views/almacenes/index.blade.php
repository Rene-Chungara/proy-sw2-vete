@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8" x-data="{ showDeleteConfirmModal: false, deleteFormAction: '' }">
    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Gestión de Almacenes</h2>
            <a href="{{ route('almacenes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-xl shadow-md">Nuevo Almacén</a>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6">
            {{ session('success') }}
        </div>
        @endif

        <table class="min-w-full bg-white rounded-xl shadow-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ubicación</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Capacidad</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($almacenes as $almacen)
                <tr>
                    <td class="px-6 py-4">{{ $almacen->id }}</td>
                    <td class="px-6 py-4">{{ $almacen->nombre }}</td>
                    <td class="px-6 py-4">{{ $almacen->ubicacion }}</td>
                    <td class="px-6 py-4">{{ $almacen->capacidad }}</td>
                    <td class="px-6 py-4 space-x-2">
                        <a href="{{ route('almacenes.edit', $almacen) }}" class="text-blue-600 hover:text-blue-900">Editar</a>
                        <button @click="showDeleteConfirmModal = true; deleteFormAction = '{{ route('almacenes.destroy', $almacen) }}'" class="text-red-600 hover:text-red-900">Eliminar</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No hay almacenes registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $almacenes->links() }}
        </div>
    </div>

    <!-- Modal eliminación -->
    <div x-show="showDeleteConfirmModal" x-transition class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl p-6 max-w-sm w-full text-center" @click.away="showDeleteConfirmModal = false">
            <h3 class="text-xl font-bold mb-2 text-gray-800">¿Eliminar Almacén?</h3>
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
