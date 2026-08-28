<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamMember;
use App\Models\Opportunity;
use App\Models\Application;
use App\Models\VolunteerHour;
use App\Models\Certificate;
use App\Models\User;

class ReportController extends Controller
{
    public function index()
    {
        // General statistics
        $totalVolunteers = User::role('Member')->count();
        $totalTeams = Team::count();
        $totalTeamMembers = TeamMember::count();
        $totalOpportunities = Opportunity::count();
        $totalVolunteerHours = VolunteerHour::sum('hours') ?? 0;
        $totalCertificates = Certificate::count();

        // Application statistics
        $totalApplications = Application::count();
        $pendingApplications = Application::where('status', 'pending')->count();
        $approvedApplications = Application::where('status', 'approved')->count();
        $rejectedApplications = Application::where('status', 'rejected')->count();

        // Opportunity statistics
        $activeOpportunities = Opportunity::where('is_active', true)->count();
        $inactiveOpportunities = Opportunity::where('is_active', false)->count();

        // Team statistics
        $activeTeams = Team::where('is_active', true)->count();
        $inactiveTeams = Team::where('is_active', false)->count();

        return view('reports.index', compact(
            'totalVolunteers',
            'totalTeams',
            'totalTeamMembers',
            'totalOpportunities',
            'totalVolunteerHours',
            'totalCertificates',
            'totalApplications',
            'pendingApplications',
            'approvedApplications',
            'rejectedApplications',
            'activeOpportunities',
            'inactiveOpportunities',
            'activeTeams',
            'inactiveTeams'
        ));
    }
}