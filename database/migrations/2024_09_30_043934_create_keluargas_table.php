<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('keluargas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pengumpulan_data');
            $table->string('alamat');
            $table->string('no_handphone');
            $table->string('kabupaten')->default('Solo');
            $table->string('puskesmas');
            $table->string('kecamatan');
            $table->string('kelurahan')->nullable();
            $table->string('pustu')->nullable();
            $table->string('posyandu')->nullable();
            $table->string('provinsi')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluargas');
    }
};
