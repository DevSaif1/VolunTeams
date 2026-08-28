<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVolunteerHourRequest;
use App\Http\Requests\UpdateVolunteerHourRequest;
use App\Models\Application;
use App\Models\Opportunity;
use App\Models\User;
use App\Models\VolunteerHour;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VolunteerHourController extends Controller
{
    /**
     * Display volunteer hours according to the authenticated user's role.
     */
    public function index(): View
    {
        $user = auth()->user();

        if ($user->hasRole('Admin')) {

            $volunteerHours = VolunteerHour::with([
                'user',
                'opportunity.team',
                'approver',
            ])
                ->latest('date_logged')
                ->paginate(10);

        } elseif ($user->hasRole('Team Manager')) {

            $volunteerHours = VolunteerHour::with([
                'user',
                'opportunity.team',
                'approver',
            ])
                ->whereHas('opportunity.team', function ($query) use ($user) {
                    $query->where('manager_id', $user->id);
                })
                ->latest('date_logged')
                ->paginate(10);

        } elseif ($user->hasRole('Member')) {

            $volunteerHours = VolunteerHour::with([
                'user',
                'opportunity.team',
                'approver',
            ])
                ->where('user_id', $user->id)
                ->latest('date_logged')
                ->paginate(10);

        } else {

            abort(403);
        }

        return view('volunteer_hours.index', compact('volunteerHours'));
    }


    /**
     * Show the form for logging new volunteer hours.
     *
     * Only Admin and Team Manager can create records.
     */
    public function create(): View
    {
        $user = auth()->user();

        if (! $user->hasRole('Admin') && ! $user->hasRole('Team Manager')) {
            abort(403);
        }

        /*
         * Admin:
         * Can log hours for any volunteer and any active opportunity.
         */
        if ($user->hasRole('Admin')) {

            $users = User::select(['id', 'name', 'email'])
                ->orderBy('name')
                ->get();

            $opportunities = Opportunity::select(['id', 'title'])
                ->where('is_active', true)
                ->orderBy('title')
                ->get();

        } else {

            /*
             * Team Manager:
             * Only volunteers with APPROVED applications
             * for opportunities belonging to the manager's teams.
             */
            $approvedUserIds = Application::query()
                ->where('status', 'approved')
                ->whereHas('opportunity.team', function ($query) use ($user) {
                    $query->where('manager_id', $user->id);
                })
                ->pluck('user_id')
                ->unique();

            $users = User::select(['id', 'name', 'email'])
                ->whereIn('id', $approvedUserIds)
                ->orderBy('name')
                ->get();

            /*
             * Team Manager can only log hours
             * for active opportunities belonging to their teams.
             */
            $opportunities = Opportunity::select(['id', 'title'])
                ->where('is_active', true)
                ->whereHas('team', function ($query) use ($user) {
                    $query->where('manager_id', $user->id);
                })
                ->orderBy('title')
                ->get();
        }

        /*
         * Approvers.
         *
         * Admin and Team Manager can appear here.
         * Keeping all users preserves the existing form behavior.
         */
        $approvers = User::select(['id', 'name', 'email'])
            ->orderBy('name')
            ->get();

        return view('volunteer_hours.create', compact(
            'users',
            'opportunities',
            'approvers'
        ));
    }


    /**
     * Store a newly created volunteer hour record.
     */
    public function store(StoreVolunteerHourRequest $request): RedirectResponse
    {
        $user = auth()->user();

        if (! $user->hasRole('Admin') && ! $user->hasRole('Team Manager')) {
            abort(403);
        }

        $validated = $request->validated();

        /*
         * Load the selected opportunity with its team.
         */
        $opportunity = Opportunity::with('team')
            ->findOrFail($validated['opportunity_id']);

        /*
         * Team Manager:
         * Can only log hours for opportunities
         * belonging to their own team.
         */
        if (
            $user->hasRole('Team Manager') &&
            $opportunity->team?->manager_id !== $user->id
        ) {
            abort(403);
        }

        /*
         * Team Manager:
         * The selected volunteer must have an APPROVED
         * application for the selected opportunity.
         */
        if ($user->hasRole('Team Manager')) {

            $approvedApplication = Application::query()
                ->where('user_id', $validated['user_id'])
                ->where('opportunity_id', $validated['opportunity_id'])
                ->where('status', 'approved')
                ->exists();

            if (! $approvedApplication) {
                abort(403);
            }
        }

        /*
         * Create the volunteer hour record.
         */
        $volunteerHour = VolunteerHour::create($validated);

        return redirect()
            ->route('volunteer-hours.show', $volunteerHour)
            ->with('success', 'Volunteer hours logged successfully.');
    }


    /**
     * Display a specific volunteer hour record.
     */
    public function show(VolunteerHour $volunteerHour): View
    {
        $user = auth()->user();

        $volunteerHour->load([
            'user',
            'opportunity.team',
            'approver',
        ]);

        /*
         * Admin can view any volunteer hour record.
         */
        if ($user->hasRole('Admin')) {
            return view('volunteer_hours.show', compact('volunteerHour'));
        }

        /*
         * Member can only view their own hours.
         */
        if (
            $user->hasRole('Member') &&
            $volunteerHour->user_id !== $user->id
        ) {
            abort(403);
        }

        /*
         * Team Manager can only view records
         * belonging to opportunities of their own teams.
         */
        if ($user->hasRole('Team Manager')) {

            $isOwnTeam =
                $volunteerHour->opportunity?->team?->manager_id === $user->id;

            if (! $isOwnTeam) {
                abort(403);
            }
        }

        return view('volunteer_hours.show', compact('volunteerHour'));
    }


    /**
     * Show the edit form.
     *
     * Only Admin and the responsible Team Manager can edit.
     */
    public function edit(VolunteerHour $volunteerHour): View
    {
        $this->authorizeHourManagement($volunteerHour);

        $user = auth()->user();

        /*
         * Admin:
         * Can edit using any volunteer and any opportunity.
         */
        if ($user->hasRole('Admin')) {

            $users = User::select(['id', 'name', 'email'])
                ->orderBy('name')
                ->get();

            $opportunities = Opportunity::select(['id', 'title'])
                ->orderBy('title')
                ->get();

        } else {

            /*
             * Team Manager:
             * Show only volunteers with approved applications
             * for opportunities belonging to the manager's teams.
             */
            $approvedUserIds = Application::query()
                ->where('status', 'approved')
                ->whereHas('opportunity.team', function ($query) use ($user) {
                    $query->where('manager_id', $user->id);
                })
                ->pluck('user_id')
                ->unique();

            $users = User::select(['id', 'name', 'email'])
                ->whereIn('id', $approvedUserIds)
                ->orderBy('name')
                ->get();

            /*
             * Team Manager can only edit using
             * opportunities belonging to their teams.
             */
            $opportunities = Opportunity::select(['id', 'title'])
                ->whereHas('team', function ($query) use ($user) {
                    $query->where('manager_id', $user->id);
                })
                ->orderBy('title')
                ->get();
        }

        $approvers = User::select(['id', 'name', 'email'])
            ->orderBy('name')
            ->get();

        return view('volunteer_hours.edit', compact(
            'volunteerHour',
            'users',
            'opportunities',
            'approvers'
        ));
    }


    /**
     * Update a volunteer hour record.
     */
    public function update(
        UpdateVolunteerHourRequest $request,
        VolunteerHour $volunteerHour
    ): RedirectResponse {

        $this->authorizeHourManagement($volunteerHour);

        $validated = $request->validated();

        $user = auth()->user();

        /*
         * Team Manager:
         * If the opportunity is being changed,
         * it must belong to their own team.
         */
        if (
            $user->hasRole('Team Manager') &&
            isset($validated['opportunity_id'])
        ) {

            $newOpportunity = Opportunity::with('team')
                ->findOrFail($validated['opportunity_id']);

            if ($newOpportunity->team?->manager_id !== $user->id) {
                abort(403);
            }
        }

        /*
         * Team Manager:
         * The selected volunteer must have an APPROVED
         * application for the selected opportunity.
         *
         * If one of the two values is not supplied,
         * use the existing record values.
         */
        if ($user->hasRole('Team Manager')) {

            $userId = $validated['user_id']
                ?? $volunteerHour->user_id;

            $opportunityId = $validated['opportunity_id']
                ?? $volunteerHour->opportunity_id;

            $approvedApplication = Application::query()
                ->where('user_id', $userId)
                ->where('opportunity_id', $opportunityId)
                ->where('status', 'approved')
                ->exists();

            if (! $approvedApplication) {
                abort(403);
            }
        }

        $volunteerHour->update($validated);

        return redirect()
            ->route('volunteer-hours.show', $volunteerHour)
            ->with('success', 'Volunteer hours updated successfully.');
    }


    /**
     * Remove a volunteer hour record.
     *
     * Only Admin can delete.
     */
    public function destroy(
        VolunteerHour $volunteerHour
    ): RedirectResponse {

        $user = auth()->user();

        if (! $user->hasRole('Admin')) {
            abort(403);
        }

        $volunteerHour->delete();

        return redirect()
            ->route('volunteer-hours.index')
            ->with('success', 'Volunteer hours deleted successfully.');
    }


    /**
     * Check whether the current user can manage the record.
     */
    private function authorizeHourManagement(
        VolunteerHour $volunteerHour
    ): void {

        $user = auth()->user();

        /*
         * Admin can manage everything.
         */
        if ($user->hasRole('Admin')) {
            return;
        }

        /*
         * Team Manager can manage records
         * belonging to opportunities of their own teams.
         */
        if ($user->hasRole('Team Manager')) {

            $volunteerHour->loadMissing('opportunity.team');

            if (
                $volunteerHour->opportunity?->team?->manager_id === $user->id
            ) {
                return;
            }
        }

        abort(403);
    }
}