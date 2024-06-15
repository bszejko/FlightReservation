<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyniki Wyszukiwania Lotów</title>
    @vite('resources/css/app.css')
    <style>
        
        
    </style>
</head>
<body class="bg-gray-50 text-center pt-8">

@if(session('success'))
    <div id="successMessage" class="fixed top-24 right-2 bg-green-500 text-white p-2 rounded-md">
        {{ session('success') }}
    </div>
    <script>
        setTimeout(function() {
            document.getElementById('successMessage').style.display = 'none';
        }, 3000);
    </script>
@endif

<header class="w-full bg-blue-900 py-2 fixed top-0 z-20">
    @include('components.navbar')
</header>

<section class="relative flex flex-col items-center min-h-[200px] pt-12">
    <h2 class="flex justify-center items-center text-3xl font-bold mt-16">
        @isset($FromCode) {{ htmlspecialchars($FromCode) }} @endisset
        <img src="/images/flight-icon.png" alt="Flight Icon" class="h-5 w-5 mx-2">
        @isset($ToCode) {{ htmlspecialchars($ToCode) }} @endisset
    </h2>

    <div class="flex justify-around w-full mt-8">
        <div class="w-2/5">
            <p class="font-bold text-blue-900 text-2xl text-center mb-4">LOTY W DNIU: {{ htmlspecialchars($rawDate) }}</p>
            @if (!empty($flightsArray) && is_array($flightsArray))
                @foreach ($flightsArray as $flight)
                    <div class="flex justify-between items-center border border-gray-300 rounded-lg p-4 mb-4 bg-white">
                        <div>
                            <p class="font-bold text-blue-900">Data wylotu: <span class="font-normal text-black">{{ $flight['DepartureDateTime'] }}</span></p>
                            <p class="font-bold text-blue-900">Data lądowania: <span class="font-normal text-black">{{ $flight['ArrivalDateTime'] }}</span></p>
                            <p class="font-bold text-blue-900">Numer lotu: <span class="font-normal text-black">{{ $flight['id'] }}</span></p>
                        </div>
                        <div class="text-blue-900 font-bold">{{ $flight['price'] }}zł</div>
                        <form action="{{ route('booking.create', ['flightId' => $flight['id'],'rawDate'=>$rawDate, 'from' => $ToCode, 'to' => $FromCode, 'departure_time' => $flight['DepartureDateTime'], 'arrival_time' => $flight['ArrivalDateTime'], 'price' => $flight['price']]) }}" method="GET">
                            @csrf
                            <input type="hidden" name="from" value="{{$FromCode}}">
                            <input type="hidden" name="to" value="{{$ToCode}}">
                            <input type="hidden" name="departure_time" value="{{ $flight['DepartureDateTime'] }}">
                            <input type="hidden" name="arrival_time" value="{{ $flight['ArrivalDateTime'] }}">
                            <input type="hidden" name="flightId" value="{{ $flight['id'] }}">
                            <input type="hidden" name="price" value="{{ $flight['price'] }}">
                            <input type="hidden" name="rawDate" value="{{ $rawDate }}">
                            <button type="submit" class="bg-blue-900 text-white py-2 px-4 rounded-lg">Rezerwuj</button>
                        </form>
                    </div>
                @endforeach
            @else
                <p>Brak dostępnych lotów dla podanych kryteriów.</p>
            @endif
        </div>
        <div class="w-2/5">
            <p class="font-bold text-blue-900 text-2xl text-center mb-4">LOTY POWROTNE W DNIU: {{ htmlspecialchars($rawReturnDate) }}</p>
            @if (!empty($returnFlightsArray) && is_array($returnFlightsArray))
                @foreach ($returnFlightsArray as $flight)
                    <div class="flex justify-between items-center border border-gray-300 rounded-lg p-4 mb-4 bg-white">
                        <div>
                            <p class="font-bold text-blue-900">Data wylotu: <span class="font-normal text-black">{{ $flight['DepartureDateTime'] }}</span></p>
                            <p class="font-bold text-blue-900">Data lądowania: <span class="font-normal text-black">{{ $flight['ArrivalDateTime'] }}</span></p>
                            <p class="font-bold text-blue-900">Numer lotu: <span class="font-normal text-black">{{ $flight['id'] }}</span></p>
                        </div>
                        <div class="text-blue-900 font-bold">{{ $flight['price'] }}zł</div>
                        <form action="{{ route('booking.create', ['flightId' => $flight['id'],'rawReturnDate'=>$rawReturnDate, 'from' => $ToCode, 'to' => $FromCode, 'departure_time' => $flight['DepartureDateTime'], 'arrival_time' => $flight['ArrivalDateTime'], 'price' => $flight['price']]) }}" method="GET">
                            @csrf
                            <input type="hidden" name="from" value="{{$ToCode}}">
                            <input type="hidden" name="to" value="{{$FromCode}}">
                            <input type="hidden" name="departure_time" value="{{ $flight['DepartureDateTime'] }}">
                            <input type="hidden" name="arrival_time" value="{{ $flight['ArrivalDateTime'] }}">
                            <input type="hidden" name="flightId" value="{{ $flight['id'] }}">
                            <input type="hidden" name="price" value="{{ $flight['price'] }}">
                            <input type="hidden" name="rawReturnDate" value="{{ $rawReturnDate }}">
                            <button type="submit" class="bg-blue-900 text-white py-2 px-4 rounded-lg">Rezerwuj</button>
                        </form>
                    </div>
                @endforeach
            @else
                <p>Brak dostępnych lotów dla podanych kryteriów.</p>
            @endif
        </div>
    </div>

    <div class="custom-shape-divider-top-1704473672 w-full">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill fill-gray-50"></path>
        </svg>
    </div>
</section>

    <div class="relative top-20 text-gray-700 underline text-sm">
        <p>Masz pytania? Skontaktuj się z nami pod numerem xxxxxxxxx w godzinach 8-16 w dni robocze.</p>
    </div>
   
</body>
</html>
