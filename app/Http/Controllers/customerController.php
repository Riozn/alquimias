<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;

class customerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all(); // Obtener todos los clientes desde la base de datos.
        return view('customers.index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create'); // Mostrar el formulario de creación de clientes.
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario antes de crear el cliente.
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers|max:255',
            // Otros campos y reglas de validación según tus necesidades.
        ]);

        // Crear un nuevo cliente en la base de datos.
        $customer = new Customer($validatedData);
        $customer->save();

        return redirect()->route('customers.index')->with('success', 'Cliente creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('customers.show', ['customer' => $customer]); // Mostrar la información del cliente.
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', ['customer' => $customer]); // Mostrar el formulario de edición del cliente.
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        // Validar los datos del formulario antes de actualizar el cliente.
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,'.$customer->id.'|max:255',
            // Otros campos y reglas de validación según tus necesidades.
        ]);

        // Actualizar los datos del cliente en la base de datos.
        $customer->update($validatedData);

        return redirect()->route('customers.index')->with('success', 'Cliente actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete(); // Eliminar el cliente de la base de datos.
        return redirect()->route('customers.index')->with('success', 'Cliente eliminado con éxito');
    }
}
