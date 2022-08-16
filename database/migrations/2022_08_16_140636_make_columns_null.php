<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeColumnsNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cutomer_information', function (Blueprint $table) {
            $table->string('owner')->unsigned()->nullable()->change();
            $table->string('email')->unsigned()->nullable()->change();
            $table->string('contact')->unsigned()->nullable()->change();
            $table->string('address')->unsigned()->nullable()->change();
            $table->string('from_day')->unsigned()->nullable()->change();
            $table->string('to_day')->unsigned()->nullable()->change();
            $table->string('from_time')->unsigned()->nullable()->change();
            $table->string('to_time')->unsigned()->nullable()->change();
            $table->string('closed')->unsigned()->nullable()->change();
//            $table->string('opening-hours')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cutomer_information', function (Blueprint $table) {
            //
        });
    }
}
