<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityMutationServiceTol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_mutation_service_tol', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('personil1')->unsigned();
            $table->foreign('personil1')->references('id')->on('officers');
            $table->bigInteger('personil2')->unsigned();
            $table->foreign('personil2')->references('id')->on('officers');
            $table->bigInteger('unit')->unsigned();
            $table->foreign('unit')->references('id')->on('operasionals');
            $table->bigInteger('waktu_pemantauan')->unsigned();
            $table->foreign('waktu_pemantauan')->references('id')->on('monitoring_time');
            $table->bigInteger('lokasi_pemantauan')->unsigned();
            $table->foreign('lokasi_pemantauan')->references('id')->on('monitoring_locations');
            $table->text('keterangan');
            $table->string('no_mutasi')->nullable();
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
        Schema::dropIfExists('activity_mutation_service_tol');
    }
}
