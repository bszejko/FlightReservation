<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wybierz Miejsce Podróży</title>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Carrois+Gothic&display=swap');
    </style>
    
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Roboto', sans-serif;
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
            filter: brightness(0.6);
            transition: transform 10s ease-in-out;
        }

        body:hover::before {
            transform: scale(1.5); /* Przybliżenie o 20% */
            filter: brightness(0.6);
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
            color: #fff;
            text-decoration: none;
            font-family: 'Carrois Gothic', sans-serif;
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
            font-family: 'Carrois Gothic', sans-serif;
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
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 1px;
            transition: background-color 0.3s ease, color 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            
        }

        button:hover {
            background-color: #2980b9;
            color: #fff;
        }
    </style>
</head>

<body>

    <header>
        <!-- menu -->
    <nav>
        <a href="{{ route('travel') }}">Wyszukaj loty</a>
        
        <a href="{{ route('login') }}">Zaloguj się</a>
      
        </nav>
    </header>

    <!-- Formularz wybierania lotnisk i dat -->
    <h2>ODKRYJ ŚWIAT JEDNYM KLIKNIĘCIEM</h2>
    <p style="color: white; font-size: 10px; text-align: center;">Rezerwuj najtańsze loty - szybko, tanio, prosto</p>
    <div class="forms-container" style="margin-top: 50px;">
        <form action="{{ route('search.flights') }}" method="post">
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
</body>