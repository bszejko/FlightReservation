<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceToFlightsTable extends Migration
{
    public function up()
    {
        Schema::table('flights', function (Blueprint $table) {
            $table->decimal('price', 8, 2); // Dodaje kolumnę 'price'
        });
    }

    public function down()
    {
        Schema::table('flights', function (Blueprint $table) {
            $table->dropColumn('price'); 
        });
    }
}

