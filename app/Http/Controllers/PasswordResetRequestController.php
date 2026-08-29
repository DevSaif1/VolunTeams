<?php

namespace App\Http\Controllers;

use App\Models\PasswordResetRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PasswordResetRequestController extends Controller
{
    /**
     * Submit a password reset request.
     *
     * Only non-demo accounts use the admin approval flow.
     * The designated Demo Member continues to use OTP.
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

        $user = User::where('email', $email)->first();

        /*
         * Keep the response generic so the system does not
         * reveal whether an account exists.
         */
        if (! $user) {
            return back()
                ->withInput()
                ->with(
                    'status',
                    'If the account exists, a password reset request has been submitted.'
                );
        }

        /*
         * Demo Member uses the OTP flow instead.
         */
        if (
            $user->hasRole('Member') &&
            $user->is_demo_member
        ) {
            return back()
                ->withInput()
                ->with(
                    'status',
                    'This account uses the Demo OTP password recovery.'
                );
        }

        /*
         * Prevent multiple pending requests for the same account.
         */
        $existingRequest = PasswordResetRequest::where('user_id', $user->id)
            ->where('status', 'pending')
            ->exists();

        if ($existingRequest) {
            return back()
                ->with(
                    'status',
                    'A password reset request is already pending administrator approval.'
                );
        }

        /*
         * Create a new request for Admin review.
         */
        PasswordResetRequest::create([
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        return back()
            ->with(
                'status',
                'Your password reset request has been submitted for administrator approval.'
            );
    }
}