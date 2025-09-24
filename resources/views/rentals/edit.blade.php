@extends('layouts.app')

@section('content')
<h1>Editar Renta</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('rentals.update', $rental) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="customer_id" class="form-label">Cliente</label>
        <select name="customer_id" class="form-control" required>
            @foreach($customers as $customer)
            <option value="{{ $customer->customer_id }}"
                {{ $customer->customer_id == $rental->customer_id ? 'selected' : '' }}>
                {{ $customer->first_name }} {{ $customer->last_name }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="film_id" class="form-label">Película</label>
        <select name="film_id" class="form-control" required>
            @foreach($films as $film)
            <option value="{{ $film->film_id }}"
                {{ $film->film_id == $rental->inventory->film_id ? 'selected' : '' }}>
                {{ $film->title }}
            </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-success">Actualizar Renta</button>
</form>
@endsection
