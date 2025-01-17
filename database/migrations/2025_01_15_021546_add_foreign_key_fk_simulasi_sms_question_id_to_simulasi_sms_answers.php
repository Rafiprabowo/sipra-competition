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
        Schema::table('simulasi_sms_answers', function (Blueprint $table) {
            $table->unsignedBigInteger('simulasi_sms_question_id')->nullable();
            $table->foreign('simulasi_sms_question_id')->references('id')->on('simulasi_sms_questions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('simulasi_sms_answers', function (Blueprint $table) {
            $table->dropColumn('simulasi_sms_question_id');
            $table->dropForeign('simulasi_sms_question_id');
        });
    }
};
