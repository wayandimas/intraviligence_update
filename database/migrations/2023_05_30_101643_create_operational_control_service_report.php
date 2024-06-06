<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationalControlServiceReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operational_control_service_report', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('stationing')->unsigned();
            $table->foreign('stationing')->references('id')->on('stationing');
            $table->bigInteger('seksi')->unsigned();
            $table->foreign('seksi')->references('id')->on('sections');
            $table->bigInteger('jalur')->unsigned();
            $table->foreign('jalur')->references('id')->on('tracks');
            $table->bigInteger('lajur')->unsigned();
            $table->foreign('lajur')->references('id')->on('lanes');
            $table->bigInteger('cuaca')->unsigned();
            $table->foreign('cuaca')->references('id')->on('weathers');
            $table->bigInteger('sumber_informasi')->unsigned();
            $table->foreign('sumber_informasi')->references('id')->on('source_informations');
            $table->string('tanggal_kejadian');
            $table->string('waktu_kejadian');
            $table->string('waktu_sampai');
            $table->string('respon_time');
            $table->string('waktu_selesai');
            $table->string('durasi_penanganan');
            $table->bigInteger('jenis_kegiatan')->unsigned();
            $table->foreign('jenis_kegiatan')->references('id')->on('type_activity');
            $table->string('deskripsi_kegiatan');
            $table->bigInteger('personil1')->unsigned();
            $table->foreign('personil1')->references('id')->on('officers');
            $table->bigInteger('personil2')->unsigned();
            $table->foreign('personil2')->references('id')->on('officers');
            $table->bigInteger('personil3')->unsigned()->nullable();
            $table->foreign('personil3')->references('id')->on('officers');
            $table->bigInteger('personil4')->unsigned()->nullable();
            $table->foreign('personil4')->references('id')->on('officers');
            $table->bigInteger('personil5')->unsigned()->nullable();
            $table->foreign('personil5')->references('id')->on('officers');
            $table->string('keterangan');
            $table->string('auto_text');
            $table->string('dokumentasi');
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
        Schema::dropIfExists('operational_control_service_report');
    }
}
