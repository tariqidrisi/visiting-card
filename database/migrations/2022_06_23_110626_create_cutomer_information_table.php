<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCutomerInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cutomer_information', function (Blueprint $table) {
            $table->id();
            $table->string("owner");
            $table->string("email");
            $table->string("contact");
            $table->string("address");
            $table->string("from_day");
            $table->string("to_day");
            $table->string("from_time");
            $table->string("to_time");
            $table->json("closed");
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
        Schema::dropIfExists('cutomer_information');
    }
}
