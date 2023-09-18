<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'CustomerID' => 'required|integer',
            'NumberOfPeople' => 'required|integer',
            'OrderDate' => 'required|date',
        ]);

        // Crear una nueva orden en la base de datos
        Order::create([
            'CustomerID' => $request->input('CustomerID'),
            'NumberOfPeople' => $request->input('NumberOfPeople'),
            'OrderDate' => $request->input('OrderDate'),
        ]);

        // Redirigir a la página de lista de órdenes
        return redirect()->route('orders.index')->with('success', 'Orden creada con éxito.');
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, Order $order)
    {
        // Validar y actualizar los datos de la orden
        $request->validate([
            'CustomerID' => 'required|integer',
            'NumberOfPeople' => 'required|integer',
            'OrderDate' => 'required|date',
        ]);

        $order->update([
            'CustomerID' => $request->input('CustomerID'),
            'NumberOfPeople' => $request->input('NumberOfPeople'),
            'OrderDate' => $request->input('OrderDate'),
        ]);

        // Redirigir a la página de lista de órdenes
        return redirect()->route('orders.index')->with('success', 'Orden actualizada con éxito.');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(Order $order)
    {
        // Eliminar la orden de la base de datos
        $order->delete();

        // Redirigir a la página de lista de órdenes
        return redirect()->route('orders.index')->with('success', 'Orden eliminada con éxito.');
    }
}