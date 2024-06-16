<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wybierz Miejsce Podróży</title>
    @vite('resources/css/app.css')
    <style>
@import url('https://fonts.googleapis.com/css2?family=Rethink+Sans:wght@500;700&display=swap');
</style>
    
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            font-family:'Rethink Sans', sans-serif;
            background-image: url('images/lot3.webp');
            background-size: cover;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('images/lot3.webp');
            background-size: cover;
            filter: brightness(0.5);
            transition: transform 20s ease-in-out;
        }

        body:hover::before {
            transform: scale(1.5); /* Przybliżenie o 20% */
            filter: brightness(0.5);
        }


        header {
            width: 100%;
            background-color: rgba(0, 0, 0, 0.3);
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
            font-family: 'Rethink Sans', sans-serif;
            font-size: 16px;
            margin-left: 50px;
            transition: color 0.3s ease;
        }

        h2,
        form {
            position: relative;
            z-index: 1;
            margin-top: 50px;
            text-align: center;
        }

        h2 {
            font-family: 'Rethink Sans', sans-serif;
            font-size: 36px;
            margin-bottom: 20px;
            color: #fff;
        }

        .forms-container {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            gap: 20px;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        form {
            display: flex;
            flex-direction: row;
            align-items: center;
            width: 100%;
            max-width: 400px;
            margin: 20px;
            padding: 20px;
            border-radius: 0px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            width: 100%;
            margin-bottom: 20px;
            border-radius: 0;
        }

        label {
            margin-bottom: 10px;
            font-family: 'Carrois Gothic', sans-serif;
            font-size: 16px;
            color: #fff;
        }

        input,
        select {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.5s ease;
            font-family: 'Calibri Light', sans-serif;
            color: #333;
        }

        input:hover,
        select:hover {
            border-color: #666;
        }

        input::placeholder {
            color: #999;
        }

        button {
            width: 100%;
            padding: 12px 24px;
            font-size: 16px;
            cursor: pointer;
            background-color: #4f46e5;
            color: #fff;
            border: none;
            border-radius: 1px;
            transition: background-color 0.3s ease, color 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4f46e5;
            
        }

        button:hover {
            background-color: #4f46e5;
            color: #4f46e5;
        }
        

    </style>
</head>

<body>

<header>
@include('components.navbar', ['textColor' => 'text-white'])
    </header>

    <!-- Formularz wybierania lotnisk i dat -->
    <div class="container-text">
        <div class="font-extrabold">
    <h2 class="animatedtext">ODKRYJ ŚWIAT JEDNYM KLIKNIĘCIEM</h2>
    </div>
    </div>
    <p style="color: white; font-size: 10px; text-align: center;">Rezerwuj najtańsze loty - szybko, tanio, prosto</p>
    <div class="forms-container" style="margin-top: 50px;">
        <form id="flightForm" action="{{ route('search.flights') }}" method="post">
            @csrf
            <div class="form-group">
                <input type="text" name="departureCountry" id="departureCountry" placeholder="Kod lotniska wylotu" required>
            </div>
            <div class="form-group">
                <input type="text" name="arrivalCountry" id="arrivalCountry" placeholder="Kod lotniska przylotu" required>
              
            </div>
            <div class="form-group">
                <input type="text" name="dateRange" id="dateRange" required 
                       onfocus="(this.type='date')" onblur="(this.type='text')" 
                       value="" placeholder="Data wylotu" 
                       onchange="this.setAttribute('value', this.value);">
            </div>
            <div class="form-group">
                <input type="text" name="dateRange2" id="dateRange2" required 
                       onfocus="(this.type='date')" onblur="(this.type='text')" 
                       value="" placeholder="Data powrotu" 
                       onchange="this.setAttribute('value', this.value);">
            </div>
            <button type="submit" class="search-icon" style="margin-bottom: 20px;">
        <img src="/images/lupa.png" alt="Search" style="max-width: 20px; max-height: 20px;">
            </button>

           
        </form>
    </div>

    <script>
    document.getElementById('flightForm').addEventListener('submit', function(event) {
        // Walidacja kodu IATA
        var departureCountry = document.getElementById('departureCountry').value;
        var arrivalCountry = document.getElementById('arrivalCountry').value;
        if (departureCountry.length !== 3 || arrivalCountry.length !== 3) {
            alert('Kody IATA muszą mieć dokładnie 3 litery.');
            event.preventDefault(); // Zapobiegaj wysłaniu formularza
            return;
        }

        // Walidacja dat
        var departureDate = new Date(document.getElementById('dateRange').value);
        var returnDate = new Date(document.getElementById('dateRange2').value);
        if (returnDate <= departureDate) {
            alert('Data powrotu musi być późniejsza niż data wylotu.');
            event.preventDefault(); // Zapobiegaj wysłaniu formularza
        }
    });
</script>

</body>