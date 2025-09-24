@extends('layouts.app')

@section('content')
<h1>Lista de Rentas</h1>
<a href="{{ route('rentals.create') }}" class="btn btn-primary mb-3">Crear Renta</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Película</th>
        <th>Fecha de Renta</th>
        <th>Fecha de Devolución</th>
        <th>Acciones</th>
    </tr>
    @foreach($rentals as $rental)
    <tr>
        <td>{{ $rental->rental_id }}</td>
        <td>{{ $rental->customer->first_name }} {{ $rental->customer->last_name }}</td>
        <td>{{ $rental->inventory->film->title }}</td>
        <td>{{ $rental->rental_date }}</td>
        <td>{{ $rental->return_date ?? 'No devuelto' }}</td>
        <td>
            <a href="{{ route('rentals.show', $rental) }}" class="btn btn-info btn-sm">Ver</a>
            <a href="{{ route('rentals.edit', $rental) }}" class="btn btn-warning btn-sm">Editar</a>
            
            <form action="{{ route('rentals.destroy', $rental) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm('¿Seguro que quieres eliminar esta renta?')">Eliminar</button>
            </form>

            @if(!$rental->return_date)
            <form action="{{ route('rentals.return', $rental) }}" method="POST" style="display:inline">
                @csrf
                <button type="submit" class="btn btn-success btn-sm">Devolver</button>
            </form>
            @endif
        </td>
    </tr>
    @endforeach
</table>
@endsection
