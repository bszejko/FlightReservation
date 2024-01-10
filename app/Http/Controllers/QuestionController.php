<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Question;

class QuestionController extends Controller
{
    
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'bookingId' => 'required|exists:bookings,id',
        'message' => 'required|string',
    ]);
    //tworzenie nowego pytania w bazie danych
    $question = new Question;
    $question->user_id = auth()->id();
    $question->booking_id = $validatedData['bookingId'];
    $question->question = $validatedData['message'];
    $question->save();

    return response()->json(['success' => 'Pytanie wysłane! Odpowiedź otrzymasz na swój adres e-mail.']);
}


}
