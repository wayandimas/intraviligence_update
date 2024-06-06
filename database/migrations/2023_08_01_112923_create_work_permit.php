<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkPermit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_permit', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal_mulai_pekerjaan');
            $table->string('tanggal_mulai_izin');
            $table->string('tanggal_selesai_izin');
            $table->string('jenis_pekerjaan');
            $table->string('kontraktor');
            $table->string('foto');
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
        Schema::dropIfExists('work_permit');
    }
}
