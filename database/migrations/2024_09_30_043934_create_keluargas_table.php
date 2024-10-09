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
            $table->enum('jkn', ['Ya', 'Tidak']); // Has National Health Insurance (JKN)
            $table->enum('sarana_air_bersih', ['Ya', 'Tidak']); // Availability of clean water source
            $table->enum('jenis_sumber_air', ['Terlindung', 'Tidak_Terlindung'])->nullable(); // Type of clean water source
            $table->enum('jamban_keluarga', ['Ya', 'Tidak']); // Availability of family latrine
            $table->enum('jenis_jamban', ['Saniter', 'Tidak_Saniter'])->nullable(); // Type of latrine
            $table->enum('ventilasi', ['Ya', 'Tidak']); // Availability of adequate ventilation
            $table->enum('gangguan_jiwa', ['Ya', 'Tidak']); // Presence of family member with mental illness
            $table->enum('terdiagnosis_penyakit', ['Ya', 'Tidak']); 
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
