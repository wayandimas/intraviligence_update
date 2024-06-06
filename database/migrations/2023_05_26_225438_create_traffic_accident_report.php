<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrafficAccidentReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traffic_accident_report', function (Blueprint $table) {
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
            $table->bigInteger('jenis_kecelakaan')->unsigned();
            $table->foreign('jenis_kecelakaan')->references('id')->on('type_accident');
            $table->bigInteger('penyebab_kecelakaan')->unsigned();
            $table->foreign('penyebab_kecelakaan')->references('id')->on('cause_accident');
            $table->bigInteger('kategori_kecelakaan')->unsigned();
            $table->foreign('kategori_kecelakaan')->references('id')->on('category_accident');
            $table->bigInteger('kerugian_kecelakaan')->unsigned();
            $table->foreign('kerugian_kecelakaan')->references('id')->on('loss_accident');
            $table->string('kerugian_tol')->nullable();
            $table->string('asal_perjalanan')->nullable();
            $table->string('tujuan_perjalanan')->nullable();
            $table->bigInteger('personil1')->unsigned();
            $table->foreign('personil1')->references('id')->on('officers');
            $table->bigInteger('personil2')->unsigned();
            $table->foreign('personil2')->references('id')->on('officers');
            $table->bigInteger('personil_ambulan')->unsigned()->nullable();
            $table->foreign('personil_ambulan')->references('id')->on('officers');
            $table->bigInteger('personil_rescue')->unsigned()->nullable();
            $table->foreign('personil_rescue')->references('id')->on('officers');
            $table->bigInteger('petugas_lainnya')->unsigned()->nullable();
            $table->foreign('petugas_lainnya')->references('id')->on('officers');
            $table->bigInteger('petugas_derek')->unsigned()->nullable();
            $table->foreign('petugas_derek')->references('id')->on('officers');
            $table->string('unit_derek');
            $table->string('waktu_dibutuhkan');
            $table->string('waktu_sampai_tkp');
            $table->string('respon_time_derek');
            $table->string('keterangan');
            $table->string('auto_text');
            $table->string('dokumentasi');
            $table->string('waktu_info_medis_dibutuhkan');
            $table->string('waktu_tiba_medis');
            $table->string('respond_time_medis');
            $table->string('waktu_medis_meninggalkan_tkp');
            $table->string('durasi_penanganan_medis');
            $table->string('waktu_sampai_rs');
            $table->string('durasi_perjalanan');

            // $table->bigInteger('golongan_kendaraan')->unsigned();
            // $table->foreign('golongan_kendaraan')->references('id')->on('vehicle_class');
          

            $table->timestamps();
        });
             
        Schema::create('traffic_accident_report_vehicle_class', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('report_id')->unsigned();
            $table->bigInteger('vehicle_class_id')->unsigned();
            $table->string('nopol');
            $table->foreign('report_id')->references('id')->on('traffic_accident_report')->onDelete('cascade');
            $table->foreign('vehicle_class_id')->references('id')->on('vehicle_class')->onDelete('cascade');
            $table->timestamps();
        });
    Schema::create('traffic_accident_victim', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('report_id')->unsigned();
            $table->string('nama');
            $table->integer('umur');
            // $table->bigInteger('kondisi')->unsigned();
            $table->string('tindakan');
            $table->string('kondisi');
            $table->foreign('report_id')->references('id')->on('traffic_accident_report')->onDelete('cascade');
            // $table->foreign('kondisi')->references('id')->on('victim_condition')->onDelete('cascade');
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
        Schema::dropIfExists('traffic_accident_report');
        Schema::dropIfExists('traffic_accident_report_vehicle_class');
        Schema::dropIfExists('traffic_accident_victim');
    }
}
