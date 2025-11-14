<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('isp_providers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan');
            $table->string('bandwidth')->nullable();      
            $table->integer('harga')->nullable();       
            $table->year('tahun_masuk')->nullable();     
            $table->string('nama_pj')->nullable();       
            $table->string('kontak_pj')->nullable(); 
            $table->enum('status', ['aktif', 'non-aktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('isp_providers');
    }
};
