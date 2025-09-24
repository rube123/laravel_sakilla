@extends('layouts.app')

@section('content')
<h1>Detalle de la Renta</h1>

<p><strong>ID Renta:</strong> {{ $rental->rental_id }}</p>
<p><strong>Cliente:</strong> {{ $rental->customer->first_name }} {{ $rental->customer->last_name }}</p>
<p><strong>Película:</strong> {{ $rental->inventory->film->title }}</p>
<p><strong>Fecha de Renta:</strong> {{ $rental->rental_date }}</p>
<p><strong>Fecha de Devolución:</strong> {{ $rental->return_date ?? 'No devuelto' }}</p>

<a href="{{ route('rentals.index') }}" class="btn btn-primary">Volver</a>
@endsection
