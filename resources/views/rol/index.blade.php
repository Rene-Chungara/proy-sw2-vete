@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8" x-data="{ showDeleteConfirmModal: false, deleteFormAction: '' }">
    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-4 md:mb-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block mr-3 text-blue-600" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l9 4-9 4-9-4 9-4z"></path><path d="M12 22V6"></path><path d="M2 12l10 6 10-6"></path></svg>
                Gestión de Roles
            </h2>
            <a href="{{ route('roles.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-xl shadow-md transition duration-200 ease-in-out transform hover:scale-105 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Nuevo Rol
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($roles as $role)
                    <tr>
                        <td class="px-6 py-4">{{ $role->id }}</td>
                        <td class="px-6 py-4">{{ $role->name }}</td>
                        <td class="px-6 py-4 space-x-2">
                            <a href="{{ route('roles.edit', $role) }}" class="text-blue-600 hover:text-blue-900 font-semibold">Editar</a>
                            <button @click="showDeleteConfirmModal = true; deleteFormAction = '{{ route('roles.destroy', $role) }}'" class="text-red-600 hover:text-red-900 font-semibold">Eliminar</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">No hay roles registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $roles->links() }}
        </div>
    </div>

    <!-- Delete Confirm Modal -->
    <div x-show="showDeleteConfirmModal" x-transition class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl p-6 max-w-sm w-full text-center" @click.away="showDeleteConfirmModal = false">
            <h3 class="text-xl font-bold mb-2 text-gray-800">¿Eliminar Rol?</h3>
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
