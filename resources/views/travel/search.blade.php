<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyniki Wyszukiwania Lotów</title>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rethink+Sans:ital,wght@0,400;0,500;0,700;1,500&display=swap');

        body {
            background-color: #f6f8f7; 
            text-align: center; 
            padding-top: 30px;
        }
        section {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        min-height: 200px;
        padding-top: 50px;
      }
        .white{
        background:white;
      }
        .flight-result {
            border: 1px solid #d3d3d3; /* szara ramka */
            border-radius: 15px; /* zaokraglone rogi */
            padding: 10px;
            margin: 10px;
            display: inline-block;
            width: 100%
            margin-right: 30px; /* przestrzen pomiedzy buttonem a tekstem */
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
            font-family: 'Rethink Sans', sans-serif;
            margin-left: 10px;
        }
        ul {
        list-style-type: none; /* removes bullets */
        padding: 0;
        }

        .result-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
        margin-right: 30px;
        font-family: 'Rethink Sans', sans-serif;
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
            font-size:33px;
            font-family: 'Rethink Sans', sans-serif;
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
            font-family: 'Rethink Sans', sans-serif;
        }
        .flights-container {
            display: flex;
            justify-content: space-around;
        }

        .flights-column {
            width: 45%; /* Dostosuj szerokość według potrzeb */
        }
        .price {
        display: inline-block;
        font-weight: bold; 
        font-family: 'Rethink Sans', sans-serif;
        font-size: 16px;
        color:#215797; 
}

        .custom-shape-divider-top-1704471296 {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }

        .custom-shape-divider-top-1704471296 svg {
            position: relative;
            display: block;
            width: calc(124% + 1.3px);
            height: 254px;
        }

        .custom-shape-divider-top-1704471296 .shape-fill {
            fill: #f6f8f7;
        }
        .custom-shape-divider-top-1704473672 {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }

        .custom-shape-divider-top-1704473672 svg {
            position: relative;
            display: block;
            width: calc(124% + 1.3px);
            height: 92px;
        }

        .custom-shape-divider-top-1704473672 .shape-fill {
            fill: #215797;
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

<section>
    <h2 class="centered-header">
    <?php echo htmlspecialchars($FromCode); ?>
    <img src="/images/flight-icon.png" alt="Flight Icon" style="height: 20px; width: 20px;">
    <?php echo htmlspecialchars($ToCode); ?>
</h2>


<div class="flights-container">
<div class="flights-column">
<p style="font-weight: bold; font-family: 'Rethink Sans', sans-serif; color: #215797; font-size: 25px; text-align: center;">LOTY W DNIU: <?php echo htmlspecialchars($rawDate); ?></p>

<?php if (!empty($flightsArray) && is_array($flightsArray)): ?>
    <div>
        
    <?php foreach ($flightsArray as $flight): ?>
        <div class="result-container">
            <div class="flight-result">
            <span class="date-label">Data wylotu:</span> <?php echo $flight['DepartureDateTime']; ?>, 
            <span class="date-label">Data lądowania:</span> <?php echo $flight['ArrivalDateTime']; ?>
            <span class="date-label">Numer lotu:</span> <?php echo $flight['id']; ?>
            
            </div>
            <div class="price"><?php echo $flight['price']; ?>zł</div> <!-- Cena z bazy danych -->
            <form action="{{ route('booking.create', ['flightId' => $flight['id'], 'from' => $ToCode, 'to' => $FromCode, 'departure_time' => $flight['DepartureDateTime'], 'arrival_time' => $flight['ArrivalDateTime'], 'price' => $flight['price']]) }}" method="GET">
            @csrf
            <input type="hidden" name="from" value="{{$FromCode}}">
            <input type="hidden" name="to" value="{{$ToCode}}">
            <input type="hidden" name="departure_time" value="{{ $flight['DepartureDateTime'] }}">
            <input type="hidden" name="arrival_time" value="{{ $flight['ArrivalDateTime'] }}">
            <input type="hidden" name="flightId" value="{{ $flight['id'] }}">
            <input type="hidden" name="price" value="{{ $flight['price'] }}">
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
<p style="font-weight: bold; font-family: 'Rethink Sans', sans-serif; color: #215797; font-size: 25px; text-align: center;">LOTY POWROTNE W DNIU: <?php echo htmlspecialchars($rawReturnDate); ?></p>
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
            <div class="price"><?php echo $flight['price']; ?>zł</div> <!-- Cena z bazy danych -->
            <form action="{{ route('booking.create', ['flightId' => $flight['id'], 'from' => $ToCode, 'to' => $FromCode, 'departure_time' => $flight['DepartureDateTime'], 'arrival_time' => $flight['ArrivalDateTime'], 'price' => $flight['price']]) }}" method="GET">
            @csrf
            <input type="hidden" name="from" value="{{$ToCode}}">
            <input type="hidden" name="to" value="{{$FromCode}}">
            <input type="hidden" name="departure_time" value="{{ $flight['DepartureDateTime'] }}">
            <input type="hidden" name="arrival_time" value="{{ $flight['ArrivalDateTime'] }}">
            <input type="hidden" name="flightId" value="{{ $flight['id'] }}">
            <input type="hidden" name="price" value="{{ $flight['price'] }}">
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
<div class="custom-shape-divider-top-1704473672">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
    </svg>
</div>
</section>
<section class="white">

<div>
<p style="position: relative; top: 85px; text-decoration: underline; font-size: small; color: #4B5563; margin-right: 50px;focus:outline-none; focus:ring-2; focus:ring-offset-2; focus:ring-indigo-500">
Masz pytania? Skontaktuj się z nami pod numerem xxxxxxxxx w godzinach 8-16 w dni robocze.
</p>
</div>
<div class="custom-shape-divider-top-1704471296">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
    </svg>
</div>
</section>
</body>
</html>
