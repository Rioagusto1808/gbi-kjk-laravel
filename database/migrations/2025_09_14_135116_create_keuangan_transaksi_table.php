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
        Schema::create('keuangan_transaksi', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe', ['Pemasukan', 'Pengeluaran'])->index();
            $table->decimal('jumlah', 15, 2);
            $table->string('kategori')->index(); // Persembahan, Perpuluhan, Operasional, Sosial, dll
            $table->text('keterangan')->nullable();
            $table->date('tanggal')->index();
            $table->foreignId('dibuat_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['tanggal', 'tipe', 'kategori']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangan_transaksi');
    }
};
