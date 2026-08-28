<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetOtp;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PasswordResetOtpController extends Controller
{
    /**
     * Show the email form.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Generate and store a new OTP.
     *
     * Demo mode:
     * The OTP is not sent by email yet.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],
        ]);

        $email = Str::lower($validated['email']);

        /*
         * Rate limit OTP requests.
         *
         * Maximum:
         * 3 requests per 10 minutes per email.
         */
        $rateLimitKey = 'password-reset-otp:' . $email;

        if (RateLimiter::tooManyAttempts($rateLimitKey, 3)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);

            return back()
                ->withInput()
                ->withErrors([
                    'email' => "Too many OTP requests. Please try again in {$seconds} seconds.",
                ]);
        }

        RateLimiter::hit($rateLimitKey, 600);

        /*
         * Check whether the account exists.
         */
        $user = User::where('email', $email)->first();

        /*
         * Do not reveal whether an email exists.
         */
        if (! $user) {
            return back()
                ->with('status', 'If an account exists for this email, a verification code has been generated.');
        }

        /*
         * Remove previous OTP records for this email.
         */
        PasswordResetOtp::where('email', $email)->delete();

        /*
         * Generate a secure 6-digit OTP.
         */
        $otp = (string) random_int(100000, 999999);

        /*
         * Store only the hashed OTP.
         */
        PasswordResetOtp::create([
            'email' => $email,
            'otp_hash' => Hash::make($otp),
            'expires_at' => now()->addMinutes(5),
            'attempts' => 0,
            'verified_at' => null,
        ]);

        /*
         * DEMO MODE
         *
         * The OTP will be shown temporarily through the session.
         * Later we can replace this with real email delivery.
         */
        return redirect()
            ->route('password.otp.verify')
            ->with([
                'otp_email' => $email,
                'demo_otp' => $otp,
            ]);
    }

    /**
     * Show OTP verification page.
     */
    public function showVerify(): View|RedirectResponse
    {
        if (! session()->has('otp_email')) {
            return redirect()
                ->route('password.request')
                ->withErrors([
                    'email' => 'Please request a new verification code.',
                ]);
        }

        return view('auth.verify-otp', [
            'email' => session('otp_email'),
            'demoOtp' => session('demo_otp'),
        ]);
    }

    /**
     * Verify the submitted OTP.
     */
    public function verify(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'otp' => [
                'required',
                'digits:6',
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],
        ]);

        /*
         * Normalize the email.
         */
        $email = Str::lower($validated['email']);

        /*
         * Find the latest OTP for this email.
         */
        $otpRecord = PasswordResetOtp::where('email', $email)
            ->latest()
            ->first();

        /*
         * No active OTP exists.
         */
        if (! $otpRecord) {
            return redirect()
                ->route('password.request')
                ->withErrors([
                    'email' => 'No active verification code was found. Please request a new code.',
                ]);
        }

        /*
         * Check expiration.
         */
        if ($otpRecord->expires_at->isPast()) {
            $otpRecord->delete();

            return redirect()
                ->route('password.request')
                ->withErrors([
                    'email' => 'Your verification code has expired. Please request a new code.',
                ]);
        }

        /*
         * Maximum 5 verification attempts.
         */
        if ($otpRecord->attempts >= 5) {
            $otpRecord->delete();

            return redirect()
                ->route('password.request')
                ->withErrors([
                    'email' => 'Too many incorrect attempts. Please request a new code.',
                ]);
        }

        /*
         * Check OTP.
         */
        if (! Hash::check($validated['otp'], $otpRecord->otp_hash)) {
            $otpRecord->increment('attempts');

            return back()
                ->withErrors([
                    'otp' => 'The verification code is incorrect.',
                ])
                ->withInput();
        }

        /*
         * Mark OTP as verified.
         */
        $otpRecord->update([
            'verified_at' => now(),
        ]);

        /*
         * Store the verified email temporarily.
         */
        session([
            'password_reset_verified_email' => $email,
        ]);

        /*
         * Remove the OTP record after successful verification.
         */
        $otpRecord->delete();

        /*
         * Clear the old OTP session values.
         */
        session()->forget([
            'otp_email',
            'demo_otp',
        ]);

        return redirect()->route('password.otp.reset');
    }

    /**
     * Show the new password form.
     */
    public function showReset(): View|RedirectResponse
    {
        if (! session()->has('password_reset_verified_email')) {
            return redirect()
                ->route('password.request')
                ->withErrors([
                    'email' => 'Please verify your identity first.',
                ]);
        }

        return view('auth.otp-reset-password');
    }

    /**
     * Update the user's password after successful OTP verification.
     */
    public function resetPassword(Request $request): RedirectResponse
    {
        $email = session('password_reset_verified_email');

        if (! $email) {
            return redirect()
                ->route('password.request')
                ->withErrors([
                    'email' => 'Your password reset session has expired.',
                ]);
        }

        $validated = $request->validate([
            'password' => [
                'required',
                'confirmed',
                'string',
                'min:8',
            ],
        ]);

        $user = User::where('email', $email)->first();

        if (! $user) {
            return redirect()
                ->route('password.request')
                ->withErrors([
                    'email' => 'Unable to complete the password reset.',
                ]);
        }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        /*
         * Remove any remaining OTP records.
         */
        PasswordResetOtp::where('email', $email)->delete();

        /*
         * Clear password reset session.
         */
        session()->forget('password_reset_verified_email');

        return redirect()
            ->route('login')
            ->with(
                'status',
                'Your password has been reset successfully. You can now log in.'
            );
    }
}