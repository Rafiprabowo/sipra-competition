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
        Schema::create('sms_question_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sms_question_id')->constrained('sms_questions')->cascadeOnDelete();
            $table->foreignId('symbol_id')->constrained('symbols')->cascadeOnDelete();
            $table->integer('order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sms_question_images');
    }
};
