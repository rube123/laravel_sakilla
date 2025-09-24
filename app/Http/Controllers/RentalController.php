<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Film;
use App\Models\Inventory;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::with('customer', 'inventory.film')->get();
        return view('rentals.index', compact('rentals'));
    }

    public function create()
    {
        $films = Film::all();
        $customers = Customer::all();
        return view('rentals.create', compact('films', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'film_id' => 'required|exists:film,film_id',
            'customer_id' => 'required|exists:customer,customer_id',
        ]);

        // Obtener un inventory disponible de la película
        $inventory = Inventory::where('film_id', $request->film_id)
            ->whereNotIn('inventory_id', function($query) {
                $query->select('inventory_id')->from('rental')->whereNull('return_date');
            })
            ->first();

        if (!$inventory) {
            return redirect()->back()->with('error', 'No hay copias disponibles para esta película.');
        }

        Rental::create([
            'rental_date' => now(),
            'inventory_id' => $inventory->inventory_id,
            'customer_id' => $request->customer_id,
            'staff_id' => 1, // Asumiendo staff 1
            'return_date' => null,
        ]);

        return redirect()->route('rentals.index')->with('success', 'Película rentada correctamente.');
    }

    public function show(Rental $rental)
    {
        $rental->load('customer', 'inventory.film');
        return view('rentals.show', compact('rental'));
    }


    public function edit(Rental $rental)
{
    $films = Film::all();
    $customers = Customer::all();
    return view('rentals.edit', compact('rental', 'films', 'customers'));
}

public function update(Request $request, Rental $rental)
{
    $request->validate([
        'film_id' => 'required|exists:film,film_id',
        'customer_id' => 'required|exists:customer,customer_id',
    ]);

    // Actualizar inventory si cambió la película
    if ($rental->inventory->film_id != $request->film_id) {
        $inventory = Inventory::where('film_id', $request->film_id)
            ->whereNotIn('inventory_id', function($query) {
                $query->select('inventory_id')->from('rental')->whereNull('return_date');
            })
            ->first();

        if (!$inventory) {
            return redirect()->back()->with('error', 'No hay copias disponibles para esta película.');
        }

        $rental->inventory_id = $inventory->inventory_id;
    }

    $rental->customer_id = $request->customer_id;
    $rental->save();

    return redirect()->route('rentals.index')->with('success', 'Renta actualizada correctamente.');
}

public function destroy(Rental $rental)
{
    $rental->delete();
    return redirect()->route('rentals.index')->with('success', 'Renta eliminada correctamente.');
}

public function return(Rental $rental)
{
    $rental->return_date = now();
    $rental->save();
    return redirect()->route('rentals.index')->with('success', 'Película devuelta correctamente.');
}
}
