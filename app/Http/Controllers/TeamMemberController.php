<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use App\Models\User;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TeamMemberController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('Admin')) {
            $teamMembers = TeamMember::with(['team', 'user'])
                ->paginate(10);

            return view('team_members.index', compact('teamMembers'));
        }

        if ($user->hasRole('Team Manager')) {
            $teamMembers = TeamMember::whereHas('team', function ($query) use ($user) {
                $query->where('manager_id', $user->id);
            })
                ->with(['team', 'user'])
                ->paginate(10);

            return view('team_members.index', compact('teamMembers'));
        }

        abort(403);
    }

    public function create()
    {
        $user = auth()->user();

        if ($user->hasRole('Admin')) {
            $teams = Team::all();
            $users = User::all();

            return view('team_members.create', compact('teams', 'users'));
        }

        if ($user->hasRole('Team Manager')) {
            $teams = Team::where('manager_id', $user->id)->get();
            $users = User::all();

            return view('team_members.create', compact('teams', 'users'));
        }

        abort(403);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'team_id' => 'required|exists:teams,id',
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('team_members')->where(function ($query) use ($request) {
                    return $query->where('team_id', $request->team_id);
                })
            ],
            'status' => 'required|string|in:pending,active,rejected,left',
            'joined_at' => 'nullable|date',
        ], [
            'user_id.unique' => 'This user is already a member of the selected team.'
        ]);

        $user = auth()->user();

        if ($user->hasRole('Admin')) {
            // Admin can add members to any team.
        } elseif ($user->hasRole('Team Manager')) {
            $teamBelongsToManager = Team::where('id', $validated['team_id'])
                ->where('manager_id', $user->id)
                ->exists();

            if (! $teamBelongsToManager) {
                abort(403);
            }
        } else {
            abort(403);
        }

        TeamMember::create($validated);

        return redirect()->route('team-members.index')
            ->with('success', 'Team member added successfully.');
    }

    public function show(TeamMember $teamMember)
    {
        $user = auth()->user();

        if ($user->hasRole('Admin')) {
            // Admin can view any team member.
        } elseif ($user->hasRole('Team Manager')) {
            if ($teamMember->team?->manager_id !== $user->id) {
                abort(403);
            }
        } else {
            abort(403);
        }

        $teamMember->load(['team', 'user']);

        return view('team_members.show', compact('teamMember'));
    }

    public function edit(TeamMember $teamMember)
    {
        $user = auth()->user();

        if ($user->hasRole('Admin')) {
            // Admin can edit any team member.
        } elseif ($user->hasRole('Team Manager')) {
            if ($teamMember->team?->manager_id !== $user->id) {
                abort(403);
            }
        } else {
            abort(403);
        }

        return view('team_members.edit', compact('teamMember'));
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $user = auth()->user();

        if ($user->hasRole('Admin')) {
            // Admin can update any team member.
        } elseif ($user->hasRole('Team Manager')) {
            if ($teamMember->team?->manager_id !== $user->id) {
                abort(403);
            }
        } else {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|string|in:pending,active,rejected,left',
            'joined_at' => 'nullable|date',
        ]);

        $teamMember->update($validated);

        return redirect()->route('team-members.index')
            ->with('success', 'Team member updated successfully.');
    }

    public function destroy(TeamMember $teamMember)
    {
        $user = auth()->user();

        if ($user->hasRole('Admin')) {
            // Admin can delete any team member.
        } elseif ($user->hasRole('Team Manager')) {
            if ($teamMember->team?->manager_id !== $user->id) {
                abort(403);
            }
        } else {
            abort(403);
        }

        $teamMember->delete();

        return redirect()->route('team-members.index')
            ->with('success', 'Team member removed successfully.');
    }
}