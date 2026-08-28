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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            
            // Foreign key linking to the users table; restricted to prevent accidental cascading deletion
            $table->foreignId('manager_id')
                  ->constrained('users')
                  ->restrictOnDelete();
            
            $table->string('name', 150);
            $table->text('description');
            
            $table->string('logo_path')->nullable();
            $table->string('email', 150)->nullable();
            $table->string('phone', 25)->nullable();
            $table->string('address')->nullable();
            
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};