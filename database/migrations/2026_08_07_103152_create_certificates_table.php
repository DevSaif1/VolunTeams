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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->restrictOnDelete();
                  
            $table->foreignId('opportunity_id')
                  ->nullable()
                  ->constrained('opportunities')
                  ->restrictOnDelete();
                  
            $table->foreignId('issued_by')
                  ->constrained('users')
                  ->restrictOnDelete();
            
            $table->string('certificate_code', 100)->unique();
            $table->string('file_path');
            $table->string('verification_url', 255)->nullable();
            
            $table->timestamp('issued_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};