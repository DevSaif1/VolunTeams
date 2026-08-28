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
        Schema::create('opportunities', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('team_id')
                  ->constrained('teams')
                  ->restrictOnDelete();
            
            $table->string('title', 150);
            $table->text('description');
            $table->string('image_path')->nullable();
            $table->string('location', 255);
            $table->string('type', 20); // Values: onsite, remote, hybrid
            
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->dateTime('application_deadline');
            
            $table->unsignedInteger('required_volunteers');
            $table->decimal('hours', 5, 2);
            
            $table->string('status', 20); // Values: draft, published, closed, completed, cancelled
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opportunities');
    }
};