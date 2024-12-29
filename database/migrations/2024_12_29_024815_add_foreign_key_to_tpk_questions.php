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
        Schema::table('tpk_questions', function (Blueprint $table) {
            $table->foreignId('cbt_session_id')->constrained('cbt_sessions')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tpk_questions', function (Blueprint $table) {
            $table->dropForeign('cbt_session_id');
            $table->dropColumn('cbt_session_id');
        });
    }
};
