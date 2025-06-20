<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aufgaben;
use Illuminate\Http\Request;

class AufgabenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Aufgaben::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|in:todo,in_progress,done',
        ]);

        return Aufgaben::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Aufgaben $aufgabe): Aufgaben
    {
        return $aufgabe;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aufgaben $aufgabe): Aufgaben
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|max:255',
            'description' => 'sometimes|required',
            'status' => 'sometimes|required|in:todo,in_progress,done',
        ]);

        $aufgabe->update($validated);

        return $aufgabe;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aufgaben $aufgabe)
    {
        $aufgabe->delete();

        return response()->noContent();
    }
}
