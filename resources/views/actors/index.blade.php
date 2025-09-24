@extends('layouts.app')

@section('content')
<h1>Lista de Actores</h1>
<a href="{{ route('actors.create') }}" class="btn btn-primary mb-3">Crear Nuevo Actor</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Acciones</th>
    </tr>
    @foreach($actors as $actor)
    <tr>
        <td>{{ $actor->actor_id }}</td>
        <td>{{ $actor->first_name }}</td>
        <td>{{ $actor->last_name }}</td>
        <td>
            <a href="{{ route('actors.show', $actor) }}" class="btn btn-info btn-sm">Ver</a>
            <a href="{{ route('actors.edit', $actor) }}" class="btn btn-warning btn-sm">Editar</a>
            <form action="{{ route('actors.destroy', $actor) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres eliminar?')">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
