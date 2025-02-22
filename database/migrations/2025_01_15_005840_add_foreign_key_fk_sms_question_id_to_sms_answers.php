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
        Schema::table('sms_answers', function (Blueprint $table) {
            $table->unsignedBigInteger('sms_question_id')->nullable();
            $table->foreign('sms_question_id')->references('id')->on('sms_questions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sms_answers', function (Blueprint $table) {
            $table->dropColumn('sms_question_id');
            $table->dropForeign('sms_question_id');
        });
    }
};
