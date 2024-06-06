<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageTrafficAccident extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_traffic_accident', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_report')->unsigned();
            $table->foreign('id_report')->references('id')->on('traffic_accident_report');
            $table->string('nama');
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
        Schema::dropIfExists('image_traffic_accident');
    }
}
