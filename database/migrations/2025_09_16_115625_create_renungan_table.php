<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('renungan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('ayat')->nullable();
            $table->text('isi');
            $table->text('doa')->nullable();
            $table->string('penulis')->nullable();
            $table->enum('status', ['draft','publish'])
                  ->default('publish')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('renungan');
    }
};
