@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Ventas</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @can('crear productos')
    <a href="{{ route('productos.create') }}" class="btn btn-success">Nuevo Producto</a>
@endcan


    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Total</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventas as $venta)
                <tr>
                    <td>{{ $venta->id }}</td>
                    <td>${{ number_format($venta->total, 2) }}</td>
                    <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('ventas.show', $venta) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('ventas.edit', $venta) }}" class="btn btn-warning btn-sm">Editar</a>

                        <form action="{{ route('ventas.destroy', $venta) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar esta venta?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
