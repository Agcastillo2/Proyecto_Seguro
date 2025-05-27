@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Venta</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('ventas.store') }}">
        @csrf

        <table class="table" id="productos-table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="productos[0][producto_id]" class="form-control">
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id }}">
                                    {{ $producto->nombre }} - ${{ $producto->precio }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" name="productos[0][cantidad]" class="form-control" min="1" required>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove-row">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-secondary" id="add-producto">Agregar Producto</button>
        <button type="submit" class="btn btn-primary">Registrar Venta</button>
    </form>
</div>

<script>
let rowCount = 1;

document.getElementById('add-producto').addEventListener('click', () => {
    const tbody = document.querySelector('#productos-table tbody');
    const newRow = document.createElement('tr');

    newRow.innerHTML = `
        <td>
            <select name="productos[${rowCount}][producto_id]" class="form-control">
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }} - ${{ $producto->precio }}</option>
                @endforeach
            </select>
        </td>
        <td>
            <input type="number" name="productos[${rowCount}][cantidad]" class="form-control" min="1" required>
        </td>
        <td>
            <button type="button" class="btn btn-danger btn-sm remove-row">Eliminar</button>
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
