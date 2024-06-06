<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefuelingReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refueling_report', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('unit_pengisian')->unsigned();
            $table->foreign('unit_pengisian')->references('id')->on('maintenance_unit');
            $table->string('tanggal_pengisian');
            $table->string('waktu_pengisian');
            $table->bigInteger('odo_meter');
            $table->bigInteger('jumlah_pengisian');
            $table->bigInteger('personil1')->unsigned();
            $table->foreign('personil1')->references('id')->on('officers');
            $table->bigInteger('personil2')->unsigned();
            $table->foreign('personil2')->references('id')->on('officers');
            $table->bigInteger('kembalian');
            $table->string('foto_struk');
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
        Schema::dropIfExists('refueling_report');
    }
}
