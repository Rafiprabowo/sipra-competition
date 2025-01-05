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
            $table->enum('type', [\App\Enums\SymbolType::Semaphore->value, \App\Enums\SymbolType::Morse->value]);
            $table->string('word');
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
