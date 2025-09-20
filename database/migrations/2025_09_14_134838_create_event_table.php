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
        Schema::create('event', function (Blueprint $table) {
            $table->id();
            $table->string('nama_event')->index();
            $table->text('deskripsi')->nullable();
            $table->dateTime('tanggal_mulai')->index();
            $table->dateTime('tanggal_selesai')->nullable()->index();
            $table->string('lokasi')->nullable();
            $table->string('tema')->nullable();
            $table->decimal('biaya', 15, 2)->nullable()->index();
            $table->enum('status', ['Akan Datang', 'Sedang Berlangsung', 'Selesai'])
            ->default('Akan Datang')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event');
    }
};
