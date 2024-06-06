<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUnitToVehicleLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ambulance_vehicle_log', function (Blueprint $table) {
            $table->string('unit')->nullable();
         });
        Schema::table('rescue_vehicle_log', function (Blueprint $table) {
            $table->string('unit')->nullable();
         });
        Schema::table('derek_besar_vehicle_log', function (Blueprint $table) {
            $table->string('unit')->nullable();
         });
        Schema::table('derek_kecil_vehicle_log', function (Blueprint $table) {
            $table->string('unit')->nullable();
         });
        Schema::table('handover_tol_inventory_log', function (Blueprint $table) {
            $table->string('unit')->nullable();
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rescue_vehicle_log', function (Blueprint $table) {
            $table->dropColumn('unit');
        });
        Schema::table('ambulance_vehicle_log', function (Blueprint $table) {
            $table->dropColumn('unit');
        });
        Schema::table('derek_besar_vehicle_log', function (Blueprint $table) {
            $table->dropColumn('unit');
        });
        Schema::table('handover_tol_inventory_log', function (Blueprint $table) {
            $table->dropColumn('unit');
        });
        Schema::table('derek_kecil_vehicle_log', function (Blueprint $table) {
            $table->dropColumn('unit');
        });
    }
}
