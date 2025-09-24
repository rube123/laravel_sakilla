@extends('layouts.app')

@section('content')
<h1>{{ isset($actor) ? 'Editar Actor' : 'Crear Actor' }}</h1>

<form action="{{ isset($actor) ? route('actors.update', $actor) : route('actors.store') }}" method="POST">
    @csrf
    @if(isset($actor))
        @method('PUT')
    @endif
    <label>Nombre:</label>
    <input type="text" name="first_name" value="{{ $actor->first_name ?? old('first_name') }}" required>
    <br>
    <label>Apellido:</label>
    <input type="text" name="last_name" value="{{ $actor->last_name ?? old('last_name') }}" required>
    <br>
    <button type="submit">{{ isset($actor) ? 'Actualizar' : 'Guardar' }}</button>
</form>
@endsection
