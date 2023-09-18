<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'OrderID';
    protected $fillable = ['CustomerID', 'NumberOfPeople', 'OrderDate'];

    // Define una relación con la tabla 'customers'
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'CustomerID');
    }

    // Define una relación con la tabla 'invoiceDetails'
    public function invoiceDetails()
    {
        return $this->hasMany(InvoiceDetail::class, 'OrderID');
    }
}
