<?php

namespace App\Http\Controllers;

use App\Models\reservations;
use Illuminate\Http\Request;


use App\Reservation;

class ReservationController extends Controller
{
    /**
     * Display a listing of the reservations.
     */
    public function index()
    {
        $reservations = Reservation::all();
        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new reservation.
     */
    public function create()
    {
        return view('reservations.create');
    }

    /**
     * Store a newly created reservation in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'CustomerID' => 'required|integer',
            'ReservationDate' => 'required|date',
            'NumberOfPeople' => 'required|integer',
        ]);

        // Crear una nueva reserva en la base de datos
        Reservation::create([
            'CustomerID' => $request->input('CustomerID'),
            'ReservationDate' => $request->input('ReservationDate'),
            'NumberOfPeople' => $request->input('NumberOfPeople'),
        ]);

        // Redirigir a la página de lista de reservas
        return redirect()->route('reservations.index')->with('success', 'Reserva creada con éxito.');
    }

    /**
     * Display the specified reservation.
     */
    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified reservation.
     */
    public function edit(Reservation $reservation)
    {
        return view('reservations.edit', compact('reservation'));
    }

    /**
     * Update the specified reservation in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        // Validar y actualizar los datos de la reserva
        $request->validate([
            'CustomerID' => 'required|integer',
            'ReservationDate' => 'required|date',
            'NumberOfPeople' => 'required|integer',
        ]);

        $reservation->update([
            'CustomerID' => $request->input('CustomerID'),
            'ReservationDate' => $request->input('ReservationDate'),
            'NumberOfPeople' => $request->input('NumberOfPeople'),
        ]);

        // Redirigir a la página de lista de reservas
        return redirect()->route('reservations.index')->with('success', 'Reserva actualizada con éxito.');
    }

    /**
     * Remove the specified reservation from storage.
     */
    public function destroy(Reservation $reservation)
    {
        // Eliminar la reserva de la base de datos
        $reservation->delete();

        // Redirigir a la página de lista de reservas
        return redirect()->route('reservations.index')->with('success', 'Reserva eliminada con éxito.');
    }
}