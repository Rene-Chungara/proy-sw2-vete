<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public $termsAccepted = false; // Añadido para el checkbox de términos

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        // Validación de términos primero
        $this->validate([
            'termsAccepted' => ['required', 'accepted'],
        ], [
            'termsAccepted.accepted' => 'Debes aceptar los términos y condiciones para registrarte.',
        ]);

        // Luego la validación de los campos del formulario
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['rol_id'] = 1; // Asegúrate de que esto es lo que quieres por defecto

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

{{-- UN ÚNICO DIV RAÍZ que envuelve TODO --}}
<div>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        {{-- Contenedor principal del formulario: tarjeta elegante --}}
        <div class="max-w-md w-full space-y-8 p-8 bg-white rounded-2xl shadow-2xl border border-gray-200 animate-fade-in-up">
            
            <div class="text-center">
                {{-- Logo o Ícono del Admin Panel para el formulario mismo --}}
                <span class="material-symbols-outlined text-6xl text-green-600 mx-auto mb-4 animate-delay-1">
                    person_add
                </span>
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900 animate-delay-2">
                    Crea tu cuenta
                </h2>
                <p class="mt-2 text-base text-gray-600 animate-delay-3">
                    Únete a nuestra plataforma y gestiona tus datos.
                </p>
            </div>

            <form wire:submit="register" class="mt-8 space-y-6">
                <div class="animate-delay-4">
                    <label for="name" class="sr-only">Nombre</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                            <span class="material-symbols-outlined text-gray-400 material-icons-fix">person</span>
                        </div>
                        <x-text-input wire:model="name" id="name" type="text" name="name" required autofocus autocomplete="name"
                                      class="block w-full pl-10 pr-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                      placeholder="Tu nombre completo"
                                      style="padding-left: 2.5rem !important;" />
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="animate-delay-5">
                    <label for="email" class="sr-only">Email</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                            <span class="material-symbols-outlined text-gray-400 material-icons-fix">mail</span>
                        </div>
                        <x-text-input wire:model="email" id="email" type="email" name="email" required autocomplete="username"
                                      class="block w-full pl-10 pr-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                      placeholder="Tu correo electrónico"
                                      style="padding-left: 2.5rem !important;" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="animate-delay-6">
                    <label for="password" class="sr-only">Contraseña</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                            <span class="material-symbols-outlined text-gray-400 material-icons-fix">lock</span>
                        </div>
                        <x-text-input wire:model="password" id="password" type="password" name="password" required autocomplete="new-password"
                                      class="block w-full pl-10 pr-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                      placeholder="Contraseña"
                                      style="padding-left: 2.5rem !important;" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="animate-delay-7">
                    <label for="password_confirmation" class="sr-only">Confirmar Contraseña</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                            <span class="material-symbols-outlined text-gray-400 material-icons-fix">lock_reset</span>
                        </div>
                        <x-text-input wire:model="password_confirmation" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                      class="block w-full pl-10 pr-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                      placeholder="Confirmar contraseña"
                                      style="padding-left: 2.5rem !important;" />
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-start text-sm animate-delay-8">
                    <div class="flex items-center h-5">
                        <input wire:model.live="termsAccepted" id="terms" name="terms" type="checkbox" required
                               class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3">
                        <label for="terms" class="font-medium text-gray-700">
                            Acepto los 
                            <a href="{{ route('terms.show') }}"" target="_blank" class="text-green-600 hover:text-green-500 transition-colors duration-200 underline">
                                Términos y Condiciones
                            </a>
                        </label>
                        <x-input-error :messages="$errors->get('termsAccepted')" class="mt-1" />
                    </div>
                </div>

                <div class="animate-delay-9">
                    <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <span class="material-symbols-outlined text-green-300 group-hover:text-green-200 transition-colors duration-200 material-icons-fix">
                                app_registration
                            </span>
                        </span>
                        Registrarse
                    </button>
                </div>
            </form>

            <div class="text-center mt-6 text-sm text-gray-600 animate-delay-10">
                ¿Ya tienes una cuenta? 
                <a class="font-medium text-green-600 hover:text-green-500 transition-colors duration-200" href="{{ route('login') }}" wire:navigate>
                    Inicia sesión
                </a>
            </div>
        </div>
    </div>

    {{-- Estilos de animación y el fix para Material Symbols --}}
    <style>
        @keyframes fadeInSlideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInSlideUp 0.6s ease-out forwards;
        }
        .animate-delay-1 { animation-delay: 0.1s; }
        .animate-delay-2 { animation-delay: 0.2s; }
        .animate-delay-3 { animation-delay: 0.3s; }
        .animate-delay-4 { animation-delay: 0.4s; }
        .animate-delay-5 { animation-delay: 0.5s; }
        .animate-delay-6 { animation-delay: 0.6s; }
        .animate-delay-7 { animation-delay: 0.7s; }
        .animate-delay-8 { animation-delay: 0.8s; }
        .animate-delay-9 { animation-delay: 0.9s; }
        .animate-delay-10 { animation-delay: 1.0s; }

        /* FIX: Asegurar que Material Symbols se aplique correctamente */
        .material-icons-fix {
            font-family: 'Material Symbols Outlined' !important;
            font-weight: normal !important;
            font-style: normal !important;
            font-size: 24px !important; /* Ajusta el tamaño si es necesario */
            line-height: 1 !important;
            letter-spacing: normal !important;
            text-transform: none !important;
            display: inline-block !important;
            white-space: nowrap !important;
            word-wrap: normal !important;
            direction: ltr !important;
            -webkit-font-feature-settings: 'liga' !important;
            -webkit-font-smoothing: antialiased !important;
            -moz-osx-font-smoothing: grayscale !important;
            vertical-align: middle;
        }
    </style>
</div>