@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-8">
    <h1 class="mb-6 text-2xl font-bold text-gray-800">Detalle de Venta #{{ $venta->id }}</h1>

    <div class="mb-4 p-4 bg-white rounded-lg shadow flex flex-col gap-2">
        <div>
            <span class="font-semibold text-gray-700">Total:</span>
            <span class="text-gray-900">${{ number_format($venta->total, 2) }}</span>
        </div>
        <div>
            <span class="font-semibold text-gray-700">Fecha:</span>
            <span class="text-gray-900">{{ $venta->created_at->format('d/m/Y H:i') }}</span>
        </div>
    </div>

    <h4 class="mb-2 text-lg font-semibold text-gray-700">Productos Vendidos:</h4>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-6">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-6 py-3">Producto</th>
                    <th class="px-6 py-3">Cantidad</th>
                    <th class="px-6 py-3">Precio</th>
                    <th class="px-6 py-3">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($venta->detalles as $detalle)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $detalle->producto->nombre }}</td>
                    <td class="px-6 py-4">{{ $detalle->cantidad }}</td>
                    <td class="px-6 py-4">${{ number_format($detalle->precio, 2) }}</td>
                    <td class="px-6 py-4">${{ number_format($detalle->cantidad * $detalle->precio, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('ventas.index') }}"
        class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
        Volver
    </a>
</div>
@endsection
