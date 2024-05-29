<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClassementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classments', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('team_id');
            $table->integer('points');
            $table->integer('win');
            $table->integer('lose');
            $table->integer('draw');
            $table->integer('number_of_match');
            $table->integer('home_goal');
            $table->integer('away_goal');

            $table->foreign('team_id')->references('id')->on('soccer_teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classments');
    }
}
