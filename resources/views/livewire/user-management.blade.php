<div>
    {{-- TODO TU CÓDIGO HTML AHORA VIVE AQUÍ, DENTRO DE UN SOLO DIV --}}
    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
        
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative mb-6">
                <strong class="font-bold">¡Éxito!</strong> <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-4 md:mb-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="inline-block mr-3 text-blue-600"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                Gestión de Usuarios
            </h2>
            {{-- BOTÓN MODIFICADO --}}
            <button type="button" wire:click="create" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-xl shadow-md flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mr-2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
                Nuevo Usuario
            </button>
        </div>

        <div class="overflow-x-auto bg-white rounded-xl shadow-sm">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 hidden md:table-header-group">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($users as $user)
                        <tr class="hidden md:table-row">
                            <td class="px-6 py-4">{{ $user->id }}</td>
                            <td class="px-6 py-4">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap space-x-3">
                                {{-- BOTONES MODIFICADOS --}}
                                <button wire:click="edit({{ $user->id }})" class="text-blue-600 hover:text-blue-900 font-semibold">Editar</button>
                                <button wire:click="confirmDelete({{ $user->id }})" class="text-red-600 hover:text-red-900 font-semibold">Eliminar</button>
                            </td>
                        </tr>
                        <tr class="block md:hidden border-b">
                            <td class="px-4 py-4 block">
                                <div class="flex items-center justify-between">
                                    <div class="font-bold text-gray-800">{{ $user->name }}</div>
                                    <div class="text-sm text-gray-500">ID: {{ $user->id }}</div>
                                </div>
                                <div class="text-sm text-gray-600 mt-2">{{ $user->email }}</div>
                                <div class="mt-4 flex justify-end space-x-3">
                                    {{-- BOTONES MODIFICADOS --}}
                                    <button wire:click="edit({{ $user->id }})" class="text-blue-600 hover:text-blue-900 font-semibold">Editar</button>
                                    <button wire:click="confirmDelete({{ $user->id }})" class="text-red-600 hover:text-red-900 font-semibold">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td class="px-6 py-4 text-center" colspan="4">No hay usuarios.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-8">{{ $users->links() }}</div>
    </div>

    {{-- MODAL DE CREAR/EDITAR --}}
    @if ($showFormModal)
    <div class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl shadow-2xl p-6 w-full max-w-md">
            <form wire:submit.prevent="save">
                <h3 class="text-2xl font-bold mb-6">{{ $userId ? 'Editar Usuario' : 'Crear Usuario' }}</h3>
                <div class="mb-4">
                    <label class="block font-semibold mb-2">Nombre</label>
                    <input type="text" wire:model="name" class="w-full px-4 py-2 border rounded-lg">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-2">Email</label>
                    <input type="email" wire:model="email" class="w-full px-4 py-2 border rounded-lg">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-2">Contraseña</label>
                    <input type="password" wire:model="password" class="w-full px-4 py-2 border rounded-lg" placeholder="{{ $userId ? 'Dejar en blanco para no cambiar' : '' }}">
                    @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-6">
                    <label class="block font-semibold mb-2">Confirmar Contraseña</label>
                    <input type="password" wire:model="password_confirmation" class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" wire:click="$set('showFormModal', false)" class="bg-gray-200 hover:bg-gray-300 py-2 px-4 rounded-xl">Cancelar</button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-xl">Guardar</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- MODAL DE ELIMINAR --}}
    @if ($showDeleteModal)
    <div class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl shadow-2xl p-6 w-full max-w-sm text-center">
            <h3 class="text-xl font-bold text-gray-800 mb-2">¿Estás seguro?</h3>
            <p class="text-gray-600">Esta acción no se puede deshacer.</p>
            <div class="flex justify-center space-x-3 mt-6">
                <button type="button" wire:click="$set('showDeleteModal', false)" class="bg-gray-200 hover:bg-gray-300 py-2 px-4 rounded-xl">Cancelar</button>
                <button type="button" wire:click="delete" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-xl">Eliminar</button>
            </div>
        </div>
    </div>
    @endif
</div>