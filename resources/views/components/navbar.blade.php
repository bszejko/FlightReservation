<!-- Plik: resources/views/components/navbar.blade.php -->


<style>


@import url('https://fonts.googleapis.com/css2?family=Rethink+Sans:wght@400;500;700&display=swap');
</style>
<style>
   
    nav {
        display: flex;
        align-items: center;
        justify-content: space-between; /* Zmieniono na space-between */
        width: 100%;
        max-width: 1300px;
        margin: 0 auto;
        padding: 0 20px;
    }

    nav img {
        /* Styl dla logo, jeśli potrzebny */
    }

    .nav-links {
        display: flex;
        align-items: center;
    }

    .nav-links a {
        color: white;
        text-decoration: none;
        font-family: 'Rethink Sans', sans-serif;
        font-size: 16px;
        margin-left: 50px;
        transition: color 0.3s ease;
    }
    nav a {
            color: white;
            text-decoration: none;
            font-family: 'Rethink Sans', sans-serif;
            font-size: 16px;
            margin-left: 50px;
            transition: color 0.3s ease;}/* style dla linków w navbarze */

    /* Możesz dodać więcej stylów tutaj */
</style>
    
    


<nav>
    <img src="/images/logo.png" alt="Logo" style="height: 25px;">
    <div class="nav-links">
        <a href="{{ route('travel') }}">Wyszukaj loty</a>
        @if(auth()->check())
            <a href="{{ route('bookings.index') }}">Rezerwacje</a>
            <a href="{{ route('dashboard') }}">Moje konto</a> 
        @else
            <a href="{{ route('login', ['previous' => url()->current()]) }}">Zaloguj się</a>
            
        @endif
    </div>
</nav>

