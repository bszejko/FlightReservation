<!-- Plik: resources/views/components/navbar.blade.php -->


<style>


@import url('https://fonts.googleapis.com/css2?family=Rethink+Sans:wght@400;500;700&display=swap');
</style>

    
   
<nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
    
    <div class="lg:flex lg:gap-x-20">
      <a href="{{ route('travel') }}" class="text-lg font-semibold leading-6 text-gray-900">Search flights</a>
    </div>
    <div class="lg:flex lg:flex-1 lg:justify-end text-lg">
    @if(auth()->check())
            <a href="{{ route('bookings.index') }}">Rezerwacje</a>
            <a href="{{ route('dashboard') }}">Moje konto</a> 
        @else
            <a href="{{ route('login', ['previous' => url()->current()]) }}">Zaloguj się <span aria-hidden="true">&rarr;</span></a>
            
        @endif
    </div>
  </nav>