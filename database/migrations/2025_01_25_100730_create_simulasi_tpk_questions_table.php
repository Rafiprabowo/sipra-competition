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
        Schema::create('simulasi_tpk_questions', function (Blueprint $table) {
            $table->id();
            $table->text('question_text');
            $table->string('question_image')->nullable();
            $table->text('answer_a');
            $table->text('answer_b');
            $table->text('answer_c');
            $table->text('answer_d');
            $table->enum('correct_answer',['a','b','c','d']);
            $table->enum('difficulty', [\App\Enums\Difficulty::LOTS->value,\App\Enums\Difficulty::MOTS->value]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simulasi_tpk_questions');
    }
};
