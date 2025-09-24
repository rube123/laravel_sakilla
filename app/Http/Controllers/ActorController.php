<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    public function index()
    {
        $actors = Actor::all();
        return view('actors.index', compact('actors'));
    }

    public function create()
    {
        return view('actors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:45',
            'last_name' => 'required|max:45',
        ]);

        Actor::create($request->all());

        return redirect()->route('actors.index')->with('success', 'Actor creado correctamente.');
    }

    public function show(Actor $actor)
    {
        return view('actors.show', compact('actor'));
    }

    public function edit(Actor $actor)
    {
        return view('actors.edit', compact('actor'));
    }

    public function update(Request $request, Actor $actor)
    {
        $request->validate([
            'first_name' => 'required|max:45',
            'last_name' => 'required|max:45',
        ]);

        $actor->update($request->all());

        return redirect()->route('actors.index')->with('success', 'Actor actualizado correctamente.');
    }

   public function destroy(Actor $actor)
{
    // Eliminar relaciones en film_actor
    \DB::table('film_actor')->where('actor_id', $actor->actor_id)->delete();

    // Ahora eliminar el actor
    $actor->delete();

    return redirect()->route('actors.index')->with('success', 'Actor eliminado correctamente.');
}
}
