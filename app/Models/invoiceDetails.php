<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    protected $primaryKey = null; // Sin clave primaria
    public $incrementing = false; // No usar autoincremento
    protected $fillable = ['OrderID', 'DishID', 'Quantity', 'UnitPrice'];

    // Define una relación con la tabla 'orders'
    public function order()
    {
        return $this->belongsTo(Order::class, 'OrderID');
    }

    // Define una relación con la tabla 'dishes'
    public function dish()
    {
        return $this->belongsTo(Dish::class, 'DishID');
    }
}