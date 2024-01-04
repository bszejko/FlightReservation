<!-- Plik: resources/views/components/navbar.blade.php -->


<style>
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
            transition: color 0.3s ease;}/* style dla linków w navbarze */
    
</style>

<nav>
    <a href="{{ route('travel') }}">Rezerwuj loty</a>
    @if(auth()->check())
        <a href="{{ route('bookings.index') }}">Rezerwacje</a>
    @else
        <a href="{{ route('login') }}">Zaloguj się</a>
    @endif
</nav>
