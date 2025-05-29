@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto px-4 py-8">
    <h1 class="mb-6 text-2xl font-bold text-gray-800">Editar Categoría</h1>

    <form action="{{ route('categorias.update', $categoria->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900">Nombre</label>
            <input type="text" name="nombre" id="nombre"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                value="{{ old('nombre', $categoria->nombre) }}" required>
            @error('nombre')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900">Descripción</label>
            <textarea name="descripcion" id="descripcion"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                rows="3">{{ old('descripcion', $categoria->descripcion) }}</textarea>
            @error('descripcion')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-2">
            <button type="submit"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Actualizar</button>
            <a href="{{ route('categorias.index') }}"
                class="w-full text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center flex items-center justify-center">Cancelar</a>
        </div>
    </form>
</div>
@endsection
