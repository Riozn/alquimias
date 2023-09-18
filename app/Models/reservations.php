<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $primaryKey = 'ReservationID';
    protected $fillable = ['CustomerID', 'ReservationDate', 'NumberOfPeople'];

    // Define una relación con la tabla 'customers'
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'CustomerID');
    }
}
