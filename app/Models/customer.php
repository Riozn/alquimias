<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Customer extends Model
{
    protected $primaryKey = 'CustomerID'; // Define la clave primaria personalizada
    protected $fillable = ['Name', 'Phone', 'Email', 'RegistrationDate']; // Define las columnas que se pueden asignar en masa

    // Define relaciones
}
