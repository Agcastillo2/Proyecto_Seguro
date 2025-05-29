@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto px-4 py-8">
        <h1 class="mb-6 text-2xl font-bold text-gray-800">Crear Usuario</h1>

        <form id="usuario-form" action="{{ route('usuarios.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nombre</label>
                <input type="text" name="name" id="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required>
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Correo Electrónico</label>
                <input type="email" name="email" id="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required>
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Contraseña</label>
                <input type="password" name="password" id="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required>
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Rol</label>
                <select name="role" id="role"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required>
                    <option value="">Seleccione un rol</option>
                    @foreach ($roles as $role)
                        @if (!auth()->user()->hasRole('admin') && $role->name === 'admin')
                            @continue
                        @endif
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                @error('role')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Crear</button>
        </form>
    </div>
    <script>
        $(function() {
            $('#usuario-form').validate({
                rules: {
                    name: { required: true, maxlength: 255 },
                    email: { required: true, email: true },
                    password: { required: true, minlength: 6 },
                    role: { required: true }
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
                        minlength: "La contraseña debe tener al menos 6 caracteres."
                    },
                    role: { required: "Seleccione un rol." }
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
@endsection
