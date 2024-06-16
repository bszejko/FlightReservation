<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Rethink+Sans:wght@500&display=swap" rel="stylesheet">
    <title>Twoja rezerwacja</title>
    @vite('resources/css/app.css')
</head>
<body >

<header>
    @include('components.navbar', [
        'backgroundImage' => asset('images/beams-basic.png')
         ]) 
</header>

<div class="w-3/4 mx-auto justify-center">
  <div class="px-4 sm:px-0">
    <h3 class="text-lg font-semibold leading-7 text-gray-900">Your reservation</h3>
    <p class="mt-1 max-w-2xl text-base leading-6 text-gray-500">Check the details of your reservation</p>
  </div>
  <div class=" w-3/4 mx-auto justify-center mt-6 border-t border-gray-200">
    <dl class="divide-y divide-gray-200">

      <div class="px-4 py-6 sm:flex sm:justify-between ">
        <dt class="text-base font-medium leading-6 text-gray-900">From</dt>
        <dd class="mt-1 text-base leading-6 text-gray-700 sm:mt-0">{{ $flightDetails['from'] }}</dd>
      </div>
      <div class="px-4 py-6 sm:flex sm:justify-between  border-t border-gray-200">
        <dt class="text-base font-medium leading-6 text-gray-900">To</dt>
        <dd class="mt-1 text-base leading-6 text-gray-700 sm:mt-0">{{ $flightDetails['to'] }}</dd>
      </div>
      <div class="px-4 py-6 sm:flex sm:justify-between border-t border-gray-200">
        <dt class="text-base font-medium leading-6 text-gray-900">Departure date and time</dt>
        <dd class="mt-1 text-base leading-6 text-gray-700 sm:mt-0">{{ $flightDetails['departure_time'] }}</dd>
      </div>
      <div class="px-4 py-6 sm:flex sm:justify-between border-t border-gray-200">
        <dt class="text-base font-medium leading-6 text-gray-900">Arrival date and time</dt>
        <dd class="mt-1 text-base leading-6 text-gray-700 sm:mt-0">{{ $flightDetails['arrival_time'] }}</dd>
      </div>
      <div class="px-4 py-6 sm:flex sm:justify-between border-t border-gray-200">
        <dt class="text-base font-medium leading-6 text-gray-900">Price</dt>
        <dd class="mt-1 text-base leading-6 text-gray-700 sm:mt-0">{{ $flightDetails['price'] }}</dd>
      </div>
      <div class="px-4 py-6 sm:flex sm:justify-between border-t border-gray-200">
        <dt class="text-base font-medium leading-6 text-gray-900">Attachments</dt>
        <dd class="mt-2 text-base text-gray-900 sm:col-span-2 sm:mt-0">
          <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
            <li class="flex items-center justify-between py-4 pl-4 pr-5 text-base leading-6">
              <div class="flex w-0 flex-1 items-center p-8">
                <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z" clip-rule="evenodd" />
                </svg>
                <div class="ml-4 flex min-w-0 flex-1 gap-2">
                  <span class="truncate font-medium">flight_reservation_info.pdf</span>
                  <span class="flex-shrink-0 text-gray-400">2.4mb</span>
                </div>
              </div>
              <div class="ml-4 flex-shrink-0">
                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500 p-8">Download</a>
              </div>
            </li>
            
          </ul>
        </dd>
      </div>
    </dl>
  </div>

  <!-- Zmienne ukryte - są już dostępne w kodzie, przekazuje je do flights.store -->
  <form action="{{ route('flights.store') }}" method="POST" class="w-full mt-8">
      @csrf
      <input type="hidden" name="from" value="{{ $flightDetails['from'] }}">
      <input type="hidden" name="to" value="{{ $flightDetails['to'] }}">
      <input type="hidden" name="departure_time" value="{{ $flightDetails['departure_time'] }}">
      <input type="hidden" name="arrival_time" value="{{ $flightDetails['arrival_time'] }}">
      <input type="hidden" name="price" value="{{ $flightDetails['price'] }}">
      <input type="hidden" name="rawDate" value="{{ request('rawDate') }}">
      <input type="hidden" name="rawReturnDate" value="{{ request('rawReturnDate') }}">

      <button class="btn btn1 w-full py-3 bg-blue-900 text-white font-semibold rounded-md hover:bg-blue-700 transition duration-300" type="submit">
          Potwierdź rezerwację
      </button>
  </form>
</div>

</body>
</html>
