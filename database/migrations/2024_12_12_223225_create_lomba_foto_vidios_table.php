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
        Schema::create('lomba_foto_vidios', function (Blueprint $table) {
            $table->id();
            $table->string('file');
            $table->string('file_name')->nullable();
            $table->foreignId('mata_lomba_id')->constrained('mata_lombas');
            $table->foreignId('pembina_id')->constrained('pembinas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lomba_foto_vidios');
    }
};
