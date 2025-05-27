@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle de Venta #{{ $venta->id }}</h1>

    <p><strong>Total:</strong> ${{ $venta->total }}</p>
    <p><strong>Fecha:</strong> {{ $venta->created_at->format('d/m/Y H:i') }}</p>

    <h4>Productos Vendidos:</h4>
    <ul>
        @foreach($venta->detalles as $detalle)
            <li>
                {{ $detalle->producto->nombre }} - {{ $detalle->cantidad }} x ${{ $detalle->precio }}
                = ${{ $detalle->cantidad * $detalle->precio }}
            </li>
        @endforeach
    </ul>

    <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
