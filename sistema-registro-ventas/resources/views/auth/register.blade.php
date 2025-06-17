<x-guest-layout>
    <form id="register-form" method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                ¿Ya tienes una cuenta?
            </a>

            <x-primary-button class="ms-4">
                Registrar
            </x-primary-button>
        </div>
    </form>
    <script>
    $(function() {
        $('#register-form').validate({
            rules: {
                name: { required: true, maxlength: 255 },
                email: { required: true, email: true },
                password: { required: true, minlength: 8 },
                password_confirmation: { required: true, equalTo: "#password" }
            },
            messages: {
                name: {
                    required: "El nombre es obligatorio.",
                    maxlength: "El nombre no puede superar 255 caracteres."
                },
                email: {
                    required: "El correo es obligatorio.",
                    email: "Debe ser un correo válido."
                },
                password: {
                    required: "La contraseña es obligatoria.",
                    minlength: "La contraseña debe tener al menos 8 caracteres."
                },
                password_confirmation: {
                    required: "La confirmación es obligatoria.",
                    equalTo: "Las contraseñas no coinciden."
                }
            },
            errorClass: 'text-red-600 text-sm mt-2',
            errorElement: 'div',
            highlight: function(element) {
                $(element).addClass('border-red-500');
            },
            unhighlight: function(element) {
                $(element).removeClass('border-red-500');
            }
        });
    });
    </script>
</x-guest-layout>
