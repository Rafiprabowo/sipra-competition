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
        Schema::create('simulasi_sms_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('simulasi_sms_question_image_id')->constrained('simulasi_sms_question_images')->cascadeOnDelete();
            $table->string('answer')->nullable();
            $table->string('nama')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simulasi_sms_answers');
    }
};
