@props(['textColor' => 'text-gray-900', 'backgroundImage' => ''])

<style>
@import url('https://fonts.googleapis.com/css2?family=Rethink+Sans:wght@400;500;700&display=swap');
</style>

<nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global" style="background-image: url('{{ $backgroundImage }}'); background-size: cover; background-position: center;">
    <div class="lg:flex lg:gap-x-20">
        <a href="{{ route('travel') }}" class="text-lg font-semibold leading-6 {{ $textColor }}">Search flights</a>
    </div>
    <div class="lg:flex lg:flex-1 lg:justify-end text-lg">
        @if(auth()->check())
            <a href="{{ route('bookings.index') }}" class="{{ $textColor }}">Reservations</a>
            <a href="{{ route('dashboard') }}" class="{{ $textColor }}">My account</a> 
        @else
            <a href="{{ route('login', ['previous' => url()->current()]) }}" class="text-lg font-semibold leading-6 {{ $textColor }}">Log in <span aria-hidden="true">&rarr;</span></a>
        @endif
    </div>
</nav>
