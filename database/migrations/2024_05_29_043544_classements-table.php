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
            $table->integer('points')->default(0);
            $table->integer('win')->default(0);
            $table->integer('lose')->default(0);
            $table->integer('draw')->default(0);
            $table->integer('number_of_match')->default(0);
            $table->integer('home_goal')->default(0);
            $table->integer('away_goal')->default(0);
            $table->timestamps();

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
