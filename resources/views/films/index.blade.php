@extends('layouts.app')

@section('content')
<h1>Lista de Películas</h1>
<a href="{{ route('films.create') }}" class="btn btn-primary mb-3">Crear Nueva Película</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Duración</th>
        <th>Tarifa de renta</th>
        <th>Acciones</th>
    </tr>
    @foreach($films as $film)
    <tr>
        <td>{{ $film->film_id }}</td>
        <td>{{ $film->title }}</td>
        <td>{{ $film->length }} min</td>
        <td>${{ $film->rental_rate }}</td>
        <td>
            <a href="{{ route('films.show', $film) }}" class="btn btn-info btn-sm">Ver</a>
            <a href="{{ route('films.edit', $film) }}" class="btn btn-warning btn-sm">Editar</a>
            <form action="{{ route('films.destroy', $film) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres eliminar?')">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
