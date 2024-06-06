<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbulanceVehicleLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambulance_vehicle_log', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('personil')->unsigned();
            $table->foreign('personil')->references('id')->on('officers');
            $table->integer('shift');
            $table->integer('km_awal');
            $table->bigInteger('ban_kanan_depan')->unsigned();
            $table->foreign('ban_kanan_depan')->references('id')->on('condition_status');
            $table->bigInteger('ban_kanan_belakang')->unsigned();
            $table->foreign('ban_kanan_belakang')->references('id')->on('condition_status');
            $table->bigInteger('ban_kiri_depan')->unsigned();
            $table->foreign('ban_kiri_depan')->references('id')->on('condition_status');
            $table->bigInteger('ban_kiri_belakang')->unsigned();
            $table->foreign('ban_kiri_belakang')->references('id')->on('condition_status');
            $table->bigInteger('ban_serep')->unsigned();
            $table->foreign('ban_serep')->references('id')->on('condition_status');
            $table->string('ket_roda_ban');
            $table->bigInteger('stnk')->unsigned();
            $table->foreign('stnk')->references('id')->on('condition_status');
            $table->bigInteger('lampu_dashboard')->unsigned();
            $table->foreign('lampu_dashboard')->references('id')->on('condition_status');
            $table->bigInteger('lampu_depan')->unsigned();
            $table->foreign('lampu_depan')->references('id')->on('condition_status');
            $table->bigInteger('lampu_belakang')->unsigned();
            $table->foreign('lampu_belakang')->references('id')->on('condition_status');
            $table->bigInteger('lampu_rem')->unsigned();
            $table->foreign('lampu_rem')->references('id')->on('condition_status');
            $table->bigInteger('lampu_sein')->unsigned();
            $table->foreign('lampu_sein')->references('id')->on('condition_status');
            $table->bigInteger('lampu_mundur')->unsigned();
            $table->foreign('lampu_mundur')->references('id')->on('condition_status');
            $table->bigInteger('air_conditioner')->unsigned();
            $table->foreign('air_conditioner')->references('id')->on('condition_status');
            $table->bigInteger('klakson')->unsigned();
            $table->foreign('klakson')->references('id')->on('condition_status');
            $table->bigInteger('wiper')->unsigned();
            $table->foreign('wiper')->references('id')->on('condition_status');
            $table->bigInteger('seat_belt')->unsigned();
            $table->foreign('seat_belt')->references('id')->on('condition_status');
            $table->bigInteger('handle_kaca_pintu')->unsigned();
            $table->foreign('handle_kaca_pintu')->references('id')->on('condition_status');
            $table->string('ket_bagian_dalam');
            $table->bigInteger('kunci_roda')->unsigned();
            $table->foreign('kunci_roda')->references('id')->on('condition_status');
            $table->bigInteger('dongkrak')->unsigned();
            $table->foreign('dongkrak')->references('id')->on('condition_status');
            $table->bigInteger('p3k')->unsigned();
            $table->foreign('p3k')->references('id')->on('condition_status');
            $table->string('ket_peralatan');
            $table->bigInteger('public_adress')->unsigned();
            $table->foreign('public_adress')->references('id')->on('condition_status');
            $table->bigInteger('lampu_strobo')->unsigned();
            $table->foreign('lampu_strobo')->references('id')->on('condition_status');
            $table->bigInteger('lampu_sorot')->unsigned();
            $table->foreign('lampu_sorot')->references('id')->on('condition_status');
            $table->bigInteger('apar')->unsigned();
            $table->foreign('apar')->references('id')->on('condition_status');
            $table->string('ket_peralatan_tambahan');
            $table->bigInteger('engine_condition')->unsigned();
            $table->foreign('engine_condition')->references('id')->on('condition_status');
            $table->bigInteger('running_tes')->unsigned();
            $table->foreign('running_tes')->references('id')->on('condition_status');
            $table->bigInteger('air_radiator')->unsigned();
            $table->foreign('air_radiator')->references('id')->on('condition_status');
            $table->bigInteger('oli')->unsigned();
            $table->foreign('oli')->references('id')->on('condition_status');
            $table->bigInteger('minyak_rem')->unsigned();
            $table->foreign('minyak_rem')->references('id')->on('condition_status');
            $table->bigInteger('oil_power_steering')->unsigned();
            $table->foreign('oil_power_steering')->references('id')->on('condition_status');
            $table->string('ket_engine');
            $table->bigInteger('samping_kiri')->unsigned();
            $table->foreign('samping_kiri')->references('id')->on('condition_status');
            $table->bigInteger('samping_kanan')->unsigned();
            $table->foreign('samping_kanan')->references('id')->on('condition_status');
            $table->bigInteger('depan')->unsigned();
            $table->foreign('depan')->references('id')->on('condition_status');
            $table->bigInteger('belakang')->unsigned();
            $table->foreign('belakang')->references('id')->on('condition_status');
            $table->bigInteger('atas')->unsigned();
            $table->foreign('atas')->references('id')->on('condition_status');
            $table->string('ket_body_cat');
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
        Schema::dropIfExists('ambulance_vehicle_log');
    }
}
