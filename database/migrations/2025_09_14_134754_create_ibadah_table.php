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
        Schema::create('ibadah', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis', ['Umum', 'Sekolah Minggu', 'Youth', 'Doa', 'Lainnya'])->default('Umum')->index();
            $table->dateTime('tanggal_mulai')->index();
            $table->dateTime('tanggal_selesai')->nullable()->index();
            $table->string('lokasi')->nullable();
            $table->string('tema')->nullable();
            $table->string('ayat')->nullable();
            $table->string('gembala')->nullable();
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['Akan Datang', 'Sedang Berlangsung', 'Selesai'])->default('Akan Datang')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ibadah');
    }
};
