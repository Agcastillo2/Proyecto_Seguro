@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Venta #{{ $venta->id }}</h1>

    <form method="POST" action="{{ route('ventas.update', $venta) }}">
        @csrf
        @method('PUT')

        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach($venta->detalles as $index => $detalle)
                <tr>
                    <td>{{ $detalle->producto->nombre }}</td>
                    <td>
                        <input type="number" name="productos[{{ $index }}][cantidad]"
                            value="{{ $detalle->cantidad }}" class="form-control" min="1" required>
                        <input type="hidden" name="productos[{{ $index }}][detalle_id]" value="{{ $detalle->id }}">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Actualizar Venta</button>
    </form>
</div>
@endsection
