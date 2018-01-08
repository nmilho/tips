<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('scheduled');
            $table->integer('season_id')->unsigned();
            $table->integer('tournament_id')->unsigned();
            $table->integer('sport_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('competitor_home_id')->unsigned();
            $table->integer('competitor_away_id')->unsigned();            
            $table->timestamps();

            $table->foreign('sport_id')->references('id')->on('sports');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('season_id')->references('id')->on('seasons');
            $table->foreign('tournament_id')->references('id')->on('tournaments');
            $table->foreign('competitor_home_id')->references('id')->on('competitors');
            $table->foreign('competitor_away_id')->references('id')->on('competitors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
