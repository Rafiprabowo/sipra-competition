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
        Schema::create('upload_lombas', function (Blueprint $table) {
            $table->id();
            $table->string('upload_poster');
            $table->string('upload_video');
            $table->foreignId('peserta_id')->constrained('pesertas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('mata_lomba_id')->constrained('mata_lombas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('pembina_id')->constrained('pembinas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upload_lombas');
    }
};
