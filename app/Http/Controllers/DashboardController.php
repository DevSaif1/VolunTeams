<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\Opportunity;
use App\Models\Application;
use App\Models\VolunteerHour;
use App\Models\Certificate;
use App\Models\Announcement;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        if ($user->hasRole('Admin')) {
            $totalVolunteers = User::role('Member')->count();
            $totalTeams = Team::count();
            $activeTeams = Team::where('is_active', true)->count();
            $activeOpportunities = Opportunity::where('is_active', true)->count();
            $pendingApplications = Application::where('status', 'pending')->count();
            $totalVolunteerHours = VolunteerHour::sum('hours') ?? 0;
            $certificatesIssued = Certificate::count();
            $activeAnnouncements = Announcement::where('is_active', true)->count();
            $recentAnnouncements = Announcement::with('creator')->latest()->take(5)->get();
            $recentApplications = Application::with(['user', 'opportunity'])->latest()->take(5)->get();

            return view('dashboard.admin', compact(
                'totalVolunteers',
                'totalTeams',
                'activeTeams',
                'activeOpportunities',
                'pendingApplications',
                'totalVolunteerHours',
                'certificatesIssued',
                'activeAnnouncements',
                'recentAnnouncements',
                'recentApplications'
            ));
        }

        if ($user->hasRole('Team Manager')) {
            $teamIds = Team::where('manager_id', $user->id)->pluck('id');
            $myTeamsCount = Team::where('manager_id', $user->id)->count();
            $myTeamMembersCount = TeamMember::whereIn('team_id', $teamIds)->count();
            $myOpportunitiesCount = Opportunity::whereIn('team_id', $teamIds)->count();
            $activeOpportunitiesCount = Opportunity::whereIn('team_id', $teamIds)->where('is_active', true)->count();
            $pendingApplicationsCount = Application::whereHas('opportunity', fn($q) => $q->whereIn('team_id', $teamIds))->where('status', 'pending')->count();
            $volunteerHoursCount = VolunteerHour::whereHas('opportunity', fn($q) => $q->whereIn('team_id', $teamIds))->sum('hours') ?? 0;
            $certificatesCount = Certificate::whereHas('opportunity', fn($q) => $q->whereIn('team_id', $teamIds))->count();
            $recentApplications = Application::whereHas('opportunity', fn($q) => $q->whereIn('team_id', $teamIds))->with(['user', 'opportunity'])->latest()->take(5)->get();

            return view('dashboard.manager', compact(
                'myTeamsCount',
                'myTeamMembersCount',
                'myOpportunitiesCount',
                'activeOpportunitiesCount',
                'pendingApplicationsCount',
                'volunteerHoursCount',
                'certificatesCount',
                'recentApplications'
            ));
        }

        if ($user->hasRole('Member')) {
            $myApplicationsCount = Application::where('user_id', $user->id)->count();
            $pendingApplicationsCount = Application::where('user_id', $user->id)->where('status', 'pending')->count();
            $approvedApplicationsCount = Application::where('user_id', $user->id)->where('status', 'approved')->count();
            $myVolunteerHours = VolunteerHour::where('user_id', $user->id)->sum('hours') ?? 0;
            $myCertificatesCount = Certificate::where('user_id', $user->id)->count();
            $myTeamsCount = TeamMember::where('user_id', $user->id)->count();
            $recentApplications = Application::where('user_id', $user->id)->with('opportunity')->latest()->take(5)->get();
            $activeAnnouncements = Announcement::where('is_active', true)->latest()->take(3)->get();

            return view('dashboard.member', compact(
                'myApplicationsCount',
                'pendingApplicationsCount',
                'approvedApplicationsCount',
                'myVolunteerHours',
                'myCertificatesCount',
                'myTeamsCount',
                'recentApplications',
                'activeAnnouncements'
            ));
        }

        // Fallback for users without specific roles
        return view('dashboard.member', [
            'myApplicationsCount' => 0,
            'pendingApplicationsCount' => 0,
            'approvedApplicationsCount' => 0,
            'myVolunteerHours' => 0,
            'myCertificatesCount' => 0,
            'myTeamsCount' => 0,
            'recentApplications' => collect(),
            'activeAnnouncements' => collect(),
        ]);
    }
}