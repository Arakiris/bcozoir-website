<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeagueMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('league_member', function (Blueprint $table) {
			$table->integer('member_id')->unsigned()->index();
            $table->integer('league_id')->unsigned()->index();

            $table->primary(['member_id', 'league_id']);
            
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('league_id')->references('id')->on('leagues')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('league_member');
    }
}
