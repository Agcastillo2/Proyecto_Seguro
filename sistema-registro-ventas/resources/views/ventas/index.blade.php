@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="mb-6 text-2xl font-bold text-gray-800">Listado de Ventas</h1>

        @can('crear ventas')
            <a href="{{ route('ventas.create') }}"
                class="mb-4 inline-block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Nueva Venta</a>
        @endcan

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Total</th>
                        <th class="px-6 py-3">Fecha</th>
                        <th class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ventas as $venta)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $venta->id }}</td>
                            <td class="px-6 py-4">${{ number_format($venta->total, 2) }}</td>
                            <td class="px-6 py-4">{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4 flex gap-2">
                                <a href="{{ route('ventas.show', $venta) }}">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-blue-800 bg-blue-100 rounded hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                        Ver
                                    </button>
                                </a>
                                {{-- <a href="{{ route('ventas.edit', $venta) }}">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-yellow-800 bg-yellow-100 rounded hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                        Editar
                                    </button>
                                </a> --}}
                                <form action="{{ route('ventas.destroy', $venta) }}" method="POST"
                                    onsubmit="return confirm('¿Estás seguro de eliminar esta venta?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-red-800 bg-red-100 rounded hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-400">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
