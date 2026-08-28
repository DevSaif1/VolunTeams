<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use App\Models\Opportunity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    /**
     * Display applications according to the authenticated user's role.
     */
    public function index(): View
    {
        $user = auth()->user();

        if ($user->hasRole('Admin')) {

            $applications = Application::with(['user', 'opportunity.team'])
                ->latest()
                ->paginate(10);

        } elseif ($user->hasRole('Team Manager')) {

            $applications = Application::with(['user', 'opportunity.team'])
                ->whereHas('opportunity.team', function ($query) use ($user) {
                    $query->where('manager_id', $user->id);
                })
                ->latest()
                ->paginate(10);

        } elseif ($user->hasRole('Member')) {

            $applications = Application::with(['user', 'opportunity.team'])
                ->where('user_id', $user->id)
                ->latest()
                ->paginate(10);

        } else {

            abort(403);
        }

        return view('applications.index', compact('applications'));
    }


    /**
     * Show the application form.
     * Members can apply for themselves only.
     */
            public function create(Request $request): View
        {
            $user = auth()->user();

            if (! $user->hasRole('Member')) {
                abort(403);
            }

            $opportunities = Opportunity::where('is_active', true)
                ->where('status', 'published')
                ->orderBy('title')
                ->get();

            $selectedOpportunityId = $request->query('opportunity_id');

            return view('applications.create', compact(
                'opportunities',
                'selectedOpportunityId'
            ));
        }


    /**
     * Store a new application.
     */
    public function store(StoreApplicationRequest $request): RedirectResponse
    {
        $user = auth()->user();

        if (! $user->hasRole('Member')) {
            abort(403);
        }

        $validated = $request->validated();

        /*
         * The user_id must NEVER come from the form.
         * It always comes from the authenticated user.
         */
        $validated['user_id'] = $user->id;

        /*
         * Make sure the opportunity exists and is active.
         */
        $opportunity = Opportunity::where('id', $validated['opportunity_id'])
            ->where('is_active', true)
            ->firstOrFail();

        /*
         * Prevent duplicate applications.
         */
        $exists = Application::where('user_id', $user->id)
            ->where('opportunity_id', $opportunity->id)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'opportunity_id' =>
                        'You have already applied for this opportunity.'
                ]);
        }

        $validated['status'] = 'pending';
        $validated['applied_at'] = now();

        $application = Application::create($validated);

        return redirect()
            ->route('applications.show', $application)
            ->with('success', 'Application submitted successfully.');
    }


    /**
     * Display a specific application.
     */
    public function show(Application $application): View
    {
        $user = auth()->user();

        $application->load([
            'user',
            'opportunity.team',
        ]);

        /*
         * Admin can view everything.
         */
        if ($user->hasRole('Admin')) {
            return view('applications.show', compact('application'));
        }

        /*
         * Member can view only their own application.
         */
        if (
            $user->hasRole('Member') &&
            $application->user_id !== $user->id
        ) {
            abort(403);
        }

        /*
         * Manager can view only applications
         * belonging to opportunities of their own teams.
         */
        if ($user->hasRole('Team Manager')) {

            $isOwnTeam = $application->opportunity
                && $application->opportunity->team
                && $application->opportunity->team->manager_id === $user->id;

            if (! $isOwnTeam) {
                abort(403);
            }
        }

        if (
            ! $user->hasRole('Member') &&
            ! $user->hasRole('Team Manager') &&
            ! $user->hasRole('Admin')
        ) {
            abort(403);
        }

        return view('applications.show', compact('application'));
    }


    /**
     * Show the edit form.
     * Only Admin and the correct Team Manager can edit.
     */
    public function edit(Application $application): View
    {
        $this->authorizeApplicationManagement($application);

        $application->load([
            'user',
            'opportunity.team',
        ]);

        return view('applications.edit', compact('application'));
    }


    /**
     * Update an application.
     * Only Admin and the responsible Team Manager can update.
     */
    public function update(
        Request $request,
        Application $application
    ): RedirectResponse {

        $this->authorizeApplicationManagement($application);

        $validated = $request->validate([
            'reason' => ['nullable', 'string'],
            'status' => [
                'required',
                'string',
                'in:pending,approved,rejected,attended,cancelled'
            ],
            'manager_notes' => ['nullable', 'string'],
        ]);

        $application->update($validated);

        return redirect()
            ->route('applications.show', $application)
            ->with('success', 'Application updated successfully.');
    }


    /**
     * Delete / withdraw an application.
     *
     * Admin:
     *     Can delete any application.
     *
     * Member:
     *     Can withdraw their own pending application.
     *
     * Team Manager:
     *     Cannot delete applications.
     */
    public function destroy(Application $application): RedirectResponse
    {
        $user = auth()->user();

        /*
         * Admin can delete any application.
         */
        if ($user->hasRole('Admin')) {
            $application->delete();

            return redirect()
                ->route('applications.index')
                ->with('success', 'Application deleted successfully.');
        }

        /*
         * Member can withdraw only their own pending application.
         */
        if (
            $user->hasRole('Member') &&
            $application->user_id === $user->id &&
            $application->status === 'pending'
        ) {
            $application->delete();

            return redirect()
                ->route('applications.index')
                ->with('success', 'Application withdrawn successfully.');
        }

        abort(403);
    }


    /**
     * Check whether the current user can manage an application.
     */
    private function authorizeApplicationManagement(
        Application $application
    ): void {
        $user = auth()->user();

        /*
         * Admin can manage everything.
         */
        if ($user->hasRole('Admin')) {
            return;
        }

        /*
         * Team Manager can manage only applications
         * belonging to opportunities of their own teams.
         */
        if ($user->hasRole('Team Manager')) {

            $application->loadMissing('opportunity.team');

            $isOwnTeam =
                $application->opportunity
                && $application->opportunity->team
                && $application->opportunity->team->manager_id === $user->id;

            if ($isOwnTeam) {
                return;
            }
        }

        /*
         * Members are never allowed to edit applications.
         */
        abort(403);
    }
}