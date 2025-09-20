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
        Schema::create('event_peserta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('event')->cascadeOnDelete();
            $table->foreignId('jemaat_id')->constrained('jemaat')->cascadeOnDelete();
            $table->enum('status', ['Daftar', 'Dikonfirmasi', 'Bayar', 'Batal'])->default('Daftar')->index();
            $table->boolean('hadir')->default(false);
            $table->timestamps();

            $table->unique(['event_id', 'jemaat_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_peserta');
    }
};
