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
        Schema::create('upload_dokumens', function (Blueprint $table) {
            $table->id();
            $table->string('file');
            $table->boolean('status')->default(0);
            $table->string('keterangan')->nullable();
            $table->foreignId('pembina_id')->constrained('pembinas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upload_dokumens');
    }
};
