<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyniki Wyszukiwania Lotów</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Carrois+Gothic&display=swap');
        body {
            background-color: #f6f8f7; 
            text-align: center; 
            padding-top: 60px;
        }
        .flight-result {
            border: 1px solid #d3d3d3; /* szara ramka */
            border-radius: 15px; /* zaokraglone rogi */
            padding: 10px;
            margin: 10px;
            display: inline-block;
            width: 80%
            margin-right: 10px; /* przestrzen pomiedzy buttonem a tekstem */
            background-color: white;
        }
        .book-button {
            background-color: #215797; 
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 12px; /* rounded corners for button */
        }
        ul {
        list-style-type: none; /* removes bullets */
        padding: 0;
    }

    .result-container {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
    }
    header {
            width: 100%;
            background-color: #215797;
            padding: 10px 0;
            position: fixed;
            top: 0;
            z-index: 2;
        }
        nav {
            display: flex;
            justify-content: flex-end;
            width: 100%;
            max-width: 1300px;
            margin: 0 auto;
            padding-right: 20px;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-family: 'Carrois Gothic', sans-serif;
            font-size: 16px;
            margin-left: 50px;
            transition: color 0.3s ease;}

        .centered-header {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .centered-header img {
        height: 20px;
        width: 20px;
        margin-left: 10px; /* Adjusts space between text and image */
        margin-right: 10px; /* Adjusts space between image and text */
    }
    .date-label {
        font-weight: bold; /* Makes text bold */
        color: #215797; /* Color matching the button's background */
    }
    .flights-container {
    display: flex;
    justify-content: space-around;
}

.flights-column {
    width: 45%; /* Dostosuj szerokość według potrzeb */
}


    </style>
</head>
<body>


<!-- Jeżeli sesja się powiedzie, czyli użytkownik z sukcesem zarezerwuje lot, to na stronie zwracane jest to powiadomienie -->
@if(session('success'))
    <div id="successMessage" style="position: fixed; top: 100px; right: 10px; background-color: green; color: white; padding: 10px; border-radius: 5px;">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(function() {
            document.getElementById('successMessage').style.display = 'none';
        }, 3000); // Powiadomienie zniknie po 3 sekundach
    </script>
@endif


  
  
  <!-- menu -->
<header>
@include('components.navbar')  {{-- Dołączenie navbara --}}
</header>

    <h2 class="centered-header">
    <?php echo htmlspecialchars($FromCode); ?>
    <img src="/images/flight-icon.png" alt="Flight Icon" style="height: 20px; width: 20px;">
    <?php echo htmlspecialchars($ToCode); ?>
</h2>


<div class="flights-container">
<div class="flights-column">
<p style="color: #215797; font-size: 20px; text-align: center;">Loty w dniu: <?php echo htmlspecialchars($rawDate); ?></p>

<?php if (!empty($flightsArray) && is_array($flightsArray)): ?>
    <div>
        
    <?php foreach ($flightsArray as $flight): ?>
        <div class="result-container">
            <div class="flight-result">
            <span class="date-label">Data wylotu:</span> <?php echo $flight['DepartureDateTime']; ?>, 
            <span class="date-label">Data lądowania:</span> <?php echo $flight['ArrivalDateTime']; ?>
            <span class="date-label">Numer lotu:</span> <?php echo $flight['id']; ?>
            
            </div>
            <form action="{{ route('booking.create', ['flightId' => $flight['id'], 'from' => $FromCode, 'to' => $ToCode, 'departure_time' => $flight['DepartureDateTime'], 'arrival_time' => $flight['ArrivalDateTime']]) }}" method="GET">
            @csrf
            <input type="hidden" name="from" value="{{$FromCode}}">
            <input type="hidden" name="to" value="{{$ToCode}}">
            <input type="hidden" name="departure_time" value="{{ $flight['DepartureDateTime'] }}">
            <input type="hidden" name="arrival_time" value="{{ $flight['ArrivalDateTime'] }}">
            <input type="hidden" name="flightId" value="{{ $flight['id'] }}">
            <button type="submit" class="book-button">Rezerwuj</button>
        </form>
        </div>
    </li>
<?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Brak dostępnych lotów dla podanych kryteriów.</p>

<?php endif; ?>
</div>

<div class="flights-column">
<p style="color: #215797; font-size: 20px; text-align: center;">Loty powrotne w dniu: <?php echo htmlspecialchars($rawReturnDate); ?></p>
    <!-- Wyświetlanie lotów powrotnych -->
    <?php if (!empty($returnFlightsArray) && is_array($returnFlightsArray)): ?>
       <div>
        
    <?php foreach ($returnFlightsArray as $flight): ?>
        <div class="result-container">
            <div class="flight-result">
            <span class="date-label">Data wylotu:</span> <?php echo $flight['DepartureDateTime']; ?>, 
            <span class="date-label">Data lądowania:</span> <?php echo $flight['ArrivalDateTime']; ?>
            <span class="date-label">Numer lotu:</span> <?php echo $flight['id']; ?>
            </div>
            <form action="{{ route('booking.create', ['flightId' => $flight['id'], 'from' => $FromCode, 'to' => $ToCode, 'departure_time' => $flight['DepartureDateTime'], 'arrival_time' => $flight['ArrivalDateTime']]) }}" method="GET">
            @csrf
            <input type="hidden" name="departureAirport" value="{{$FromCode}}">
            <input type="hidden" name="arrivalAirport" value="{{$ToCode}}">
            <input type="hidden" name="departureDateTime" value="{{ $flight['DepartureDateTime'] }}">
            <input type="hidden" name="arrivalDateTime" value="{{ $flight['ArrivalDateTime'] }}">
            <input type="hidden" name="flightId" value="{{ $flight['id'] }}">
            <button type="submit" class="book-button">Rezerwuj</button>
        </form>
        </div>
    </li>
<?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Brak dostępnych lotów dla podanych kryteriów.</p>
<?php endif; ?>
</div>
</div>
</body>
</html>
