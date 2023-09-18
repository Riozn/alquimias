<?php

namespace App\Http\Controllers;

use App\Models\dish;
use Illuminate\Http\Request;




class DishController extends Controller
{
    /**
     * Display a listing of the dishes.
     */
    public function index()
    {
        $dishes = Dish::all();
        return view('dishes.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new dish.
     */
    public function create()
    {
        return view('dishes.create');
    }

    /**
     * Store a newly created dish in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'Name' => 'required|string|max:100',
            'Description' => 'required|string|max:200',
            'Price' => 'required|numeric',
        ]);

        // Crear un nuevo plato en la base de datos
        Dish::create([
            'Name' => $request->input('Name'),
            'Description' => $request->input('Description'),
            'Price' => $request->input('Price'),
        ]);

        // Redirigir a la página de lista de platos
        return redirect()->route('dishes.index')->with('success', 'Plato creado con éxito.');
    }

    /**
     * Display the specified dish.
     */
    public function show(Dish $dish)
    {
        return view('dishes.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified dish.
     */
    public function edit(Dish $dish)
    {
        return view('dishes.edit', compact('dish'));
    }

    /**
     * Update the specified dish in storage.
     */
    public function update(Request $request, Dish $dish)
    {
        // Validar y actualizar los datos del plato
        $request->validate([
            'Name' => 'required|string|max:100',
            'Description' => 'required|string|max:200',
            'Price' => 'required|numeric',
        ]);

        $dish->update([
            'Name' => $request->input('Name'),
            'Description' => $request->input('Description'),
            'Price' => $request->input('Price'),
        ]);

        // Redirigir a la página de lista de platos
        return redirect()->route('dishes.index')->with('success', 'Plato actualizado con éxito.');
    }

    /**
     * Remove the specified dish from storage.
     */
    public function destroy(Dish $dish)
    {
        // Eliminar el plato de la base de datos
        $dish->delete();

        // Redirigir a la página de lista de platos
        return redirect()->route('dishes.index')->with('success', 'Plato eliminado con éxito.');
    }
}