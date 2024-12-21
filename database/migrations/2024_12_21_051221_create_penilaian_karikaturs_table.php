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
            $table->integer('nilai');
            $table->string('rangking')->nullable();
            $table->foreignId('juri_id')->nullable()->constrained('juris')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('peserta_id')->nullable()->constrained('pesertas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('bobot_soal_id')->nullable()->constrained('bobot_soals')->cascadeOnDelete()->cascadeOnUpdate();
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
