<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id')->unsigned()->nullable()->index();
            $table->string('title');
            $table->dateTime('start_season');
            $table->dateTime('end_season');
            $table->dateTime('date');
            $table->boolean('is_accredited')->default(0);
            $table->text('place');
            $table->boolean('is_rules_pdf')->default(0);
            $table->string('rules_url')->nullable();
            $table->string('rules_pdf')->nullable();
            $table->string('listing')->nullable();
            $table->boolean('is_finished')->default(0);
            $table->text('report')->nullable();
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('tournament_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tournaments');
    }
}
