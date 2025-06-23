<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aufgabe;
use Illuminate\Http\Request;

class AufgabenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Aufgabe::all();
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

        return $request->user()->aufgaben()->create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Aufgabe $aufgabe): Aufgabe
    {
        return $aufgabe;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $aufgabe = Aufgabe::find($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:todo,in_progress,done',
        ]);

        $result = $aufgabe->update($validated);

        return response()->json($aufgabe->fresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $aufgabe = Aufgabe::findOrFail($id);
        $aufgabe->delete();

        return response()->noContent();
    }
}
