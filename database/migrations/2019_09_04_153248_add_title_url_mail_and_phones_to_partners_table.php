<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTitleUrlMailAndPhonesToPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->string("title")->nullable()->after('address');
            $table->string("website")->nullable()->after('address');
            $table->string("url")->nullable()->after('address');
            $table->string("mail")->nullable()->after('address');
            $table->string("phone2")->nullable()->after('address');
            $table->string("phone1")->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn("website");
            $table->dropColumn('url');
            $table->dropColumn('mail');
            $table->dropColumn('phone1');
            $table->dropColumn('phone2');
        });
    }
}
