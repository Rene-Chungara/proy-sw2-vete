<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    public $termsAccepted = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        // Validación de términos movida arriba para ser lo primero
        $this->validate([
            'termsAccepted' => ['required', 'accepted'],
        ], [
            'termsAccepted.required' => 'Debes aceptar los términos y condiciones para iniciar sesión.',
        ]);

        // Luego la validación de los campos del formulario
        $this->validate(); 

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div> 
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        {{-- Contenedor principal del formulario: tarjeta elegante --}}
        <div class="max-w-md w-full space-y-8 p-8 bg-white rounded-2xl shadow-2xl border border-gray-200 animate-fade-in-up">
            
            <div class="text-center">
                {{-- Logo o Ícono del Admin Panel para el formulario mismo --}}
                <span class="material-symbols-outlined text-6xl text-blue-600 mx-auto mb-4 animate-delay-1">
                    data_thresholding
                </span>
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900 animate-delay-2">
                    Inicia sesión en tu cuenta
                </h2>
                <p class="mt-2 text-base text-gray-600 animate-delay-3">
                    Accede al poder de tus datos de negocio.
                </p>
            </div>

            <x-auth-session-status class="mb-4 text-center text-red-600 bg-red-100 p-3 rounded-md" :status="session('status')" />

            <form wire:submit="login" class="mt-8 space-y-6">
                <div class="animate-delay-4">
                    <label for="email" class="sr-only">Email</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                            {{-- AÑADIR LA CLASE 'material-icons-fix' --}}
                            <span class="material-symbols-outlined text-gray-400 material-icons-fix">mail</span> 
                        </div>
                        <x-text-input wire:model="form.email" id="email" type="email" name="email" required autofocus autocomplete="username"
                                      class="block w-full pl-10 pr-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                      placeholder="Tu correo electrónico"
                                      style="padding-left: 2.5rem !important;" /> 
                    </div>
                    <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                </div>

                <div class="animate-delay-5">
                    <label for="password" class="sr-only">Contraseña</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                            {{-- AÑADIR LA CLASE 'material-icons-fix' --}}
                            <span class="material-symbols-outlined text-gray-400 material-icons-fix">lock</span> 
                        </div>
                        <x-text-input wire:model="form.password" id="password" type="password" name="password" required autocomplete="current-password"
                                      class="block w-full pl-10 pr-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                      placeholder="Tu contraseña"
                                      style="padding-left: 2.5rem !important;" /> 
                    </div>
                    <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between text-sm animate-delay-6">
                    <div class="flex items-center">
                        <input wire:model="form.remember" id="remember" name="remember" type="checkbox"
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-gray-900">
                            Recordarme
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" wire:navigate
                               class="font-medium text-blue-600 hover:text-blue-500 transition-colors duration-200">
                                ¿Olvidaste tu contraseña?
                            </a>
                        </div>
                    @endif
                </div>

                <div class="flex items-start text-sm animate-delay-7">
                    <div class="flex items-center h-5">
                        <input wire:model.live="termsAccepted" id="terms" name="terms" type="checkbox" required
                               class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3">
                        <label for="terms" class="font-medium text-gray-700">
                            Acepto los 
                            <a href="{{ route('terms.show') }}" target="_blank" class="text-blue-600 hover:text-blue-500 transition-colors duration-200 underline">
                                Términos y Condiciones
                            </a>
                        </label>
                        <x-input-error :messages="$errors->get('termsAccepted')" class="mt-1" />
                    </div>
                </div>

                <div class="animate-delay-8">
                    <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            {{-- AÑADIR LA CLASE 'material-icons-fix' --}}
                            <span class="material-symbols-outlined text-blue-300 group-hover:text-blue-200 transition-colors duration-200 material-icons-fix">
                                login
                            </span>
                        </span>
                        Iniciar Sesión
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Estilos de animación Y EL NUEVO ESTILO PARA EL FIX DE MATERIAL SYMBOLS --}}
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
            vertical-align: middle; /* Para alinear con el texto circundante si fuera necesario */
        }
    </style>
</div>