<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaultVehicleReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vault_vehicle_report', function (Blueprint $table) {
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
            $table->bigInteger('jenis_gangguan')->unsigned();
            $table->foreign('jenis_gangguan')->references('id')->on('interferences');
            $table->bigInteger('golongan_kendaraan')->unsigned();
            $table->foreign('golongan_kendaraan')->references('id')->on('vehicle_class');
            $table->bigInteger('jenis_kendaraan')->unsigned();
            $table->foreign('jenis_kendaraan')->references('id')->on('vehicle_type');
            $table->string('plat_nomor');
            $table->string('asal_perjalanan');
            $table->string('tujuan_perjalanan');
            $table->bigInteger('personil1')->unsigned();
            $table->foreign('personil1')->references('id')->on('officers');
            $table->bigInteger('personil2')->unsigned();
            $table->foreign('personil2')->references('id')->on('officers');
            $table->bigInteger('personil3')->unsigned()->nullable();
            $table->foreign('personil3')->references('id')->on('officers');
            $table->bigInteger('petugas_derek')->unsigned()->nullable();
            $table->foreign('petugas_derek')->references('id')->on('officers');
            $table->string('penderekan');
            $table->string('unit_derek');
            $table->string('waktu_dibutuhkan');
            $table->string('waktu_sampai_tkp');
            $table->string('respon_time_derek');
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
        Schema::dropIfExists('vault_vehicle_report');
    }
}
