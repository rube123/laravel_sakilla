@extends('layouts.app')

@section('content')
<h1>Editar Película</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('films.update', $film) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="title" class="form-label">Título</label>
        <input type="text" name="title" class="form-control" value="{{ $film->title }}" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Descripción</label>
        <textarea name="description" class="form-control">{{ $film->description }}</textarea>
    </div>
    <div class="mb-3">
        <label for="rental_duration" class="form-label">Duración de renta (días)</label>
        <input type="number" name="rental_duration" class="form-control" value="{{ $film->rental_duration }}" required>
    </div>
    <div class="mb-3">
        <label for="rental_rate" class="form-label">Tarifa de renta</label>
        <input type="number" step="0.01" name="rental_rate" class="form-control" value="{{ $film->rental_rate }}" required>
    </div>
    <div class="mb-3">
        <label for="length" class="form-label">Duración película (minutos)</label>
        <input type="number" name="length" class="form-control" value="{{ $film->length }}">
    </div>
    <button type="submit" class="btn btn-success">Actualizar</button>
</form>
@endsection
