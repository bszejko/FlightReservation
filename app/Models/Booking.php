<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    use HasFactory;

    //masowe przypisywanie zmiennych
    protected $fillable = ['user_id', 'flight_id', 'booking_date','status'];
    protected $table = 'bookings';
}
