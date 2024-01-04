<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Booking;


class FlightController extends Controller
{
    public function store(Request $request)
    {


        
        // Walidacja danych wejściowych
        $request->validate([
            'from' => 'required|string|max:255',
            'to' => 'required|string|max:255',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date',
        ]);

        // Tworzenie nowego rekordu lotu
        $flight = Flight::create([
            'from' => $request->from,
            'to' => $request->to,
            'departure_time' => $request->departure_time,
            'arrival_time' => $request->arrival_time
        ]);

        // Sprawdzenie czy lot jest poprawnie utworzony
        if ($flight) {
            // Jeśli tak, utwórz nową rezerwację
            $booking = Booking::create([
                'flight_id' => $flight->id,
                'user_id' => auth()->user()->id, // użytkownik musi być zalogowany
                'booking_date' => now(), // Bieżąca data i czas
                'status' => 'zarezerwowany', //status rezerwacji
            ]);
        
        }
        // Przekierowanie do search.flights z wiadomością (styl okienka jest w kodzie search.blade.php)
    return redirect()->route('search.flights')->with('success', 'Lot o numerze ' . $flight->id . ' został zarezerwowany.');
    }

    
}

