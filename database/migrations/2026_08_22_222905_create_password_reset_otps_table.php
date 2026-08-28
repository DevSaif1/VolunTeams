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
        Schema::create('password_reset_otps', function (Blueprint $table) {
            $table->id();

            // User email associated with this reset request.
            $table->string('email')->index();

            // Store a hashed OTP, never the plain OTP.
            $table->string('otp_hash');

            // OTP expiration time.
            $table->timestamp('expires_at');

            // Number of failed verification attempts.
            $table->unsignedTinyInteger('attempts')->default(0);

            // Set when the OTP has been successfully verified.
            $table->timestamp('verified_at')->nullable();

            $table->timestamps();

            $table->index(['email', 'expires_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_otps');
    }
};