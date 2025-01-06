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
        Schema::create('sms_questions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', [\App\Enums\QuestionType::SEMAPHORE->value, \App\Enums\QuestionType::MORSE->value]);
            $table->string('word');
            $table->enum('difficulty', ['mudah', 'sulit']);
            $table->foreignId('cbt_session_id')->nullable()->constrained('cbt_sessions')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sms_questions');
    }
};
