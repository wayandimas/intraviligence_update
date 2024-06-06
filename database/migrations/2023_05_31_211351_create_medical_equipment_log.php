<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalEquipmentLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_equipment_log', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('personil')->unsigned();
            $table->foreign('personil')->references('id')->on('officers');
            $table->integer('shift');
            $table->bigInteger('cairan_nacl')->unsigned();
            $table->foreign('cairan_nacl')->references('id')->on('condition_status');
            $table->bigInteger('nirbekken')->unsigned();
            $table->foreign('nirbekken')->references('id')->on('condition_status');
            $table->bigInteger('pinset_anatomi')->unsigned();
            $table->foreign('pinset_anatomi')->references('id')->on('condition_status');
            $table->bigInteger('sunction_manual')->unsigned();
            $table->foreign('sunction_manual')->references('id')->on('condition_status');
            $table->bigInteger('tabung_o2')->unsigned();
            $table->foreign('tabung_o2')->references('id')->on('condition_status');
            $table->bigInteger('tandu_skop')->unsigned();
            $table->foreign('tandu_skop')->references('id')->on('condition_status');
            $table->bigInteger('brangkar')->unsigned();
            $table->foreign('brangkar')->references('id')->on('condition_status');
            $table->bigInteger('kantong_mayat')->unsigned();
            $table->foreign('kantong_mayat')->references('id')->on('condition_status');
            $table->bigInteger('betadine')->unsigned();
            $table->foreign('betadine')->references('id')->on('condition_status');
            $table->bigInteger('alcohol')->unsigned();
            $table->foreign('alcohol')->references('id')->on('condition_status');
            $table->bigInteger('kasa_steril')->unsigned();
            $table->foreign('kasa_steril')->references('id')->on('condition_status');
            $table->bigInteger('perban_elastis')->unsigned();
            $table->foreign('perban_elastis')->references('id')->on('condition_status');
            $table->bigInteger('kapas')->unsigned();
            $table->foreign('kapas')->references('id')->on('condition_status');
            $table->bigInteger('handskun')->unsigned();
            $table->foreign('handskun')->references('id')->on('condition_status');
            $table->bigInteger('selang_o2')->unsigned();
            $table->foreign('selang_o2')->references('id')->on('condition_status');
            $table->bigInteger('extrication_collar')->unsigned();
            $table->foreign('extrication_collar')->references('id')->on('condition_status');
            $table->bigInteger('bidai_tiup')->unsigned();
            $table->foreign('bidai_tiup')->references('id')->on('condition_status');
            $table->bigInteger('masker')->unsigned();
            $table->foreign('masker')->references('id')->on('condition_status');
            $table->bigInteger('gunting')->unsigned();
            $table->foreign('gunting')->references('id')->on('condition_status');
            $table->bigInteger('plester')->unsigned();
            $table->foreign('plester')->references('id')->on('condition_status');
            $table->bigInteger('ambu_bag_masker')->unsigned();
            $table->foreign('ambu_bag_masker')->references('id')->on('condition_status');
            $table->string('ket_peralatan_medis');
            $table->bigInteger('alat_sterilisator')->unsigned();
            $table->foreign('alat_sterilisator')->references('id')->on('condition_status');
            $table->bigInteger('tempat_tidur_pasien')->unsigned();
            $table->foreign('tempat_tidur_pasien')->references('id')->on('condition_status');
            $table->bigInteger('kantong_mayat_medis')->unsigned();
            $table->foreign('kantong_mayat_medis')->references('id')->on('condition_status');
            $table->bigInteger('tensi_meter')->unsigned();
            $table->foreign('tensi_meter')->references('id')->on('condition_status');
            $table->bigInteger('stetescop')->unsigned();
            $table->foreign('stetescop')->references('id')->on('condition_status');
            $table->bigInteger('kotak_p3k')->unsigned();
            $table->foreign('kotak_p3k')->references('id')->on('condition_status');
            $table->bigInteger('gunting_plester')->unsigned();
            $table->foreign('gunting_plester')->references('id')->on('condition_status');
            $table->bigInteger('clem')->unsigned();
            $table->foreign('clem')->references('id')->on('condition_status');
            $table->bigInteger('kasa_steril_medis')->unsigned();
            $table->foreign('kasa_steril_medis')->references('id')->on('condition_status');
            $table->bigInteger('kasa_gulung')->unsigned();
            $table->foreign('kasa_gulung')->references('id')->on('condition_status');
            $table->bigInteger('cairan_nacl_medis')->unsigned();
            $table->foreign('cairan_nacl_medis')->references('id')->on('condition_status');
            $table->bigInteger('kapas_medis')->unsigned();
            $table->foreign('kapas_medis')->references('id')->on('condition_status');
            $table->bigInteger('hipafix')->unsigned();
            $table->foreign('hipafix')->references('id')->on('condition_status');
            $table->bigInteger('tabung_o2_medis')->unsigned();
            $table->foreign('tabung_o2_medis')->references('id')->on('condition_status');
            $table->bigInteger('betadine_medis')->unsigned();
            $table->foreign('betadine_medis')->references('id')->on('condition_status');
            $table->string('ket_ruang_medis');
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
        Schema::dropIfExists('medical_equipment_log');
    }
}
