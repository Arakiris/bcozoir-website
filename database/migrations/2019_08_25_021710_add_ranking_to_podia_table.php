<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRankingToPodiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('podia', function (Blueprint $table) {
            $table->boolean('is_ranking')->default(false)->after('date'); // true if there are ranking
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('podia', function (Blueprint $table) {
            $table->dropColumn('is_ranking');
        });
    }
}
