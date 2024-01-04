<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id(); //automatycznie dodawane id
            $table->string('from'); // Miejsce wylotu
            $table->string('to'); // Miejsce przylotu
            $table->datetime('departure_time'); // Czas wylotu
            $table->datetime('arrival_time'); // Czas przylotu
            $table->timestamps(); //data utworzenia i edycji
        });
    }

    public function down()
    {
        Schema::dropIfExists('flights');
    }
}


