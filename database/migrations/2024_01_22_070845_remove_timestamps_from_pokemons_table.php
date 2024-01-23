<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveTimestampsFromPokemonsTable extends Migration
{
    public function up()
    {
        Schema::table('pokemons', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }

    public function down()
    {
        Schema::table('pokemons', function (Blueprint $table) {
            $table->timestamps();
        });
    }
}