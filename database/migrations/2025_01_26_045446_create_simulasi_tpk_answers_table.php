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
        Schema::create('simulasi_tpk_answers', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->foreignId('simulasi_tpk_question_id')->constrained('simulasi_tpk_questions')->cascadeOnDelete();
            $table->enum('answer', ['a', 'b', 'c', 'd'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simulasi_tpk_answers');
    }
};
