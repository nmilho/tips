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
            $table->string('id')->unique();
            $table->primary('id');
            $table->string('scheduled');
            $table->string('season');
            $table->string('tournament');
            $table->string('competitorh');
            $table->string('competitora');
            
            $table->timestamps();

            $table->foreign('season')->references('id')->on('seasons');
            $table->foreign('tournament')->references('id')->on('tournaments');
            $table->foreign('competitorh')->references('id')->on('competitors');
            $table->foreign('competitora')->references('id')->on('competitors');
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
