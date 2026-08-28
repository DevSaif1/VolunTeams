<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display all users.
     *
     * Admin only.
     */
    public function index(): View
    {
        $user = auth()->user();

        if (! $user->hasRole('Admin')) {
            abort(403);
        }

        $users = User::with('roles')
            ->latest()
            ->paginate(10);

        return view('users.index', compact('users'));
    }


    /**
     * Show the form for editing a user's role.
     *
     * Admin only.
     */
    public function edit(User $user): View
    {
        $currentUser = auth()->user();

        if (! $currentUser->hasRole('Admin')) {
            abort(403);
        }

        /*
         * Only these roles can be assigned
         * through User Management.
         */
        $roles = [
            'Member',
            'Team Manager',
        ];

        return view('users.edit', compact('user', 'roles'));
    }


    /**
     * Update the selected user's role.
     *
     * Admin only.
     */
    public function update(
        Request $request,
        User $user
    ): RedirectResponse {

        $currentUser = auth()->user();

        if (! $currentUser->hasRole('Admin')) {
            abort(403);
        }

        /*
         * Prevent the Admin from changing
         * their own role accidentally.
         */
        if ($user->id === $currentUser->id) {
            return back()->withErrors([
                'role' => 'You cannot change your own role.',
            ]);
        }

        $validated = $request->validate([
            'role' => [
                'required',
                'string',
                'in:Member,Team Manager',
            ],
        ]);

        /*
         * Remove the user's existing roles
         * and assign the selected role.
         */
        $user->syncRoles([$validated['role']]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User role updated successfully.');
    }
}