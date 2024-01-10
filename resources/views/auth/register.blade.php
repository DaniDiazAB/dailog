
<script>
    function validarEdad(fechaSeleccionada) {
        var fechaActual = new Date();

        var fechaSeleccionadaObj = new Date(fechaSeleccionada);

        fechaActual.setFullYear(fechaActual.getFullYear() - 13);

        if (fechaSeleccionadaObj > fechaActual) {
            alert("Debes seleccionar una fecha igual o mayor a 13 años atrás.");
            document.getElementById("fecha").value = ""; // Limpiamos el campo de fecha
        }
    }
</script> 

<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <img src="/logo.jpg" class="h-16 w-auto mx-auto" alt="Logo">
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="nickname" value="{{ __('Nombre de usuario') }}" />
                <x-input id="nickname" class="block mt-1 w-full" type="text" name="nickname" :value="old('nickname')" required autofocus autocomplete="nickname" />
            </div>

            <div class="mt-4"> 
                <x-label for="name" value="{{ __('Nombre') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4"> 
                <x-label for="biografia" value="{{ __('Biografia') }}" />
                <x-input id="biografia" class="block mt-1 w-full" type="text" name="biografia" :value="old('biografia')" required autofocus autocomplete="biografia" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Contraseña') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="fecha" value="{{ __('Fecha de nacimiento') }}" />
                <input type="date" id="fecha" name="fecha" style="background-color: black; color: white;" onchange="validarEdad(this.value)">
            </div>

            <div class="mt-4"> 
                <x-label for="publico">
                    <x-input id="publico" type="checkbox" name="publico"/>
                    Deseo que mi perfil sea público
                </x-label>

            </div>
            

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="/">
                    {{ __('Ya estoy registrado') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Registrarse') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

