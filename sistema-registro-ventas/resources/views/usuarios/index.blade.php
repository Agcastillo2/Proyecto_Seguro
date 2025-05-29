@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="mb-6 text-2xl font-bold text-gray-800">Listado de Usuarios</h1>
        @can('crear usuarios')
            <a href="{{ route('usuarios.create') }}"
                class="mb-4 inline-block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Nuevo
                Usuario</a>
        @endcan

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">Nombre</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('secre'))
                            <th scope="col" class="px-6 py-3">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $usuario->id }}</td>
                            <td class="px-6 py-4">{{ $usuario->name }}</td>
                            <td class="px-6 py-4">{{ $usuario->email }}</td>
                            @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('secre'))
                                <td class="px-6 py-4 flex gap-2">
                                    @if (!$usuario->hasRole('admin') || auth()->user()->hasRole('admin'))
                                        <a href="{{ route('usuarios.edit', $usuario->id) }}"
                                            class="font-medium text-yellow-600 hover:underline">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-yellow-800 bg-yellow-100 rounded hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                                Editar
                                            </button>
                                        </a>
                                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST"
                                            onsubmit="return confirm('¿Eliminar este usuario?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-red-800 bg-red-100 rounded hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-400">
                                                Eliminar
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
