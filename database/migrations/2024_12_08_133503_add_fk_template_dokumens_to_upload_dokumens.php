<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('upload_dokumens', function (Blueprint $table) {
            $table->foreignId('template_dokumens_id')->constrained('template_dokumens')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('upload_dokumens', function (Blueprint $table) {
            $table->dropForeign('upload_dokumens_template_dokumens_id_foreign');
        });
    }
};
