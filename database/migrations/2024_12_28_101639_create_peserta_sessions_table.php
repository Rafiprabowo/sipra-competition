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
        Schema::create('peserta_sessions', function (Blueprint $table) {
            $table->id();
            $table->float('score');
            $table->enum('status', ['in_progress', 'completed'])->default('in_progress');
            $table->timestamp('completed_at')->nullable();
            $table->integer('correct_difficult_answers')->nullable();
            $table->integer('correct_answer_count')->nullable();
            $table->foreignId('cbt_session_id')->constrained('cbt_sessions')->cascadeOnDelete();
            $table->foreignId('peserta_id')->constrained('pesertas')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_sessions');
    }
};
