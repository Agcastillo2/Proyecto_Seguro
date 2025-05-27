@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles de Categoría</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $categoria->nombre }}</h5>
            <p class="card-text"><strong>Descripción:</strong> {{ $categoria->descripcion }}</p>
        </div>
    </div>

    <a href="{{ route('categorias.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection
