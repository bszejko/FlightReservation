<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id(); //automatycznie dodawane id
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Klucz obcy dla użytkownika
            $table->foreignId('flight_id')->constrained()->onDelete('cascade'); // Klucz obcy dla lotu
            $table->datetime('booking_date'); // Data rezerwacji
            $table->string('status'); // Status rezerwacji
            $table->timestamps(); // created_at i updated_at

            $table->foreign('flight_id')->references('id')->on('flights')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}


