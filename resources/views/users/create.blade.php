@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 w-full max-w-lg mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 flex items-center justify-center md:justify-start">
            @if(isset($user))
                <!-- Icono para Editar Usuario -->
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 text-blue-600">
                    <path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                </svg>
                Editar Usuario
            @else
                <!-- Icono para Nuevo Usuario -->
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 text-blue-600">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/>
                </svg>
                Nuevo Usuario
            @endif
        </h2>

        <form method="POST" action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}">
            @csrf
            @if(isset($user))
                @method('PUT')
            @endif

            <div class="mb-5">
                <label for="name" class="block text-gray-700 text-sm font-semibold mb-2">Nombre:</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}"
                       placeholder="Ingresa el nombre del usuario"
                       class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-5">
                <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}"
                       placeholder="Ingresa el correo electrónico"
                       class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Contraseña:</label>
                <input type="password" name="password" id="password" placeholder="{{ isset($user) ? 'Dejar en blanco para no cambiar' : 'Ingresa la contraseña' }}"
                       class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') border-red-500 @enderror">
                @if(isset($user))
                    <p class="text-gray-500 text-xs mt-1">Dejar en blanco para mantener la contraseña actual.</p>
                @endif
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 text-sm font-semibold mb-2">Confirmar Contraseña:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="{{ isset($user) ? 'Confirma la nueva contraseña' : 'Confirma la contraseña' }}"
                       class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div class="flex justify-end space-x-3 mt-6">
                <a href="{{ route('users.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-5 rounded-xl transition duration-200 flex items-center">
                    <!-- Icono de Cancelar -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                    Cancelar
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded-xl shadow-md transition duration-200 flex items-center">
                    <!-- Icono de Guardar -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
                    </svg>
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
