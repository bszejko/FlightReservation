
<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://fonts.googleapis.com/css2?family=Rethink+Sans:wght@500&display=swap" rel="stylesheet">


    
    <title>Twoja rezerwacja</title>
    
    <style>
    body {
        margin: 0;
        font-family: 'Rethink Sans', sans-serif;
        color: white;
        background: #f6f8f7;
        overflow-x: hidden;
      }

      section {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        min-height: 400px;
        padding-top: 100px;
      }
        header {
            width: 100%;
            background-color: #215797;
            padding: 10px 0;
            position: fixed;
            top: 0;
            z-index: 2;
        }
        
      .blue {
        background: #215797;
      }
      .btn{
        border: 1px solid #3498db;
        background: none;
        padding: 10px 20px;
        font-size: 20px;
        font-family: "montserrat";
        cursor: pointer;
        margin: 10px;
        transition: 0.8s;
        position: relative;
        overflow: hidden;
  
        }
        .btn1{
        color: #215797;
        }
        .btn1:hover{
        color: #fff;
        }
        .btn::before{
        content: "";
        position: absolute;
        left: 0;
        width: 100%;
        height: 0%;
        background: #215797;
        z-index: -1;
        transition: 0.8s;
        }
        .btn1::before{
        top: 0;
        border-radius: 0 0 50% 50%;
        }
        .btn1:hover::before{
        height: 180%;
        }
        .custom-shape-divider-top-1704405099 {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }

        .custom-shape-divider-top-1704405099 svg {
            position: relative;
            display: block;
            width: calc(124% + 1.3px);
            height: 107px;
        }

        .custom-shape-divider-top-1704405099 .shape-fill {
            fill: #215797;
        }

    </style>
</head>
<body>
<header>
@include('components.navbar')  {{-- Dołączenie navbara --}}
    </header>
<!-- Informacje o locie który jest rezerwowany -->
<section class=blue>
    <h1>TWOJA REZERWACJA</h1>
    
    <p>Z: {{ $flightDetails['from'] }}</p>
        <p>Do: {{ $flightDetails['to'] }}</p>
        <p>Data i godzina odlotu: {{ $flightDetails['departure_time'] }}</p>
        <p>Data i godzina przylotu: {{ $flightDetails['arrival_time']  }}</p>
        <p>Cena: {{ $flightDetails['price'] }}</p>

        
    
    </section>
<!-- Zmienne ukryte - są już dostępne w kodzie, przekazuje je do flights.store -->
<section>
    <form action="{{ route('flights.store') }}" method="POST">
        @csrf
        <input type="hidden" name="from" value="{{ $flightDetails['from'] }}">
        <input type="hidden" name="to" value="{{ $flightDetails['to'] }}">
        <input type="hidden" name="departure_time" value="{{ $flightDetails['departure_time'] }}">
        <input type="hidden" name="arrival_time" value="{{ $flightDetails['arrival_time'] }}">
        <input type="hidden" name="price" value="{{ $flightDetails['price'] }}">
        <input type="hidden" name="rawDate" value="{{ request('rawDate') }}">
        <input type="hidden" name="rawReturnDate" value="{{ request('rawReturnDate') }}">

        <button class="btn btn1"  type="submit">Potwierdź rezerwację</button>
    </form>

    <div class="custom-shape-divider-top-1704405099">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
    </svg>
</div>
    </section>
    
    
</body>
</html>
