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
        // pivot table for many-to-many relationship
        Schema::create('prompt_label', function (Blueprint $table) {
            $table->uuid('prompt_id');
            $table->foreign('prompt_id')->references('id')->on('prompts')->onDelete('cascade');
        
            $table->unsignedBigInteger('label_id');
            $table->foreign('label_id')->references('id')->on('label')->onDelete('cascade');
        
            // Add any additional columns if necessary
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
