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
        Schema::create('ibadah_absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ibadah_id')->constrained('ibadah')->cascadeOnDelete();
            $table->foreignId('jemaat_id')->constrained('jemaat')->cascadeOnDelete();
            $table->boolean('hadir')->default(true);
            $table->timestamps();

            $table->unique(['ibadah_id', 'jemaat_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ibadah_absensi');
    }
};
