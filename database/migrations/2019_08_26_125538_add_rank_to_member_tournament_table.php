<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRankToMemberTournamentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_tournament', function (Blueprint $table) {
            $table->string("rank")->nullable();
            // $table->integer("order_display")->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('member_tournament', function (Blueprint $table) {
            $table->dropColumn('rank');
            // $table->dropColumn('order_display');
        });
    }
}
