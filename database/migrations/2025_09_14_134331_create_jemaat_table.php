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
        Schema::create('jemaat', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->date('tanggal_lahir')->nullable()->index();
            $table->string('alamat')->nullable();
            $table->string('no_hp', 13)->nullable()->index();
            $table->enum('status_pernikahan', ['Lajang', 'Menikah', 'Duda/Janda'])->nullable()->index();
            $table->string('pekerjaan')->nullable();
            $table->boolean('aktif')->default(true)->index();
            $table->foreignId('foto_id')->nullable()->constrained('files')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jemaat');
    }
};
