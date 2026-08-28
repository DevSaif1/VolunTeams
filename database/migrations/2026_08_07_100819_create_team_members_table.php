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
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('team_id')
                  ->constrained('teams')
                  ->restrictOnDelete();
                  
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->restrictOnDelete();
            
            $table->string('status', 20); // Values: pending, active, rejected, left
            $table->timestamp('joined_at')->nullable();
            
            $table->timestamps();

            // Prevent duplicate membership records for the same user in the same team
            $table->unique(['team_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};