<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function index()
    {
        $films = Film::all();
        return view('films.index', compact('films'));
    }

    public function create()
    {
        return view('films.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'rental_rate' => 'required|numeric',
            'rental_duration' => 'required|integer',
        ]);

        Film::create($request->all());

        return redirect()->route('films.index')->with('success', 'Película creada correctamente.');
    }

    public function show(Film $film)
    {
        return view('films.show', compact('film'));
    }

    public function edit(Film $film)
    {
        return view('films.edit', compact('film'));
    }

    public function update(Request $request, Film $film)
    {
        $request->validate([
            'title' => 'required|max:255',
            'rental_rate' => 'required|numeric',
            'rental_duration' => 'required|integer',
        ]);

        $film->update($request->all());

        return redirect()->route('films.index')->with('success', 'Película actualizada correctamente.');
    }

    public function destroy(Film $film)
    {
        // Revisar si existen rentas asociadas antes de eliminar
        if (\DB::table('rental')->where('inventory_id', $film->film_id)->exists()) {
            return redirect()->route('films.index')->with('error', 'No se puede eliminar la película porque tiene rentas asociadas.');
        }

        $film->delete();
        return redirect()->route('films.index')->with('success', 'Película eliminada correctamente.');
    }
}
