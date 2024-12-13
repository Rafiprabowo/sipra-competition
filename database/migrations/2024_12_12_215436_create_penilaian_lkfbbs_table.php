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
        Schema::create('penilaian_lkfbbs', function (Blueprint $table) {
            $table->id();
            $table->integer('nilai_lomba');
            $table->foreignId('pembina_id')->constrained('pembinas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('regu_pembina_id')->constrained('regu_pembinas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('peserta_id')->constrained('pesertas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('juri_id')->constrained('juris')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('mata_lomba_id')->constrained('mata_lombas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('bobot_soal_id')->constrained('bobot_soals')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_lkfbbs');
    }
};
