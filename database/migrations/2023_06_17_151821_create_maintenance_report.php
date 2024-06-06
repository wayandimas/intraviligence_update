<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenanceReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_report', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('unit_perawatan')->unsigned();
            $table->foreign('unit_perawatan')->references('id')->on('maintenance_unit');
            $table->string('tanggal_perawatan');
            $table->bigInteger('odo_meter');
            $table->bigInteger('jenis_perawatan')->unsigned();
            $table->foreign('jenis_perawatan')->references('id')->on('maintenance_type');
            $table->bigInteger('bengkel')->unsigned();
            $table->foreign('bengkel')->references('id')->on('repair_workshop');
            $table->string('keterangan');
            $table->bigInteger('personil1')->unsigned();
            $table->foreign('personil1')->references('id')->on('officers');
            $table->bigInteger('personil2')->unsigned();
            $table->foreign('personil2')->references('id')->on('officers');
            $table->string('foto_odo_meter');
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
        Schema::dropIfExists('maintenance_report');
    }
}
