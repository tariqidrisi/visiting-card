<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeAllColumnNullableExceptIdAndCompanyIdToSocialMedia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('social_media', function (Blueprint $table) {
            $table->string('website')->unsigned()->nullable()->change();
            $table->string('facebook')->unsigned()->nullable()->change();
            $table->string('instagram')->unsigned()->nullable()->change();
            $table->string('whatsapp')->unsigned()->nullable()->change();
            $table->string('linkedin')->unsigned()->nullable()->change();
            $table->string('email')->unsigned()->nullable()->change();
            $table->string('portfolio')->unsigned()->nullable()->change();
            $table->string('pricing')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('social_media', function (Blueprint $table) {
            //
        });
    }
}
