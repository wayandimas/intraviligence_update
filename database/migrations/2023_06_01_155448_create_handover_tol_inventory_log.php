<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHandoverTolInventoryLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('handover_tol_inventory_log', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('personil')->unsigned();
            $table->foreign('personil')->references('id')->on('officers');
            $table->integer('shift');
            $table->string('lokasi_aset')->nullable();
            $table->integer('jumlah_handy_talkie');
            $table->bigInteger('handy_talkie')->unsigned();
            $table->foreign('handy_talkie')->references('id')->on('condition');
            $table->integer('jumlah_batok_charger');
            $table->bigInteger('batok_charger')->unsigned();
            $table->foreign('batok_charger')->references('id')->on('condition');
            $table->integer('jumlah_adapter_charger');
            $table->bigInteger('adapter_charger')->unsigned();
            $table->foreign('adapter_charger')->references('id')->on('condition');
            $table->integer('jumlah_tongkat_t');
            $table->bigInteger('tongkat_t')->unsigned();
            $table->foreign('tongkat_t')->references('id')->on('condition');
            $table->integer('jumlah_tali_sling');
            $table->bigInteger('tali_sling')->unsigned();
            $table->foreign('tali_sling')->references('id')->on('condition');
            $table->integer('jumlah_amplifier');
            $table->bigInteger('amplifier')->unsigned();
            $table->foreign('amplifier')->references('id')->on('condition');
            $table->integer('jumlah_wireless');
            $table->bigInteger('wireless')->unsigned();
            $table->foreign('wireless')->references('id')->on('condition');
            $table->integer('jumlah_alarm');
            $table->bigInteger('alarm')->unsigned();
            $table->foreign('alarm')->references('id')->on('condition');
            $table->integer('jumlah_senter_lalin');
            $table->bigInteger('senter_lalin')->unsigned();
            $table->foreign('senter_lalin')->references('id')->on('condition');
            $table->integer('jumlah_apar');
            $table->bigInteger('apar')->unsigned();
            $table->foreign('apar')->references('id')->on('condition');
            $table->integer('jumlah_box_apar');
            $table->bigInteger('box_apar')->unsigned();
            $table->foreign('box_apar')->references('id')->on('condition');
            $table->integer('jumlah_ac');
            $table->bigInteger('ac')->unsigned();
            $table->foreign('ac')->references('id')->on('condition');
            $table->integer('jumlah_jas_hujan');
            $table->bigInteger('jas_hujan')->unsigned();
            $table->foreign('jas_hujan')->references('id')->on('condition');
            $table->integer('jumlah_layar_monitor');
            $table->bigInteger('layar_monitor')->unsigned();
            $table->foreign('layar_monitor')->references('id')->on('condition');
            $table->integer('jumlah_cctv');
            $table->bigInteger('cctv')->unsigned();
            $table->foreign('cctv')->references('id')->on('condition');
            $table->integer('jumlah_lla');
            $table->bigInteger('lla')->unsigned();
            $table->foreign('lla')->references('id')->on('condition');
            $table->integer('jumlah_r_max');
            $table->bigInteger('r_max')->unsigned();
            $table->foreign('r_max')->references('id')->on('condition');
            $table->integer('jumlah_r_21');
            $table->bigInteger('r_21')->unsigned();
            $table->foreign('r_21')->references('id')->on('condition');
            $table->integer('jumlah_mesin_genset');
            $table->bigInteger('mesin_genset')->unsigned();
            $table->foreign('mesin_genset')->references('id')->on('condition');
            $table->integer('jumlah_accu');
            $table->bigInteger('accu')->unsigned();
            $table->foreign('accu')->references('id')->on('condition');
            $table->integer('jumlah_r_stop');
            $table->bigInteger('r_stop')->unsigned();
            $table->foreign('r_stop')->references('id')->on('condition');
            $table->integer('jumlah_r_palang');
            $table->bigInteger('r_palang')->unsigned();
            $table->foreign('r_palang')->references('id')->on('condition');
            $table->integer('jumlah_sepatu_boat');
            $table->bigInteger('sepatu_boat')->unsigned();
            $table->foreign('sepatu_boat')->references('id')->on('condition');
            $table->integer('jumlah_payung');
            $table->bigInteger('payung')->unsigned();
            $table->foreign('payung')->references('id')->on('condition');
            $table->integer('jumlah_dispenser');
            $table->bigInteger('dispenser')->unsigned();
            $table->foreign('dispenser')->references('id')->on('condition');
            $table->integer('jumlah_galon');
            $table->bigInteger('galon')->unsigned();
            $table->foreign('galon')->references('id')->on('condition');
            $table->integer('jumlah_speaker_active');
            $table->bigInteger('speaker_active')->unsigned();
            $table->foreign('speaker_active')->references('id')->on('condition');
            $table->integer('jumlah_rubber_cone');
            $table->bigInteger('rubber_cone')->unsigned();
            $table->foreign('rubber_cone')->references('id')->on('condition');
            $table->string('keterangan');
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
        Schema::dropIfExists('handover_tol_inventory_log');
    }
}
