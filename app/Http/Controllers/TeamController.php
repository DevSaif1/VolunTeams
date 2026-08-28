<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TeamController extends Controller
{
    /**
     * Display a paginated listing of teams.
     *
     * Admin: all teams
     * Team Manager: their own teams
     * Member: all teams
     */
    public function index(): View
    {
        $user = auth()->user();

        // Admin can view all teams.
        if ($user->hasRole('Admin')) {
            $teams = Team::with('manager')
                ->withCount(['opportunities', 'members'])
                ->latest()
                ->paginate(10);

            return view('teams.index', compact('teams'));
        }

        // Team Manager can view only teams they manage.
        if ($user->hasRole('Team Manager')) {
            $teams = Team::where('manager_id', $user->id)
                ->with('manager')
                ->withCount(['opportunities', 'members'])
                ->latest()
                ->paginate(10);

            return view('teams.index', compact('teams'));
        }

        // Member can browse teams.
        if ($user->hasRole('Member')) {
            $teams = Team::with('manager')
                ->withCount(['opportunities', 'members'])
                ->latest()
                ->paginate(10);

            return view('teams.index', compact('teams'));
        }

        abort(403);
    }

    /**
     * Show the form for creating a new team.
     *
     * Only Admin can create teams.
     */
    public function create(): View
    {
        $user = auth()->user();

        if (! $user->hasRole('Admin')) {
            abort(403);
        }

        $managers = User::role('Team Manager')
            ->select(['id', 'name', 'email'])
            ->orderBy('name')
            ->get();

        return view('teams.create', compact('managers'));
    }

    /**
     * Store a newly created team.
     *
     * Only Admin can create teams.
     */
    public function store(StoreTeamRequest $request): RedirectResponse
    {
        $user = auth()->user();

        if (! $user->hasRole('Admin')) {
            abort(403);
        }

        $validated = $request->validated();

        // Make sure the selected manager actually has the Team Manager role.
        $managerExists = User::role('Team Manager')
            ->where('id', $validated['manager_id'])
            ->exists();

        if (! $managerExists) {
            abort(403);
        }

        if ($request->hasFile('logo_path')) {
            $validated['logo_path'] = $request
                ->file('logo_path')
                ->store('logos', 'public');
        }

        $team = Team::create($validated);

        return redirect()
            ->route('teams.show', $team)
            ->with('success', 'Team created successfully.');
    }

    /**
     * Display the specified team.
     *
     * Admin: any team
     * Team Manager: their own team
     * Member: any team
     */
    public function show(Team $team): View
    {
        $user = auth()->user();

        // Admin can view any team.
        if ($user->hasRole('Admin')) {
            $team->load(['manager', 'opportunities']);

            return view('teams.show', compact('team'));
        }

        // Team Manager can view only their own team.
        if ($user->hasRole('Team Manager')) {
            if ($team->manager_id !== $user->id) {
                abort(403);
            }

            $team->load(['manager', 'opportunities']);

            return view('teams.show', compact('team'));
        }

        // Member can view teams.
        if ($user->hasRole('Member')) {
            $team->load(['manager', 'opportunities']);

            return view('teams.show', compact('team'));
        }

        abort(403);
    }

    /**
     * Show the form for editing the specified team.
     *
     * Only Admin can edit teams.
     */
    public function edit(Team $team): View
    {
        $user = auth()->user();

        if (! $user->hasRole('Admin')) {
            abort(403);
        }

        $managers = User::role('Team Manager')
            ->select(['id', 'name', 'email'])
            ->orderBy('name')
            ->get();

        return view('teams.edit', compact('team', 'managers'));
    }

    /**
     * Update the specified team.
     *
     * Only Admin can update teams.
     */
    public function update(
        UpdateTeamRequest $request,
        Team $team
    ): RedirectResponse {
        $user = auth()->user();

        if (! $user->hasRole('Admin')) {
            abort(403);
        }

        $validated = $request->validated();

        // Make sure the selected manager has the Team Manager role.
        $managerExists = User::role('Team Manager')
            ->where('id', $validated['manager_id'])
            ->exists();

        if (! $managerExists) {
            abort(403);
        }

        if ($request->hasFile('logo_path')) {
            if (
                $team->logo_path &&
                Storage::disk('public')->exists($team->logo_path)
            ) {
                Storage::disk('public')->delete($team->logo_path);
            }

            $validated['logo_path'] = $request
                ->file('logo_path')
                ->store('logos', 'public');
        }

        $team->update($validated);

        return redirect()
            ->route('teams.show', $team)
            ->with('success', 'Team updated successfully.');
    }

    /**
     * Remove the specified team.
     *
     * Only Admin can delete teams.
     */
    public function destroy(Team $team): RedirectResponse
    {
        $user = auth()->user();

        if (! $user->hasRole('Admin')) {
            abort(403);
        }

        if (
            $team->logo_path &&
            Storage::disk('public')->exists($team->logo_path)
        ) {
            Storage::disk('public')->delete($team->logo_path);
        }

        $team->delete();

        return redirect()
            ->route('teams.index')
            ->with('success', 'Team deleted successfully.');
    }
}