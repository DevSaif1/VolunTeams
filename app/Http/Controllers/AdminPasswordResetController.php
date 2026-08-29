<?php

namespace App\Http\Controllers;

use App\Models\PasswordResetRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminPasswordResetController extends Controller
{
    /**
     * Display pending password reset requests.
     */
    public function index(): View
    {
        $requests = PasswordResetRequest::with('user')
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.password-reset-requests', [
            'requests' => $requests,
        ]);
    }

    /**
     * Approve a password reset request.
     */
    public function approve(
        Request $request,
        PasswordResetRequest $passwordResetRequest
    ): RedirectResponse {
        /*
         * Only pending requests can be approved.
         */
        if ($passwordResetRequest->status !== 'pending') {
            return back()->withErrors([
                'request' => __('password_reset.already_processed'),
            ]);
        }

        /*
         * Make sure the requested user still exists.
         */
        if (! $passwordResetRequest->user) {
            return back()->withErrors([
                'request' => __('password_reset.user_not_found'),
            ]);
        }

        /*
         * Prevent an administrator from approving
         * a request for their own account.
         */
        if ($passwordResetRequest->user_id === $request->user()->id) {
            return back()->withErrors([
                'request' => __('password_reset.cannot_approve_self'),
            ]);
        }

        /*
         * Approve the request.
         *
         * IMPORTANT:
         * We do NOT change the user's password here.
         *
         * Approval only authorizes the requested password
         * reset process to continue.
         */
        $passwordResetRequest->update([
            'status' => 'approved',
            'approved_by' => $request->user()->id,
            'approved_at' => now(),
            'rejected_at' => null,
        ]);

        return back()->with(
            'status',
            __('password_reset.approved_successfully')
        );
    }

    /**
     * Reject a password reset request.
     */
    public function reject(
        Request $request,
        PasswordResetRequest $passwordResetRequest
    ): RedirectResponse {
        /*
         * Only pending requests can be rejected.
         */
        if ($passwordResetRequest->status !== 'pending') {
            return back()->withErrors([
                'request' => __('password_reset.already_processed'),
            ]);
        }

        /*
         * Make sure the requested user still exists.
         */
        if (! $passwordResetRequest->user) {
            return back()->withErrors([
                'request' => __('password_reset.user_not_found'),
            ]);
        }

        /*
         * Reject the request.
         */
        $passwordResetRequest->update([
            'status' => 'rejected',
            'rejected_at' => now(),
            'approved_by' => null,
            'approved_at' => null,
        ]);

        return back()->with(
            'status',
            __('password_reset.rejected_successfully')
        );
    }
}