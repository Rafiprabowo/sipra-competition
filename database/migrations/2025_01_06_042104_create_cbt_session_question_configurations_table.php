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
        Schema::create('cbt_session_question_configurations', function (Blueprint $table) {
            $table->id();
            $table->enum('question_type', [\App\Enums\QuestionType::MORSE->value, \App\Enums\QuestionType::SEMAPHORE->value, \App\Enums\QuestionType::PK->value]);
            $table->integer('easy_question_count')->default(0);
            $table->integer('hard_question_count')->default(0);
            $table->foreignId('cbt_session_id')->constrained('cbt_sessions')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cbt_session_question_configurations');
    }
};
