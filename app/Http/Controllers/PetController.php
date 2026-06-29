<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{

    public function index()
    {
        $pets = Pet::latest()->paginate(5);
        return view('pets.index', compact('pets'));
    }

    public function create()
    {
        return view('pets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
        ]);
        Pet::create($request->all());
        return redirect()->route('pets.index')
            ->with('success', 'Mascota registrada
correctamente.');
    }
}

