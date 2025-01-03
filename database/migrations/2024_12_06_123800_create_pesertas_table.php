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
        Schema::create('pesertas', function (Blueprint $table) {
            $table->id();
            $table->string('nisn')->unique()->nullable();
            $table->string('nama')->nullable();
            $table->enum('jenis_kelamin', ['Putra', 'Putri'])->nullable();
            $table->foreignId('regu_pembina_id')->nullable()->constrained('regu_pembinas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('mata_lomba_id')->nullable()->constrained('mata_lombas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesertas');
    }
};
