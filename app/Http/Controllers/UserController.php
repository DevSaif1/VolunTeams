<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display all users.
     * Super Admin, Admin, or Demo Admin (View only).
     */
    public function index(): View
    {
        $user = auth()->user();

        // السماح لـ Super Admin و Admin و Demo Admin برؤية القائمة فقط
        if (! $user->hasAnyRole(['Super Admin', 'Admin', 'Demo Admin'])) {
            abort(403);
        }

        $users = User::with('roles')
            ->latest()
            ->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new administrator or user.
     * Super Admin or Admin only.
     */
    public function create(): View
    {
        $currentUser = auth()->user();

        if (! $currentUser->hasAnyRole(['Super Admin', 'Admin'])) {
            abort(403);
        }

        // Available roles that can be assigned based on privilege
        $roles = $currentUser->hasRole('Super Admin')
            ? ['Super Admin', 'Admin', 'Demo Admin', 'Team Manager', 'Member']
            : ['Admin', 'Demo Admin', 'Team Manager', 'Member'];

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created user/admin in database.
     * Super Admin or Admin only.
     */
    public function store(Request $request): RedirectResponse
    {
        $currentUser = auth()->user();

        if (! $currentUser->hasAnyRole(['Super Admin', 'Admin'])) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string', 'in:Super Admin,Admin,Demo Admin,Team Manager,Member'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'email_verified_at' => now(),
            'is_demo_member' => $validated['role'] === 'Demo Admin',
        ]);

        $user->assignRole($validated['role']);

        return redirect()
            ->route('users.index')
            ->with('success', 'User / Administrator created successfully.');
    }

    /**
     * Show the form for editing a user's role.
     * Super Admin or Admin only.
     */
    public function edit(User $user): View
    {
        $currentUser = auth()->user();

        if (! $currentUser->hasAnyRole(['Super Admin', 'Admin'])) {
            abort(403);
        }

        // Prevent non-super-admins from editing Super Admin accounts
        if ($user->hasRole('Super Admin') && ! $currentUser->hasRole('Super Admin')) {
            abort(403);
        }

        $roles = ['Super Admin', 'Admin', 'Demo Admin', 'Team Manager', 'Member'];

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the selected user's role.
     * Super Admin or Admin only.
     */
    public function update(
        Request $request,
        User $user
    ): RedirectResponse {

        $currentUser = auth()->user();

        if (! $currentUser->hasAnyRole(['Super Admin', 'Admin'])) {
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
                'in:Super Admin,Admin,Demo Admin,Team Manager,Member',
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