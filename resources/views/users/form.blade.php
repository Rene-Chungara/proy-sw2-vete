@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 max-w-lg mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">
            {{ isset($user) ? 'Editar Usuario' : 'Crear Usuario' }}
        </h2>

        <form method="POST" action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}">
            @csrf
            @if(isset($user)) @method('PUT') @endif

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Nombre</label>
                <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}"
                    class="w-full border rounded-xl p-2 @error('name') border-red-500 @enderror">
                @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}"
                    class="w-full border rounded-xl p-2 @error('email') border-red-500 @enderror">
                @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Contraseña {{ isset($user) ? '(opcional)' : '' }}</label>
                <input type="password" name="password"
                    class="w-full border rounded-xl p-2 @error('password') border-red-500 @enderror">
                @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Rol</label>
                <select name="rol" class="w-full border rounded-xl p-2 @error('rol') border-red-500 @enderror">
                    <option value="">Seleccione un rol</option>
                    @foreach($roles as $rol)
                        <option value="{{ $rol->name }}"
                            @if(old('rol', isset($user) ? $user->getRoleNames()->first() : '') == $rol->name) selected @endif>
                            {{ $rol->name }}
                        </option>
                    @endforeach
                </select>
                @error('rol') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-300 rounded-xl">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection
