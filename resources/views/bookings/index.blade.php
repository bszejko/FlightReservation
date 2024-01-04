{{-- Przykład wyświetlania rezerwacji --}}
@foreach ($userBookings as $booking)
    <div>
        <p>ID Rezerwacji: {{ $booking->flight_id }}</p>
        <p>Data Rezerwacji: {{ $booking->booking_date }}</p>
        <p>Status: {{ $booking->status }}</p>
        <!-- Więcej informacji o rezerwacji -->
    </div>
@endforeach