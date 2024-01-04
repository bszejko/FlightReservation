<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//sciezki dodane przez laravel
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


use App\Http\Controllers\NowyTravelController;
//scieżki travel czyli index i search
Route::group(['prefix' => 'travel'], function () {
    Route::get('/', [NowyTravelController::class, 'index'])->name('travel');
    Route::match(['get', 'post'], '/search-flights', [NowyTravelController::class, 'searchFlights'])->name('search.flights');

});

use App\Http\Controllers\BookingController;

//ścieżki do Booking Controller (na razie nieużywany)
Route::get('/travel/booking/create/{flightId}', [BookingController::class, 'create'])->name('booking.create')->middleware('auth');

Route::post('/bookings/store', [BookingController::class, 'store'])->name('bookings.store')->middleware('auth');

Route::get('/booking/confirmation/{bookingId}', [BookingController::class, 'confirmation'])->name('booking.confirmation');

Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index')->middleware('auth');

use App\Http\Controllers\FlightController;

//scieżka do Flight Controller
Route::post('/flights', [FlightController::class, 'store'])->name('flights.store');
