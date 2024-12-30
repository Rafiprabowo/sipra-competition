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
        Schema::create('cbt_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->integer('durasi');
            $table->enum('status', [\App\Enums\StatusSesiCbt::Draft->value, \App\Enums\StatusSesiCbt::Active->value, \App\Enums\StatusSesiCbt::Completed->value])->default('draft');
            $table->string('kode_akses')->nullable()->unique(); 
            $table->foreignId('mata_lomba_id')->constrained('mata_lombas')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cbt_sessions');
    }
};
