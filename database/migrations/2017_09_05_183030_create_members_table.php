<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('club_id')->unsigned()->nullable()->index();
            $table->integer('category_id')->unsigned()->nullable()->index();
            $table->string('first_name');
            $table->string('last_name');
            $table->char('sex', 1)->default('m');
            $table->dateTime('birth_date');
            $table->boolean('is_licensee')->default(0);
            $table->string('id_licensee')->nullable();
            $table->integer('handicap')->unsigned()->default(0);
            $table->integer('bonus')->unsigned()->default(0);
            $table->boolean('is_active')->default(1);
            $table->string('historical_path')->nullable();
            $table->timestamps();

            $table->foreign('club_id')->references('id')->on('clubs');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
