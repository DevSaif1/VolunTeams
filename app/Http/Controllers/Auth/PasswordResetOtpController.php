<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetOtp;
use App\Models\PasswordResetRequest;
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
     * Show the forgot password form.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle password recovery.
     *
     * Demo Member:
     * Uses the visible Demo OTP flow.
     *
     * Admin / Manager:
     * Creates an Admin-approved password reset request.
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
         * Rate limit password recovery requests.
         *
         * Maximum:
         * 3 requests per 10 minutes per email.
         */
        $rateLimitKey = 'password-reset:' . $email;

        if (RateLimiter::tooManyAttempts($rateLimitKey, 3)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);

            return back()
                ->withInput()
                ->withErrors([
                    'email' => "Too many password reset requests. Please try again in {$seconds} seconds.",
                ]);
        }

        RateLimiter::hit($rateLimitKey, 600);

        /*
         * Find the account.
         */
        $user = User::where('email', $email)->first();

        /*
         * Do not reveal whether an account exists.
         */
        if (! $user) {
            return back()
                ->withInput()
                ->with(
                    'status',
                    'If this account is eligible, a verification code has been generated.'
                );
        }

        /*
         * ==========================================================
         * DEMO MEMBER FLOW
         * ==========================================================
         *
         * Only the designated Demo Member receives
         * the visible Demo OTP.
         */
        if (
            $user->hasRole('Member') &&
            $user->is_demo_member
        ) {
            /*
             * Remove previous OTP records.
             */
            PasswordResetOtp::where('email', $email)->delete();

            /*
             * Generate secure 6-digit OTP.
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
             * Demo mode:
             * Show OTP temporarily through the session.
             */
            return redirect()
                ->route('password.otp.verify')
                ->with([
                    'otp_email' => $email,
                    'demo_otp' => $otp,
                ]);
        }

        /*
         * ==========================================================
         * ADMIN APPROVAL FLOW
         * ==========================================================
         *
         * Admin and Manager accounts cannot use Demo OTP.
         *
         * A password reset request must first be approved
         * by an Administrator.
         */

        /*
         * ----------------------------------------------------------
         * 1. Check whether this browser already owns a reset request.
         * ----------------------------------------------------------
         */
        $sessionRequestId = session('password_reset_request_id');
        $sessionRequestToken = session('password_reset_request_token');

        if ($sessionRequestId && $sessionRequestToken) {
            $existingSessionRequest = PasswordResetRequest::where('id', $sessionRequestId)
                ->where('user_id', $user->id)
                ->first();

            if ($existingSessionRequest) {
                /*
                 * Verify the session token.
                 */
                $validSessionToken = false;

                if ($existingSessionRequest->request_token_hash) {
                    $validSessionToken = Hash::check(
                        $sessionRequestToken,
                        $existingSessionRequest->request_token_hash
                    );
                }

                if ($validSessionToken) {

                    /*
                     * If Admin already approved this request,
                     * authorize the current session for password reset.
                     */
                    if ($existingSessionRequest->status === 'approved') {
                        session([
                            'approved_password_reset_request_id' =>
                                $existingSessionRequest->id,

                            'password_reset_approved_user_id' =>
                                $user->id,
                        ]);

                        return redirect()
                            ->route('password.otp.reset')
                            ->with(
                                'status',
                                'Your password reset request has been approved. You can now choose a new password.'
                            );
                    }

                    /*
                     * If request is still pending.
                     */
                    if ($existingSessionRequest->status === 'pending') {
                        return back()
                            ->with(
                                'status',
                                'A password reset request is already pending administrator approval.'
                            );
                    }

                    /*
                     * If rejected or completed, clear old session.
                     */
                    session()->forget([
                        'password_reset_request_id',
                        'password_reset_request_user_id',
                        'password_reset_request_token',
                        'approved_password_reset_request_id',
                        'password_reset_approved_user_id',
                    ]);
                }
            }
        }

        /*
         * ----------------------------------------------------------
         * 2. IMPORTANT:
         *    Check for an already-approved request for this user.
         *
         * This allows the user to return later, enter the email again,
         * and continue after Admin approval even if the old browser
         * session data was lost.
         * ----------------------------------------------------------
         */
        $approvedRequest = PasswordResetRequest::where('user_id', $user->id)
            ->where('status', 'approved')
            ->latest()
            ->first();

        if ($approvedRequest) {

            /*
             * Generate a fresh secure token for the current session.
             */
            $requestToken = Str::random(64);

            /*
             * Store only the HASH in the database.
             */
            $approvedRequest->update([
                'request_token_hash' => Hash::make($requestToken),
            ]);

            /*
             * Store the raw token only in the current session.
             */
            session([
                'password_reset_request_id' => $approvedRequest->id,
                'password_reset_request_user_id' => $user->id,
                'password_reset_request_token' => $requestToken,

                'approved_password_reset_request_id' => $approvedRequest->id,
                'password_reset_approved_user_id' => $user->id,
            ]);

            return redirect()
                ->route('password.otp.reset')
                ->with(
                    'status',
                    'Your password reset request has been approved. You can now choose a new password.'
                );
        }

        /*
         * ----------------------------------------------------------
         * 3. Check for an existing pending request.
         * ----------------------------------------------------------
         */
        $pendingRequest = PasswordResetRequest::where('user_id', $user->id)
            ->where('status', 'pending')
            ->latest()
            ->first();

        if ($pendingRequest) {
            return back()
                ->with(
                    'status',
                    'A password reset request is already pending administrator approval.'
                );
        }

        /*
         * ----------------------------------------------------------
         * 4. Create a new password reset request.
         * ----------------------------------------------------------
         */

        /*
         * Create a secure random request token.
         */
        $requestToken = Str::random(64);

        /*
         * Create the password reset request.
         *
         * Only the HASH of the token is stored.
         */
        $passwordResetRequest = PasswordResetRequest::create([
            'user_id' => $user->id,
            'status' => 'pending',
            'approved_by' => null,
            'approved_at' => null,
            'rejected_at' => null,
            'admin_note' => null,
            'request_token_hash' => Hash::make($requestToken),
        ]);

        /*
         * Store the raw token only in the current session.
         */
        session([
            'password_reset_request_id' => $passwordResetRequest->id,
            'password_reset_request_user_id' => $user->id,
            'password_reset_request_token' => $requestToken,
        ]);

        return back()
            ->with(
                'status',
                'Your password reset request has been submitted for administrator approval.'
            );
    }

    /**
     * Show OTP verification page.
     *
     * Only the Demo Member can reach this page.
     */
    public function showVerify(): View|RedirectResponse
    {
        $email = session('otp_email');

        if (! $email) {
            return redirect()
                ->route('password.request')
                ->withErrors([
                    'email' => 'Please request a new verification code.',
                ]);
        }

        /*
         * Verify that the account is still an eligible Demo Member.
         */
        $user = User::where('email', $email)->first();

        if (
            ! $user ||
            ! $user->hasRole('Member') ||
            ! $user->is_demo_member
        ) {
            session()->forget([
                'otp_email',
                'demo_otp',
            ]);

            return redirect()
                ->route('password.request')
                ->withErrors([
                    'email' => 'This account is not eligible for password recovery.',
                ]);
        }

        return view('auth.verify-otp', [
            'email' => $email,
            'demoOtp' => session('demo_otp'),
        ]);
    }

    /**
     * Verify the submitted Demo OTP.
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

        $email = Str::lower($validated['email']);

        /*
         * Verify that this account is still an eligible Demo Member.
         */
        $user = User::where('email', $email)->first();

        if (
            ! $user ||
            ! $user->hasRole('Member') ||
            ! $user->is_demo_member
        ) {
            session()->forget([
                'otp_email',
                'demo_otp',
                'password_reset_verified_email',
                'password_reset_verified_user_id',
            ]);

            return redirect()
                ->route('password.request')
                ->withErrors([
                    'email' => 'This account is not eligible for password recovery.',
                ]);
        }

        /*
         * Find the latest OTP.
         */
        $otpRecord = PasswordResetOtp::where('email', $email)
            ->latest()
            ->first();

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
         * OTP verified successfully.
         */
        $otpRecord->update([
            'verified_at' => now(),
        ]);

        /*
         * Store verified user information temporarily.
         */
        session([
            'password_reset_verified_email' => $email,
            'password_reset_verified_user_id' => $user->id,
        ]);

        /*
         * Remove OTP record.
         */
        $otpRecord->delete();

        /*
         * Clear old OTP session values.
         */
        session()->forget([
            'otp_email',
            'demo_otp',
        ]);

        return redirect()->route('password.otp.reset');
    }

    /**
     * Show the new password form.
     *
     * Supports:
     * 1. Demo Member after successful OTP verification.
     * 2. Admin / Manager after Admin approval.
     */
    public function showReset(): View|RedirectResponse
    {
        /*
         * ==========================================================
         * DEMO MEMBER
         * ==========================================================
         */
        $verifiedEmail = session('password_reset_verified_email');

        if ($verifiedEmail) {
            $user = User::where('email', $verifiedEmail)->first();

            if (
                $user &&
                $user->hasRole('Member') &&
                $user->is_demo_member
            ) {
                return view('auth.otp-reset-password');
            }

            session()->forget([
                'password_reset_verified_email',
                'password_reset_verified_user_id',
            ]);
        }

        /*
         * ==========================================================
         * ADMIN / MANAGER
         * ==========================================================
         *
         * Require an approved request belonging to the
         * current browser session.
         */
        $requestId = session('approved_password_reset_request_id');
        $userId = session('password_reset_approved_user_id');
        $requestToken = session('password_reset_request_token');

        if ($requestId && $userId && $requestToken) {
            $passwordResetRequest = PasswordResetRequest::with('user')
                ->where('id', $requestId)
                ->where('user_id', $userId)
                ->where('status', 'approved')
                ->first();

            if (
                $passwordResetRequest &&
                $passwordResetRequest->user &&
                $passwordResetRequest->request_token_hash &&
                Hash::check(
                    $requestToken,
                    $passwordResetRequest->request_token_hash
                )
            ) {
                return view('auth.otp-reset-password');
            }

            session()->forget([
                'approved_password_reset_request_id',
                'password_reset_approved_user_id',
                'password_reset_request_token',
            ]);
        }

        return redirect()
            ->route('password.request')
            ->withErrors([
                'email' => 'Your password reset request has not been approved.',
            ]);
    }

    /**
     * Update the user's password.
     */
    public function resetPassword(Request $request): RedirectResponse
    {
        /*
         * ==========================================================
         * DEMO MEMBER RESET
         * ==========================================================
         */
        $verifiedEmail = session('password_reset_verified_email');

        if ($verifiedEmail) {
            $user = User::where('email', $verifiedEmail)->first();

            if (
                $user &&
                $user->hasRole('Member') &&
                $user->is_demo_member
            ) {
                return $this->performPasswordReset(
                    $request,
                    $user,
                    'demo'
                );
            }

            session()->forget([
                'password_reset_verified_email',
                'password_reset_verified_user_id',
            ]);
        }

        /*
         * ==========================================================
         * ADMIN APPROVED RESET
         * ==========================================================
         */
        $requestId = session('approved_password_reset_request_id');
        $userId = session('password_reset_approved_user_id');
        $requestToken = session('password_reset_request_token');

        if (! $requestId || ! $userId || ! $requestToken) {
            return redirect()
                ->route('password.request')
                ->withErrors([
                    'email' => 'Your password reset session has expired.',
                ]);
        }

        /*
         * Find the approved request.
         */
        $passwordResetRequest = PasswordResetRequest::with('user')
            ->where('id', $requestId)
            ->where('user_id', $userId)
            ->where('status', 'approved')
            ->first();

        /*
         * Verify the request token.
         */
        if (
            ! $passwordResetRequest ||
            ! $passwordResetRequest->user ||
            ! $passwordResetRequest->request_token_hash ||
            ! Hash::check(
                $requestToken,
                $passwordResetRequest->request_token_hash
            )
        ) {
            session()->forget([
                'approved_password_reset_request_id',
                'password_reset_approved_user_id',
                'password_reset_request_token',
            ]);

            return redirect()
                ->route('password.request')
                ->withErrors([
                    'email' => 'This password reset request is no longer valid.',
                ]);
        }

        /*
         * Change the password.
         */
        return $this->performPasswordReset(
            $request,
            $passwordResetRequest->user,
            'approved'
        );
    }

    /**
     * Perform the actual password update.
     */
    private function performPasswordReset(
        Request $request,
        User $user,
        string $flow
    ): RedirectResponse {
        $validated = $request->validate([
            'password' => [
                'required',
                'confirmed',
                'string',
                'min:8',
            ],
        ]);

        /*
         * Update password.
         */
        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        /*
         * Remove any remaining OTP records.
         */
        PasswordResetOtp::where('email', $user->email)->delete();

        /*
         * If this was an Admin-approved request,
         * mark it as completed.
         */
        if ($flow === 'approved') {
            $requestId = session('approved_password_reset_request_id');

            if ($requestId) {
                PasswordResetRequest::where('id', $requestId)
                    ->where('user_id', $user->id)
                    ->where('status', 'approved')
                    ->update([
                        'status' => 'completed',
                    ]);
            }
        }

        /*
         * Clear all password-reset session data.
         */
        session()->forget([
            'password_reset_verified_email',
            'password_reset_verified_user_id',
            'approved_password_reset_request_id',
            'password_reset_approved_user_id',
            'password_reset_request_id',
            'password_reset_request_user_id',
            'password_reset_request_token',
            'otp_email',
            'demo_otp',
        ]);

        return redirect()
            ->route('login')
            ->with(
                'status',
                'Your password has been reset successfully. You can now log in.'
            );
    }
}