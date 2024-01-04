
<!-- Informacje o locie który jest rezerwowany -->
<h1>Rezerwacja Lotu</h1>
<div>
<p>From: {{ $flightDetails['from'] }}</p>
    <p>To: {{ $flightDetails['to'] }}</p>
    <p>Data i godzina odlotu: {{ $flightDetails['departure_time'] }}</p>
    <p>Data i godzina przylotu: {{ $flightDetails['arrival_time']  }}</p>

</div>
<!-- Zmienne ukryte - są już dostępne w kodzie, przekazuje je do flights.store -->
<form action="{{ route('flights.store') }}" method="POST">
    @csrf
    <input type="hidden" name="from" value="{{ $flightDetails['from'] }}">
    <input type="hidden" name="to" value="{{ $flightDetails['to'] }}">
    <input type="hidden" name="departure_time" value="{{ $flightDetails['departure_time'] }}">
    <input type="hidden" name="arrival_time" value="{{ $flightDetails['arrival_time'] }}">
    <button type="submit">Potwierdź rezerwację</button>
</form>

