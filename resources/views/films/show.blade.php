@extends('layouts.app')

@section('content')
<h1>Detalles de la Película</h1>

<p><strong>ID:</strong> {{ $film->film_id }}</p>
<p><strong>Título:</strong> {{ $film->title }}</p>
<p><strong>Descripción:</strong> {{ $film->description }}</p>
<p><strong>Duración:</strong> {{ $film->length }} min</p>
<p><strong>Duración de renta:</strong> {{ $film->rental_duration }} días</p>
<p><strong>Tarifa de renta:</strong> ${{ $film->rental_rate }}</p>

<a href="{{ route('films.index') }}" class="btn btn-primary">Volver</a>
@endsection
