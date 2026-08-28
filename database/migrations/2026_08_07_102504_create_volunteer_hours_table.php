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
        Schema::create('volunteer_hours', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->restrictOnDelete();
                  
            $table->foreignId('opportunity_id')
                  ->constrained('opportunities')
                  ->restrictOnDelete();
                  
            $table->foreignId('approved_by')
                  ->constrained('users')
                  ->restrictOnDelete();
            
            $table->decimal('hours', 5, 2);
            $table->date('date_logged');
            $table->text('notes')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteer_hours');
    }
};