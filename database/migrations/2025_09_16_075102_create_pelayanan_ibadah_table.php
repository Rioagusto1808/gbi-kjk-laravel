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
        Schema::create('pelayanan_ibadah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ibadah_id')->constrained('ibadah')->cascadeOnDelete();
            $table->foreignId('pelayanan_id')->constrained('pelayanan')->cascadeOnDelete();
            $table->foreignId('jemaat_id')->constrained('jemaat')->cascadeOnDelete();
            $table->timestamps();

            // Satu jemaat cuma bisa pegang satu role pelayanan di 1 ibadah
            $table->unique(['ibadah_id', 'pelayanan_id', 'jemaat_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelayanan_ibadah');
    }
};
