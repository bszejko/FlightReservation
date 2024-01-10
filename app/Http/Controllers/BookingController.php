<?php

namespace App\Http\Controllers;
use App\Models\Booking; // Import modelu Booking
use Illuminate\Http\Request;
use App\Models\Flight; 

class BookingController extends Controller
{


    public function index()
    {
        // Pobieranie rezerwacji dla zalogowanego użytkownika
        $userBookings = Booking::with('flight')
        ->where('user_id', auth()->id())
        ->get();
        //suma cen
    
        $totalPrice = $userBookings->sum(function ($booking) {
            return $booking->flight->price;
        });
        
    // Przekazanie danych do widoku
    return view('bookings.index', [
        'userBookings' => $userBookings, 
        'totalPrice' => $totalPrice
    ]);

    }
    public function create(Request $request)
    {
        $flightDetails = [
            'id' => $request->flightId,
            'from' => $request->from,
            'to' => $request->to,
            'departure_time' => $request->departure_time,
            'arrival_time' => $request->arrival_time,
            'price' => $request->price
        ];
        
    
        session(['bookingFlight' => $flightDetails]);
    
        // Przekazanie zmiennych do widoku jako część tablicy o nazwie $flightDetails
        return view('travel.booking', compact('flightDetails'));
    }
    
    
    
        
        private function getFlightDetails($flightId)
        {
            // dane lotów są przechowywane w sesji
            $flightsArray = session('flightsArray', []);
        
            foreach ($flightsArray as $flight) {
                if ($flight['id'] == $flightId) {
                    return $flight;
                }
            }
        
            return null;
        }
    
        public function store(Request $request)
    {
        $flightDetails = session('bookingFlight');
        if (!$flightDetails) {
            return redirect()->route('travel')->with('error', 'Brak szczegółów lotu.');
        }
    
        $booking = new Booking();
        $booking->user_id = auth()->id();
        $booking->flight_id = $flightDetails['id'];
        $booking->booking_date = now();
        $booking->status = 'created';
        $booking->save();
    
        return redirect()->route('booking.confirmation', ['bookingId' => $booking->id]);
    }
    
        public function cancel(Request $request, $bookingId)
{
    $booking = Booking::where('id', $bookingId)
                      ->where('user_id', auth()->id())
                      ->first();

    if ($booking) {
        $booking->delete();
        return response()->json(['success' => 'Rezerwacja została anulowana.']);
    }

    return response()->json(['error' => 'Rezerwacja nie znaleziona.'], 404);
}

    }
