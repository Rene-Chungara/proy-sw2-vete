@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8" x-data="{ showDeleteConfirmModal: false, deleteFormAction: '' }">
    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-4 md:mb-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block mr-3 text-blue-600" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                Gestión de Empleados
            </h2>
            <a href="{{ route('empleados.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-xl shadow-md transition duration-200 transform hover:scale-105 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Nuevo Empleado
            </a>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6">
            {{ session('success') }}
        </div>
        @endif

        <div class="overflow-x-auto bg-white rounded-xl shadow-sm">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">CI</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cargo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($empleados as $empleado)
                    <tr>
                        <td class="px-6 py-4">{{ $empleado->id }}</td>
                        <td class="px-6 py-4">{{ $empleado->ci }}</td>
                        <td class="px-6 py-4">{{ $empleado->nombre }}</td>
                        <td class="px-6 py-4">{{ $empleado->cargo }}</td>
                        <td class="px-6 py-4 space-x-2">
                            <a href="{{ route('empleados.edit', $empleado) }}" class="text-blue-600 hover:text-blue-900 font-semibold">Editar</a>
                            <button @click="showDeleteConfirmModal = true; deleteFormAction = '{{ route('empleados.destroy', $empleado) }}'" class="text-red-600 hover:text-red-900 font-semibold">Eliminar</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No hay empleados registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $empleados->links() }}
        </div>
    </div>

    <!-- Modal de confirmación -->
    <div x-show="showDeleteConfirmModal" x-transition class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl p-6 max-w-sm w-full text-center" @click.away="showDeleteConfirmModal = false">
            <h3 class="text-xl font-bold mb-2 text-gray-800">¿Eliminar Empleado?</h3>
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
