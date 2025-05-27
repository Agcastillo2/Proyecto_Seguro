@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Producto</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $producto->nombre }}</h5>
            <p class="card-text"><strong>Precio:</strong> ${{ $producto->precio }}</p>
            <p class="card-text"><strong>Stock:</strong> {{ $producto->stock }}</p>
            <p class="card-text"><strong>Categoría:</strong> {{ $producto->categoria->nombre }}</p>
        </div>
    </div>

    <a href="{{ route('productos.index') }}" class="btn btn-secondary mt-3">Volver</a>
    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning mt-3">Editar</a>
</div>
@endsection
