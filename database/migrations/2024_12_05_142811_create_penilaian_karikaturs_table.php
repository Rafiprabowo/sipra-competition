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
        Schema::create('penilaian_karikaturs', function (Blueprint $table) {
            $table->id();
            $table->integer('orisinalitas');
            $table->integer('kesesuaian_tema');
            $table->integer('kreativitas');
            $table->integer('pesan_yang_disampaikan');
            $table->integer('teknik');
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
        Schema::dropIfExists('penilaian_karikaturs');
    }
};
