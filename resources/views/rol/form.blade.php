@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 max-w-lg mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">
            {{ isset($role) ? 'Editar Rol' : 'Crear Rol' }}
        </h2>

        <form method="POST" action="{{ isset($role) ? route('roles.update', $role) : route('roles.store') }}">
            @csrf
            @if(isset($role))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Nombre del Rol</label>
                <input type="text" name="name" value="{{ old('name', $role->name ?? '') }}" class="w-full border rounded-xl p-2 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Permisos</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    @foreach($permissions as $permission)
                        <label class="flex items-center">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                            {{ (isset($role) && $role->permissions->contains($permission->id)) ? 'checked' : '' }}
                            class="mr-2">
                            {{ $permission->name }}
                        </label>
                    @endforeach
                </div>
                @error('permissions')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('roles.index') }}" class="px-4 py-2 bg-gray-300 rounded-xl">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection
