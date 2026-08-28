<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOpportunityRequest;
use App\Http\Requests\UpdateOpportunityRequest;
use App\Models\Opportunity;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class OpportunityController extends Controller
{
    /**
     * Display a paginated listing of opportunities.
     *
     * Admin: all opportunities
     * Team Manager: opportunities belonging to their teams
     * Member: active opportunities
     */
    public function index(): View
    {
        $user = auth()->user();

        // Admin can view all opportunities.
        if ($user->hasRole('Admin')) {
            $opportunities = Opportunity::with('team')
                ->withCount(['applications', 'volunteerHours'])
                ->latest()
                ->paginate(10);

            return view('opportunities.index', compact('opportunities'));
        }

        // Team Manager can view opportunities belonging to their teams.
        if ($user->hasRole('Team Manager')) {
            $teamIds = Team::where('manager_id', $user->id)->pluck('id');

            $opportunities = Opportunity::whereIn('team_id', $teamIds)
                ->with('team')
                ->withCount(['applications', 'volunteerHours'])
                ->latest()
                ->paginate(10);

            return view('opportunities.index', compact('opportunities'));
        }

        // Member can browse active opportunities.
        if ($user->hasRole('Member')) {
            $opportunities = Opportunity::where('is_active', true)
                ->with('team')
                ->withCount(['applications', 'volunteerHours'])
                ->latest()
                ->paginate(10);

            return view('opportunities.index', compact('opportunities'));
        }

        abort(403);
    }

    /**
     * Show the form for creating a new opportunity.
     *
     * Only Admin and Team Manager are allowed.
     */
    public function create(): View
    {
        $user = auth()->user();

        if (! $user->hasAnyRole(['Admin', 'Team Manager'])) {
            abort(403);
        }

        // Admin can create opportunities for any team.
        if ($user->hasRole('Admin')) {
            $teams = Team::select(['id', 'name'])
                ->orderBy('name')
                ->get();

            return view('opportunities.create', compact('teams'));
        }

        // Team Manager can create opportunities only for their teams.
        $teams = Team::where('manager_id', $user->id)
            ->select(['id', 'name'])
            ->orderBy('name')
            ->get();

        return view('opportunities.create', compact('teams'));
    }

    /**
     * Store a newly created opportunity.
     *
     * Only Admin and Team Manager are allowed.
     */
    public function store(StoreOpportunityRequest $request): RedirectResponse
    {
        $user = auth()->user();

        if (! $user->hasAnyRole(['Admin', 'Team Manager'])) {
            abort(403);
        }

        $validated = $request->validated();

        /*
         * Team Manager can only create an opportunity
         * for a team that they manage.
         */
        if ($user->hasRole('Team Manager')) {
            $teamBelongsToManager = Team::where('id', $validated['team_id'])
                ->where('manager_id', $user->id)
                ->exists();

            if (! $teamBelongsToManager) {
                abort(403);
            }
        }

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request
                ->file('image_path')
                ->store('opportunities', 'public');
        }

        $opportunity = Opportunity::create($validated);

        return redirect()
            ->route('opportunities.show', $opportunity)
            ->with('success', 'Opportunity created successfully.');
    }

    /**
     * Display the specified opportunity.
     *
     * Admin and Manager can view according to their scope.
     * Member can view active opportunities.
     */
    public function show(Opportunity $opportunity): View
    {
        $user = auth()->user();

        // Admin can view any opportunity.
        if ($user->hasRole('Admin')) {
            $opportunity->load([
                'team',
                'applications',
                'volunteerHours'
            ]);

            return view('opportunities.show', compact('opportunity'));
        }

        // Team Manager can view opportunities belonging to their teams.
        if ($user->hasRole('Team Manager')) {
            $teamBelongsToManager = Team::where('id', $opportunity->team_id)
                ->where('manager_id', $user->id)
                ->exists();

            if (! $teamBelongsToManager) {
                abort(403);
            }

            $opportunity->load([
                'team',
                'applications',
                'volunteerHours'
            ]);

            return view('opportunities.show', compact('opportunity'));
        }

        // Member can view active opportunities only.
        if ($user->hasRole('Member')) {
            if (! $opportunity->is_active) {
                abort(403);
            }

            $opportunity->load([
                'team',
                'applications',
                'volunteerHours'
            ]);

            return view('opportunities.show', compact('opportunity'));
        }

        abort(403);
    }

    /**
     * Show the form for editing the specified opportunity.
     *
     * Only Admin and Team Manager are allowed.
     */
    public function edit(Opportunity $opportunity): View
    {
        $user = auth()->user();

        if (! $user->hasAnyRole(['Admin', 'Team Manager'])) {
            abort(403);
        }

        // Team Manager can edit only opportunities of their teams.
        if ($user->hasRole('Team Manager')) {
            $teamBelongsToManager = Team::where('id', $opportunity->team_id)
                ->where('manager_id', $user->id)
                ->exists();

            if (! $teamBelongsToManager) {
                abort(403);
            }

            $teams = Team::where('manager_id', $user->id)
                ->select(['id', 'name'])
                ->orderBy('name')
                ->get();
        } else {
            // Admin can edit opportunities from any team.
            $teams = Team::select(['id', 'name'])
                ->orderBy('name')
                ->get();
        }

        return view('opportunities.edit', compact(
            'opportunity',
            'teams'
        ));
    }

    /**
     * Update the specified opportunity.
     *
     * Only Admin and Team Manager are allowed.
     */
    public function update(
        UpdateOpportunityRequest $request,
        Opportunity $opportunity
    ): RedirectResponse {
        $user = auth()->user();

        if (! $user->hasAnyRole(['Admin', 'Team Manager'])) {
            abort(403);
        }

        $validated = $request->validated();

        /*
         * Team Manager must already manage the current opportunity's team.
         */
        if ($user->hasRole('Team Manager')) {
            $currentTeamBelongsToManager = Team::where(
                'id',
                $opportunity->team_id
            )
                ->where('manager_id', $user->id)
                ->exists();

            if (! $currentTeamBelongsToManager) {
                abort(403);
            }

            /*
             * Prevent the manager from moving the opportunity
             * to another manager's team.
             */
            $newTeamBelongsToManager = Team::where(
                'id',
                $validated['team_id']
            )
                ->where('manager_id', $user->id)
                ->exists();

            if (! $newTeamBelongsToManager) {
                abort(403);
            }
        }

        if ($request->hasFile('image_path')) {
            if (
                $opportunity->image_path &&
                Storage::disk('public')->exists($opportunity->image_path)
            ) {
                Storage::disk('public')->delete(
                    $opportunity->image_path
                );
            }

            $validated['image_path'] = $request
                ->file('image_path')
                ->store('opportunities', 'public');
        }

        $opportunity->update($validated);

        return redirect()
            ->route('opportunities.show', $opportunity)
            ->with('success', 'Opportunity updated successfully.');
    }

    /**
     * Remove the specified opportunity from storage.
     *
     * Only Admin and Team Manager are allowed.
     */
    public function destroy(Opportunity $opportunity): RedirectResponse
    {
        $user = auth()->user();

        if (! $user->hasAnyRole(['Admin', 'Team Manager'])) {
            abort(403);
        }

        /*
         * Team Manager can delete only opportunities
         * belonging to their own teams.
         */
        if ($user->hasRole('Team Manager')) {
            $teamBelongsToManager = Team::where('id', $opportunity->team_id)
                ->where('manager_id', $user->id)
                ->exists();

            if (! $teamBelongsToManager) {
                abort(403);
            }
        }

        if (
            $opportunity->image_path &&
            Storage::disk('public')->exists($opportunity->image_path)
        ) {
            Storage::disk('public')->delete(
                $opportunity->image_path
            );
        }

        $opportunity->delete();

        return redirect()
            ->route('opportunities.index')
            ->with('success', 'Opportunity deleted successfully.');
    }
}