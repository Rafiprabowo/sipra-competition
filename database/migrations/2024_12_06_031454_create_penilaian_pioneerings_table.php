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
        Schema::create('penilaian_pioneerings', function (Blueprint $table) {
            $table->id();
            $table->integer('kekuatan_struktur');
            $table->integer('ketepatan_kerapian');
            $table->integer('kreativitas_desain');
            $table->integer('kesesuaian_fungsi');
            $table->integer('waktu_penyelesaian');
            $table->foreignId('peserta_id')->constrained('pesertas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('juri_id')->constrained('juris')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('mata_lomba_id')->constrained('mata_lombas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_pioneerings');
    }
};
