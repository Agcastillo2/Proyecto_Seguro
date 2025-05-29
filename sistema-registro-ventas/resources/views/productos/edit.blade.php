@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto px-4 py-8">
        <h1 class="mb-6 text-2xl font-bold text-gray-800">Editar Producto</h1>

        <form id="producto-form" action="{{ route('productos.update', $producto->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900">Nombre</label>
                <input type="text" name="nombre" id="nombre"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    value="{{ old('nombre', $producto->nombre) }}" >
                @error('nombre')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="precio" class="block mb-2 text-sm font-medium text-gray-900">Precio</label>
                <input type="number" step="0.01" name="precio" id="precio"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    value="{{ old('precio', $producto->precio) }}" >
                @error('precio')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="stock" class="block mb-2 text-sm font-medium text-gray-900">Stock</label>
                <input type="number" name="stock" id="stock"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    value="{{ old('stock', $producto->stock) }}" >
                @error('stock')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="categoria_id" class="block mb-2 text-sm font-medium text-gray-900">Categoría</label>
                <select name="categoria_id" id="categoria_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    >
                    <option value="">Seleccione...</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}"
                            {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('categoria_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-2">
                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Actualizar</button>
                <a href="{{ route('productos.index') }}"
                    class="w-full text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center flex items-center justify-center">Cancelar</a>
            </div>
        </form>
    </div>
<script>
$(function() {
    $('#producto-form').validate({
        rules: {
            nombre: { required: true },
            precio: { required: true, number: true },
            stock: { required: true, digits: true },
            categoria_id: { required: true }
        },
        messages: {
            nombre: { required: "El nombre es obligatorio." },
            precio: {
                required: "El precio es obligatorio.",
                number: "Debe ser un número válido."
            },
            stock: {
                required: "El stock es obligatorio.",
                digits: "Debe ser un número entero."
            },
            categoria_id: { required: "Seleccione una categoría." }
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
