@extends('layouts.app')

@section('content')
<h1>Crear Renta</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('rentals.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="customer_id" class="form-label">Cliente</label>
        <select name="customer_id" class="form-control" required>
            <option value="">Selecciona un cliente</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->customer_id }}">{{ $customer->first_name }} {{ $customer->last_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="film_id" class="form-label">Película</label>
        <select name="film_id" class="form-control" required>
            <option value="">Selecciona una película</option>
            @foreach($films as $film)
                <option value="{{ $film->film_id }}">{{ $film->title }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-success">Rentar</button>
</form>
@endsection
