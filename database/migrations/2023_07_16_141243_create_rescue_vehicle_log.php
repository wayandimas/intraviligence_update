<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRescueVehicleLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rescue_vehicle_log', function (Blueprint $table) {
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
            $table->bigInteger('lampu_ruangan')->unsigned();
            $table->foreign('lampu_ruangan')->references('id')->on('condition_status');
            $table->bigInteger('air_conditioner')->unsigned();
            $table->foreign('air_conditioner')->references('id')->on('condition_status');
            $table->bigInteger('klakson')->unsigned();
            $table->foreign('klakson')->references('id')->on('condition_status');
            $table->string('ket_bagian_dalam');
            $table->bigInteger('mobile_power_unit')->unsigned();
            $table->foreign('mobile_power_unit')->references('id')->on('condition_status');
            $table->bigInteger('spreaders')->unsigned();
            $table->foreign('spreaders')->references('id')->on('condition_status');
            $table->bigInteger('cutters')->unsigned();
            $table->foreign('cutters')->references('id')->on('condition_status');
            $table->bigInteger('rescue_rams')->unsigned();
            $table->foreign('rescue_rams')->references('id')->on('condition_status');
            $table->bigInteger('lrc_ram')->unsigned();
            $table->foreign('lrc_ram')->references('id')->on('condition_status');
            $table->bigInteger('hose_extention')->unsigned();
            $table->foreign('hose_extention')->references('id')->on('condition_status');
            $table->bigInteger('vetter_air_liftingbag')->unsigned();
            $table->foreign('vetter_air_liftingbag')->references('id')->on('condition_status');
            $table->bigInteger('vetter_air_attack')->unsigned();
            $table->foreign('vetter_air_attack')->references('id')->on('condition_status');
            $table->bigInteger('air_cylinder')->unsigned();
            $table->foreign('air_cylinder')->references('id')->on('condition_status');
            $table->bigInteger('spring_loaded')->unsigned();
            $table->foreign('spring_loaded')->references('id')->on('condition_status');
            $table->bigInteger('pressure_regulator')->unsigned();
            $table->foreign('pressure_regulator')->references('id')->on('condition_status');
            $table->bigInteger('controller')->unsigned();
            $table->foreign('controller')->references('id')->on('condition_status');
            $table->bigInteger('hydrant_portable')->unsigned();
            $table->foreign('hydrant_portable')->references('id')->on('condition_status');
            $table->bigInteger('gasoline_cans')->unsigned();
            $table->foreign('gasoline_cans')->references('id')->on('condition_status');
            $table->bigInteger('chainset')->unsigned();
            $table->foreign('chainset')->references('id')->on('condition_status');
            $table->bigInteger('fire_hose')->unsigned();
            $table->foreign('fire_hose')->references('id')->on('condition_status');
            $table->bigInteger('nossel')->unsigned();
            $table->foreign('nossel')->references('id')->on('condition_status');
            $table->bigInteger('water_hose')->unsigned();
            $table->foreign('water_hose')->references('id')->on('condition_status');
            $table->bigInteger('generator_krisbow')->unsigned();
            $table->foreign('generator_krisbow')->references('id')->on('condition_status');
            $table->bigInteger('lampu_sorot_krisbow')->unsigned();
            $table->foreign('lampu_sorot_krisbow')->references('id')->on('condition_status');
            $table->string('ket_peralatan');
            $table->bigInteger('lampu_strobo')->unsigned();
            $table->foreign('lampu_strobo')->references('id')->on('condition_status');
            $table->bigInteger('public_adress')->unsigned();
            $table->foreign('public_adress')->references('id')->on('condition_status');
            $table->bigInteger('raincoat')->unsigned();
            $table->foreign('raincoat')->references('id')->on('condition_status');
            $table->bigInteger('bottle_jack')->unsigned();
            $table->foreign('bottle_jack')->references('id')->on('condition_status');
            $table->bigInteger('cable_cutter')->unsigned();
            $table->foreign('cable_cutter')->references('id')->on('condition_status');
            $table->bigInteger('apar_6kg')->unsigned();
            $table->foreign('apar_6kg')->references('id')->on('condition_status');
            $table->bigInteger('apar_9kg')->unsigned();
            $table->foreign('apar_9kg')->references('id')->on('condition_status');
            $table->bigInteger('safety_line')->unsigned();
            $table->foreign('safety_line')->references('id')->on('condition_status');
            $table->bigInteger('first_aid')->unsigned();
            $table->foreign('first_aid')->references('id')->on('condition_status');
            $table->bigInteger('thermal_blanket')->unsigned();
            $table->foreign('thermal_blanket')->references('id')->on('condition_status');
            $table->bigInteger('kunci_roda')->unsigned();
            $table->foreign('kunci_roda')->references('id')->on('condition_status');
            $table->bigInteger('cribing')->unsigned();
            $table->foreign('cribing')->references('id')->on('condition_status');
            $table->bigInteger('jerry_water')->unsigned();
            $table->foreign('jerry_water')->references('id')->on('condition_status');
            $table->bigInteger('parking_chock')->unsigned();
            $table->foreign('parking_chock')->references('id')->on('condition_status');
            $table->bigInteger('webing_sling')->unsigned();
            $table->foreign('webing_sling')->references('id')->on('condition_status');
            $table->bigInteger('oil_absorbent')->unsigned();
            $table->foreign('oil_absorbent')->references('id')->on('condition_status');
            $table->string('ket_peralatan_tambahan');
            $table->bigInteger('safety_glove')->unsigned();
            $table->foreign('safety_glove')->references('id')->on('condition_status');
            $table->bigInteger('safety_boots')->unsigned();
            $table->foreign('safety_boots')->references('id')->on('condition_status');
            $table->bigInteger('safety_glasses')->unsigned();
            $table->foreign('safety_glasses')->references('id')->on('condition_status');
            $table->bigInteger('headlamp')->unsigned();
            $table->foreign('headlamp')->references('id')->on('condition_status');
            $table->bigInteger('helm_safety')->unsigned();
            $table->foreign('helm_safety')->references('id')->on('condition_status');
            $table->bigInteger('apron')->unsigned();
            $table->foreign('apron')->references('id')->on('condition_status');
            $table->bigInteger('knee')->unsigned();
            $table->foreign('knee')->references('id')->on('condition_status');
            $table->bigInteger('faceshild')->unsigned();
            $table->foreign('faceshild')->references('id')->on('condition_status');
            $table->bigInteger('goggles')->unsigned();
            $table->foreign('goggles')->references('id')->on('condition_status');
            $table->bigInteger('single_mask')->unsigned();
            $table->foreign('single_mask')->references('id')->on('condition_status');
            $table->bigInteger('flip_cover')->unsigned();
            $table->foreign('flip_cover')->references('id')->on('condition_status');
            $table->bigInteger('fire_boots')->unsigned();
            $table->foreign('fire_boots')->references('id')->on('condition_status');
            $table->string('ket_personal_protection');
            $table->bigInteger('running_test')->unsigned();
            $table->bigInteger('air_radiator')->unsigned();
            $table->bigInteger('oil')->unsigned();
            $table->bigInteger('minyak_rem')->unsigned();
            $table->bigInteger('oil_power_steering')->unsigned();
            $table->string('ket_engine');
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
        Schema::dropIfExists('rescue_vehicle_log');
    }
}
