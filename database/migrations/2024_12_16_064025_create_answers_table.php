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
       Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peserta_id')->constrained('pesertas')->onDelete('cascade');
            $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade');
            $table->foreignId('tpk_question_id')->constrained('tpk_questions')->onDelete('cascade');
            $table->enum('selected_answer', ['a', 'b', 'c', 'd', 'e'])->nullable();
            $table->boolean('is_correct')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
