@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <h1 class="mb-6 text-2xl font-bold text-gray-800">Registrar Venta</h1>

    @if(session('error'))
        <div class="mb-4 p-4 text-red-800 rounded-lg bg-red-50" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('ventas.store') }}" class="space-y-6">
        @csrf

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500" id="productos-table">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">Producto</th>
                        <th class="px-6 py-3">Cantidad</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-6 py-2">
                            <select name="productos[0][producto_id]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @foreach($productos as $producto)
                                    <option value="{{ $producto->id }}">
                                        {{ $producto->nombre }} - ${{ $producto->precio }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="px-6 py-2">
                            <input type="number" name="productos[0][cantidad]" min="1" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </td>
                        <td class="px-6 py-2">
                            <button type="button" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-red-800 bg-red-100 rounded hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-400 remove-row">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="flex gap-2">
            <button type="button" id="add-producto"
                class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                Agregar Producto
            </button>
            <button type="submit"
                class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">
                Registrar Venta
            </button>
        </div>
    </form>
</div>

<script>
let rowCount = 1;

document.getElementById('add-producto').addEventListener('click', () => {
    const tbody = document.querySelector('#productos-table tbody');
    const newRow = document.createElement('tr');

    newRow.innerHTML = `
        <td class="px-6 py-2">
            <select name="productos[${rowCount}][producto_id]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }} - ${{ $producto->precio }}</option>
                @endforeach
            </select>
        </td>
        <td class="px-6 py-2">
            <input type="number" name="productos[${rowCount}][cantidad]" min="1" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </td>
        <td class="px-6 py-2">
            <button type="button" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-red-800 bg-red-100 rounded hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-400 remove-row">Eliminar</button>
        </td>
    `;

    tbody.appendChild(newRow);
    rowCount++;
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-row')) {
        e.target.closest('tr').remove();
    }
});
</script>
@endsection
