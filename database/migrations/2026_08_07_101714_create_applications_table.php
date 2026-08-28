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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('opportunity_id')
                  ->constrained('opportunities')
                  ->restrictOnDelete();
                  
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->restrictOnDelete();
            
            $table->text('reason')->nullable();
            $table->text('manager_notes')->nullable();
            
            $table->string('status', 20);
            
            $table->timestamp('applied_at')->useCurrent();
            $table->timestamps();

            // Prevent duplicate applications from the same user for the same opportunity
            $table->unique(['opportunity_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};