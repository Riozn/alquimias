<?php

namespace App\Http\Controllers;

use App\Models\invoiceDetails;
use Illuminate\Http\Request;

use App\InvoiceDetail;

class invoiceDetailsController extends Controller
{
    /**
     * Display a listing of the invoice details.
     */
    public function index()
    {
        $invoiceDetails = InvoiceDetail::all();
        return view('invoiceDetails.index', compact('invoiceDetails'));
    }

    /**
     * Show the form for creating a new invoice detail.
     */
    public function create()
    {
        return view('invoiceDetails.create');
    }

    /**
     * Store a newly created invoice detail in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'OrderID' => 'required|integer',
            'DishID' => 'required|integer',
            'Quantity' => 'required|integer',
            'UnitPrice' => 'required|numeric',
        ]);

        // Crear un nuevo detalle de factura en la base de datos
        InvoiceDetail::create([
            'OrderID' => $request->input('OrderID'),
            'DishID' => $request->input('DishID'),
            'Quantity' => $request->input('Quantity'),
            'UnitPrice' => $request->input('UnitPrice'),
        ]);

        // Redirigir a la página de lista de detalles de factura
        return redirect()->route('invoiceDetails.index')->with('success', 'Detalle de factura creado con éxito.');
    }

    /**
     * Display the specified invoice detail.
     */
    public function show(InvoiceDetail $invoiceDetail)
    {
        return view('invoiceDetails.show', compact('invoiceDetail'));
    }

    /**
     * Show the form for editing the specified invoice detail.
     */
    public function edit(InvoiceDetail $invoiceDetail)
    {
        return view('invoiceDetails.edit', compact('invoiceDetail'));
    }

    /**
     * Update the specified invoice detail in storage.
     */
    public function update(Request $request, InvoiceDetail $invoiceDetail)
    {
        // Validar y actualizar los datos del detalle de factura
        $request->validate([
            'OrderID' => 'required|integer',
            'DishID' => 'required|integer',
            'Quantity' => 'required|integer',
            'UnitPrice' => 'required|numeric',
        ]);

        $invoiceDetail->update([
            'OrderID' => $request->input('OrderID'),
            'DishID' => $request->input('DishID'),
            'Quantity' => $request->input('Quantity'),
            'UnitPrice' => $request->input('UnitPrice'),
        ]);

        // Redirigir a la página de lista de detalles de factura
        return redirect()->route('invoiceDetails.index')->with('success', 'Detalle de factura actualizado con éxito.');
    }

    /**
     * Remove the specified invoice detail from storage.
     */
    public function destroy(InvoiceDetail $invoiceDetail)
    {
        // Eliminar el detalle de factura de la base de datos
        $invoiceDetail->delete();

        // Redirigir a la página de lista de detalles de factura
        return redirect()->route('invoiceDetails.index')->with('success', 'Detalle de factura eliminado con éxito.');
    }
}