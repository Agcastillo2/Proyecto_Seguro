@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Usuario</h1>

    <div class="mb-3">
        <strong>Nombre:</strong> {{ $usuario->name }}
    </div>
    <div class="mb-3">
        <strong>Email:</strong> {{ $usuario->email }}
    </div>

    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
