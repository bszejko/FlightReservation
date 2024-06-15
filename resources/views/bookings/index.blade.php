<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>Rezerwacje</title>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rethink+Sans:ital,wght@0,400;0,500;0,700;1,500&display=swap');
    body {
        background-color: #f6f8f7; 
        text-align: center; 
        padding-top: 60px;
    }
    header {
        width: 100%;
        background-color: #215797;
        padding: 10px 0;
        position: fixed;
        top: 0;
        z-index: 2;
    }

    .status-zarezerwowany {
    color: green; 
    
    }

    .booking-container {
        display: flex; 
        justify-content: center; 
        margin: 20px auto; 
        background-color: white; 
        border-radius: 10px; 
        border: 1px solid #d3d3d3; 
        padding: 10px; 
        width: 80%; 
        max-width: 1200px; 
    }
    .booking-info {
        margin: 0 10px;
        font-family: 'Rethink Sans', sans-serif;
        font-weight: 400;
        font-size: 21px;
        border-right: 1px solid #d3d3d3;
        padding: 0 10px;
        display: flex; 
        align-items: center; 
    }

    .booking-info:last-child {
        border-right: none;
    }

    .status-zarezerwowany {
        color: green;
        margin-right: 10px; 
    }
    .cancel-button {
        border: none; 
        background: none; 
        cursor: pointer; 
    }

    .cancel-button img {
        height: 20px; 
        width: 20px; 
    }
    .total-price-container{
        font-family: 'Rethink Sans', sans-serif;
        font-size:30px;
        color: #808080;
        text-align: right; 
        padding-right: 20px; 
        margin-top: 20px; 
        float:right;
    }
    #confirmCancel, #denyCancel {
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
        border-radius: 12px;
        font-family: 'Rethink Sans', sans-serif;
    }

    /* Styl dla okna dialogowego */
    #confirmationModal p {
        font-family: 'Rethink Sans', sans-serif;
        font-size: 18px; 
        color: #333; 
        text-align: center;
        margin-bottom: 20px;
    }
    div#dymekContainer {
        position: fixed; 
        bottom: 20px; 
        right: 20px; 
        z-index: 1001; 
    }

    #dymek {
        height: 40px;
        width: 40px;
        cursor: pointer;
        z-index: 1001; 
    }

        /* Styl dla tekstu "Napisz do nas!" */
        #dymek + p {
            font-family: 'Rethink Sans', sans-serif; 
            font-size: 16px; 
            z-index:10;
        }
        #contactForm {
            display: none;
            position: absolute;
            bottom: 0;
            right: 0;
            background-color: white;
            padding: 20px;
            border-radius: 15px; 
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
            width: 300px; 
            font-family: 'Rethink Sans', sans-serif; 
            z-index:10;
        }

        /* Styl dla przycisków wewnątrz formularza */
        #contactForm .question-button {
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
            border-radius: 12px;
            font-family: 'Rethink Sans', sans-serif;
            right: 50px;
            z-index:10;
        }
        #contactForm {
        display: none;
        position: fixed;
        bottom: 20px;
        right: 50px; 
        background-color: white;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 0 10px rgba(0,0,0,0.5);
        width: 300px;
        font-family: 'Rethink Sans', sans-serif;
        z-index:10;
    }

    /* Styl dla elementów wewnątrz formularza */
    #contactForm input[type="text"],
    #contactForm textarea,
    #contactForm button {
        width: calc(100% - 40px); 
        margin: 10px 0;
        padding: 10px; 
        z-index:10;
    }

    #contactForm textarea {
        height: 100px;
        z-index:10;
    }
    .custom-shape-divider-top-1704570931 {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
    z-index:1;
}

.custom-shape-divider-top-1704570931 svg {
    position: relative;
    display: block;
    width: calc(130% + 1.3px);
    height: 259px;
    z-index:1;
}

.custom-shape-divider-top-1704570931 .shape-fill {
    fill: #f6f8f7;
}
section {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        min-height: 400px;
        padding-top: 100px;
      }
.white{
    background:white;
}


    </style>
</head>
<body>

<header>
@include('components.navbar')  {{-- Dołączenie navbara --}}
    </header>

<section>
@foreach ($userBookings as $booking)
    <div class="booking-container">
        <span class="booking-info">ID Rezerwacji: {{ $booking->id }}</span>
        <span class="booking-info">ID Lotu: {{ $booking->flight_id }}</span>
        <span class="booking-info">Z: {{ $booking->flight->from }}</span>
        <span class="booking-info">Do: {{ $booking->flight->to }}</span>
        <span class="booking-info">Data: {{ $booking->flight->departure_time }}</span>
        <span class="booking-info">Cena: {{ $booking->flight->price }} zł</span>
        <span class="booking-info">
            Status: 
            @if ($booking->status == 'zarezerwowany')
                <span class="status-zarezerwowany">{{ $booking->status }}</span>
            @else
                {{ $booking->status }}
            @endif
        </span>
        <span class="booking-info">
                <button class="cancel-button" data-booking-id="{{ $booking->id }}">
                    <img src="/images/anuluj.png" alt="Anuluj">
                </button>
            </span>
    </div>
@endforeach

<div class="total-price-container">
    <h3>Łączna suma: {{ $totalPrice }} zł</h3>
</div>

</section>
<div id="confirmationModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); z-index:1000; background:white; padding:20px; border-radius:5px; box-shadow:0 0 10px rgba(0,0,0,0.5);">
    <p>Jesteś pewny, że chcesz odwołać rezerwację?</p>
    <button id="confirmCancel">Potwierdź</button>
    <button id="denyCancel">Anuluj</button>
</div>

<script>
    let selectedBookingId = null;

    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('confirmationModal');
        const confirmBtn = document.getElementById('confirmCancel');
        const denyBtn = document.getElementById('denyCancel');

        document.querySelectorAll('.cancel-button').forEach(function(button) {
            button.addEventListener('click', function() {
                selectedBookingId = this.dataset.bookingId;
                modal.style.display = 'block';
            });
        });

        confirmBtn.addEventListener('click', function() {
            if (selectedBookingId) {
                fetch(`/booking/cancel/${selectedBookingId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Problem z anulowaniem rezerwacji');
                    }
                    return response.json();
                })
                .then(data => {
                    alert(data.success);
                    location.reload();
                })
                .catch(error => {
                    alert(error.message);
                });
            }
            modal.style.display = 'none';
        });

        denyBtn.addEventListener('click', function() {
            modal.style.display = 'none';
        });
        
    });
</script>
<section class="white">
<!-- W prawym dolnym rogu strony -->
<div id="dymekContainer">
<div style="position: fixed; bottom: 20px; right: 20px; cursor: pointer;">
    <img src="/images/chat.png" alt="Napisz do nas!" id="dymek">
    <p>Napisz do nas!</p>
</div>
    <div id="contactForm" style="display: none; position: absolute; bottom: 0; right: 0; background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.5);">
    <form id="questionForm">
    <label for="bookingId">ID Rezerwacji:</label><br>
    <input type="text" id="bookingId" name="bookingId"><br>
    <label for="message">Wiadomość:</label><br>
    <textarea id="message" name="message"></textarea><br>
    <button type="submit" class="question-button">Wyślij</button>
    <button type="button" class="question-button" id="cancelQuestion">Anuluj</button>
</form>

    </div>
</div>
<div class="custom-shape-divider-top-1704570931">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
    </svg>
</div>
</section>

    <script>
    document.getElementById('dymek').addEventListener('click', function() {
        document.getElementById('contactForm').style.display = 'block';
    });

    document.getElementById('cancelQuestion').addEventListener('click', function() {
        document.getElementById('contactForm').style.display = 'none';
    });

    document.getElementById('questionForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const bookingId = document.getElementById('bookingId').value;
    const message = document.getElementById('message').value;

    fetch('/question', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ bookingId, message })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.success);
        document.getElementById('contactForm').style.display = 'none';
        document.getElementById('questionForm').reset();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Wystąpił błąd');
    });
});

</script>



</body>
</html>
