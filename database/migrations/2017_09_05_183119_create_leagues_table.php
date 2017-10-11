<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leagues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->dateTime('start_season');
            $table->dateTime('end_season');
            $table->string('day_of_week');
            $table->boolean('is_accredited')->default(0);
            $table->string('team_name')->nullable();
            $table->string('place')->nullable();
            $table->string('result')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leagues');
    }
}
