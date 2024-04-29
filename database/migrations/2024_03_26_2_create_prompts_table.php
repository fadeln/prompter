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
        Schema::create('prompts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('judul');
            $table->longText('prompt');
            $table->foreignId('kategori_id')->constrained('kategori');
            $table->foreignId('label_id')->nullable()->constrained('label');
            // $table->foreign('label_id')->references('id')->on('label')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diubah_pada')->useCurrent()->nullable()->default(null)->onUpdate('CURRENT_TIMESTAMP');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prompts');
    }
};
