<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DateTime;

class NowyTravelController extends Controller
{
    public function index()
    {

        return view('travel.index');
    }

    public function searchFlights(Request $request)
{
    // Pobieranie danych z formularza i zapisywanie ich w sesji
    $FromCode = $request->input('departureCountry') ?? session('departureCountry');
    $ToCode = $request->input('arrivalCountry') ?? session('arrivalCountry');
    $rawDate = $request->input('dateRange')?? session('dateRange');
    $Date = date('Ymd', strtotime($rawDate));
    $rawReturnDate = $request->input('dateRange2') ?? session('dateRange2');
    $ReturnDate = date('Ymd', strtotime($rawReturnDate));



    //tworzenie sesji
    session([
        'departureCountry' => $FromCode,
    'arrivalCountry' => $ToCode,
    'dateRange' => $rawDate,
    'dateRange2' => $rawReturnDate,
    'formattedDate' => $Date, // Zapisuje sformatowaną datę wylotu
    'formattedReturnDate' => $ReturnDate // Zapisuje sformatowaną datę powrotu
    ]);

    
    if ($FromCode && $ToCode && $rawDate && $rawReturnDate){ //jeżeli wszystkie zmienne są ustawione to:

    // Zapytanie o loty powrotne
    $returnApiResponse = Http::withHeaders([
        'X-RapidAPI-Key' => '42dd465c58msh952fde3e6b04e0ap112164jsn5a0846e6a7a2',
        'X-RapidAPI-Host' => 'timetable-lookup.p.rapidapi.com',
    ])->get("https://timetable-lookup.p.rapidapi.com/TimeTable/{$ToCode}/{$FromCode}/{$ReturnDate}?Connection=DIRECT");

    //Zapytanie api o loty pierwotne
    $apiResponse = Http::withHeaders([
        'X-RapidAPI-Key' => '42dd465c58msh952fde3e6b04e0ap112164jsn5a0846e6a7a2',
        'X-RapidAPI-Host' => 'timetable-lookup.p.rapidapi.com',
    ])->get("https://timetable-lookup.p.rapidapi.com/TimeTable/{$FromCode}/{$ToCode}/{$Date}?Connection=DIRECT");

    //loty powrotne jesli api odpowie
    if ($returnApiResponse->successful()) {
        $returnXml = simplexml_load_string($returnApiResponse->body());
        if ($returnXml !== false) {
            $returnFlightsArray = [];
            foreach ($returnXml->FlightDetails as $flightDetail) {
                foreach ($flightDetail->FlightLegDetails as $leg) {
                    // Formatowanie daty
                    $departureDateTime = new DateTime((string)$leg['DepartureDateTime']);
                    $formattedDepartureDateTime = $departureDateTime->format('Y-m-d H:i');
            
                    $arrivalDateTime = new DateTime((string)$leg['ArrivalDateTime']);
                    $formattedArrivalDateTime = $arrivalDateTime->format('Y-m-d H:i');

                    $id = (string)$leg['FlightNumber'];
            
                    //Tworzenie tabeli
                    $flight = [
                        'From' => (string)$leg->DepartureAirport['LocationCode'],
                        'To' => (string)$leg->ArrivalAirport['LocationCode'],
                        'DepartureDateTime' => $formattedDepartureDateTime,
                        'ArrivalDateTime' => $formattedArrivalDateTime,
                        'id' => $id,
                        'price' => rand(55, 1000) // Generowanie losowej ceny
                    ];
                    array_push($returnFlightsArray, $flight);
        }
    }

    //loty pierwotne jesli api odpowie
    if ($apiResponse->successful()) {
        $xml = simplexml_load_string($apiResponse->body());

        if ($xml !== false) {
            $flightsArray = [];
            foreach ($xml->FlightDetails as $flightDetail) {
                foreach ($flightDetail->FlightLegDetails as $leg) {
                    // Formatowanie daty
                    $departureDateTime = new DateTime((string)$leg['DepartureDateTime']);
                    $formattedDepartureDateTime = $departureDateTime->format('Y-m-d H:i');
            
                    $arrivalDateTime = new DateTime((string)$leg['ArrivalDateTime']);
                    $formattedArrivalDateTime = $arrivalDateTime->format('Y-m-d H:i');

                    $id = (string)$leg['FlightNumber'];
            
                    //Tworzenie tabeli
                    $flight = [
                        'From' => (string)$leg->DepartureAirport['LocationCode'],
                        'To' => (string)$leg->ArrivalAirport['LocationCode'],
                        'DepartureDateTime' => $formattedDepartureDateTime,
                        'ArrivalDateTime' => $formattedArrivalDateTime,
                        'id' => $id,
                        'price' => rand(55, 1000) // Generowanie losowej ceny
                    ];
                    array_push($flightsArray, $flight);
                }
            }
        
            //przekazanie zmiennych do widoku search.blade.php
            return view('travel.search', [
                'flightsArray' => $flightsArray, 
                'returnFlightsArray' => $returnFlightsArray,
                'FromCode' => $FromCode,
                'ToCode' => $ToCode,
                'rawDate' => $rawDate,
                'rawReturnDate' => $rawReturnDate,
                'Date' => $Date,           // Dodaje sformatowaną datę wylotu
                'ReturnDate' => $ReturnDate // Dodaje sformatowaną datę powrotu
            ]);
            

        //obsługa błędów
        } else {
            return view('travel.search', ['error' => 'Niepoprawny format odpowiedzi XML.']);
        }
    } else {
        return view('travel.search', ['error' => 'Błąd zapytania do API.']);
    }
}

}
    }}}