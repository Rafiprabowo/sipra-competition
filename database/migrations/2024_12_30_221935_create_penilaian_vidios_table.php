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
        Schema::create('penilaian_vidios', function (Blueprint $table) {
            $table->id();
            $table->integer('nilai');
            $table->string('total_nilai')->nullable();
            $table->string('rangking')->nullable();
            $table->foreignId('juri_id')->nullable()->constrained('juris')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('pembina_id')->nullable()->constrained('pembinas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('mata_lomba_id')->nullable()->constrained('mata_lombas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('bobot_soal_id')->nullable()->constrained('bobot_soals')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_vidios');
    }
};
