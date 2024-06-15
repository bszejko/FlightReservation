<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyniki Wyszukiwania Lotów</title>
    @vite('resources/css/app.css')
    <style>
        body {
            .background-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('images/beams-basic.png') }}');
            background-size: cover; /* Adjust the size of the background image */
            background-repeat: no-repeat; /* Prevent the background image from repeating */
            background-position: center center; /* Center the background image */
            z-index: -1; /* Ensure the background is behind other content */
        }
        }
    </style>
</head>
<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-500 text-center pt-8">



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


<header >
@include('components.navbar')
  </nav>
</header>

<div class="background-container"> </div>
    <div class="w-full max-w-7xl mx-auto mt-16 bg-white p-8 rounded-lg shadow-md">
        <div class="flex flex-wrap -mx-3 mb-6 p-8">
            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0 p-8">
                <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Z:</p>
                <p class="text-gray-700">{{ $FromCode }}</p>
            </div>
            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Do:</p>
                <p class="text-gray-700">{{ $ToCode }}</p>
            </div>
            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Data wylotu:</p>
                <p class="text-gray-700">{{ $rawDate }}</p>
            </div>
            <div class="w-full md:w-1/4 px-3">
                <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Data powrotu:</p>
                <p class="text-gray-700">{{ $rawReturnDate }}</p>
            </div>
        </div>
    </div>

    <div class="mt-8 sm:mb-8 sm:flex sm:justify-center mt-12">
        <div class=" mt-8 relative rounded-full px-3 py-1 text-sm leading-6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
          Announcing our next round of funding. <a href="#" class="font-semibold text-indigo-600"><span class="absolute inset-0" aria-hidden="true"></span>Read more <span aria-hidden="true">&rarr;</span></a>
        </div>
    </div>
   
    <div class="max-w-7xl mx-auto mt-8">
        <div class="w-3/5 mx-auto">
            <p class="font-extrabold text-blue-900 text-5xl text-center mb-4 lg:px-8">LOTY W DNIU: {{ htmlspecialchars($rawDate) }}</p>
            @if (!empty($flightsArray) && is_array($flightsArray))
            <ul role="list" class="divide-y divide-gray-100">
                @foreach ($flightsArray as $flight)
                <li class="flex justify-between items-center gap-x-6 py-5 bg-white p-6 rounded-lg shadow mb-4 w-full mx-auto">
                    <div class="flex flex-col items-center">
                        <p class="text-xl font-bold text-gray-900">{{ \Carbon\Carbon::parse($flight['DepartureDateTime'])->format('H:i') }}</p>
                        <svg class="w-6 h-6 text-gray-400 my-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                        <p class="text-xl font-bold text-gray-900">{{ \Carbon\Carbon::parse($flight['ArrivalDateTime'])->format('H:i') }}</p>
                        <div class="flex flex-col items-center">
                        <p class="text-sm text-gray-500">{{ $FromCode }} - {{ $ToCode }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col items-end">
                        <p class="text-xl font-bold text-gray-900">{{ $flight['price'] }}zł</p>
                        <p class="text-sm text-gray-500 mb-2">Numer lotu: {{ $flight['id'] }}</p>
                        <div class="mt-2 flex items-center justify-center gap-x-6">
                            <a href="#" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                               onclick="submitForm('{{ route('booking.create', ['flightId' => $flight['id'],'rawDate'=>$rawDate, 'from' => $FromCode, 'to' => $ToCode, 'departure_time' => $flight['DepartureDateTime'], 'arrival_time' => $flight['ArrivalDateTime'], 'price' => $flight['price']]) }}')">Rezerwuj</a>
                            <a href="#" class="text-sm font-semibold leading-6 text-gray-900">See details <span aria-hidden="true">→</span></a>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
            @else
                <p>Brak dostępnych lotów dla podanych kryteriów.</p>
            @endif
        </div>
        <div class=" mx-auto mt-8">
            <p class="font-extrabold text-blue-900 text-5xl text-center mb-4  lg:px-8">LOTY POWROTNE W DNIU: {{ htmlspecialchars($rawReturnDate) }}</p>
            @if (!empty($returnFlightsArray) && is_array($returnFlightsArray))
            <ul role="list" class="divide-y divide-gray-100">
                @foreach ($returnFlightsArray as $flight)
                <li class="flex justify-between items-center gap-x-6 py-5 bg-white p-6 rounded-lg shadow mb-4 w-full mx-auto">
                    <div class="flex flex-col min-w-0 gap-x-4 items-center">
                        <p class="text-xl font-bold text-gray-900">{{ \Carbon\Carbon::parse($flight['DepartureDateTime'])->format('H:i') }}</p>
                        <svg class="w-6 h-6 text-gray-400 my-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                        <p class="text-xl font-bold text-gray-900">{{ \Carbon\Carbon::parse($flight['ArrivalDateTime'])->format('H:i') }}</p>
                        <p class="text-sm text-gray-500">{{ $ToCode }} - {{ $FromCode }}</p>
                    </div>
                    <div class="flex flex-col items-end">
                        <p class="text-xl font-bold text-gray-900">{{ $flight['price'] }}zł</p>
                        <p class="text-sm text-gray-500 mb-2">Numer lotu: {{ $flight['id'] }}</p>
                        <div class="mt-2 flex items-center justify-center gap-x-6">
                            <a href="#" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                               onclick="submitForm('{{ route('booking.create', ['flightId' => $flight['id'],'rawReturnDate'=>$rawReturnDate, 'from' => $ToCode, 'to' => $FromCode, 'departure_time' => $flight['DepartureDateTime'], 'arrival_time' => $flight['ArrivalDateTime'], 'price' => $flight['price']]) }}')">Rezerwuj</a>
                            <a href="#" class="text-sm font-semibold leading-6 text-gray-900">See details <span aria-hidden="true">→</span></a>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
            @else
                <p>Brak dostępnych lotów dla podanych kryteriów.</p>
            @endif
        </div>
    </div>


<div class="relative top-20 text-gray-700 underline text-sm">
    <p>Masz pytania? Skontaktuj się z nami pod numerem xxxxxxxxx w godzinach 8-16 w dni robocze.</p>
</div>


<script>
    function submitForm(action) {
        const form = document.createElement('form');
        form.method = 'GET';
        form.action = action;

        const csrfToken = '{{ csrf_token() }}';
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = csrfToken;
        form.appendChild(csrfInput);

        document.body.appendChild(form);
        form.submit();
    }
</script>
</div>
</body>
</html>
