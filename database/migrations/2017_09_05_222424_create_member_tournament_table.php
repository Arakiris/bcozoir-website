<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTournamentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_tournament', function (Blueprint $table) {
            $table->integer('member_id')->unsigned()->index();
            $table->integer('tournament_id')->unsigned()->index();

            $table->primary(['member_id', 'tournament_id']);
            
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('tournament_id')->references('id')->on('tournaments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_tournament');
    }
}
