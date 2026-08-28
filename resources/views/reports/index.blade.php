@extends('layouts.app')

@section('content')

    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    {{ __('reports.title') }}
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    {{ __('reports.subtitle') }}
                </p>
            </div>

            <div class="text-sm text-gray-500">
                {{ now()->format('Y-m-d') }}
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-8 px-4 sm:px-6 lg:px-8">

            {{-- Hero --}}
            <div class="rounded-2xl border border-emerald-200 bg-white shadow-sm overflow-hidden">
                <div class="border-l-4 border-emerald-500 px-6 py-8 sm:px-8">
                    <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">

                        <div>
                            <span class="inline-flex items-center rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                                <span class="mr-2 h-2 w-2 rounded-full bg-emerald-500"></span>
                                {{ __('reports.reports_statistics') }}
                            </span>

                            <h1 class="mt-4 text-3xl font-bold text-gray-900">
                                {{ __('reports.system_reports') }}
                            </h1>

                            <p class="mt-2 max-w-3xl text-sm leading-6 text-gray-600">
                                {{ __('reports.system_reports_description') }}
                            </p>
                        </div>

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 19h16M7 16V9m5 7V5m5 11v-4"
                                />
                            </svg>
                        </div>

                    </div>
                </div>
            </div>

            {{-- General Statistics --}}
            <div>
                <div class="mb-4">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-600">
                        VOLUNTEAMS
                    </p>

                    <h3 class="mt-1 text-xl font-bold text-gray-900">
                        {{ __('reports.general_statistics') }}
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        {{ __('reports.general_statistics_description') }}
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">

                    {{-- Total Volunteers --}}
                    <div class="rounded-xl border border-emerald-100 bg-white p-5 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                                    {{ __('reports.total_volunteers') }}
                                </p>

                                <p class="mt-2 text-3xl font-bold text-gray-900">
                                    {{ $totalVolunteers }}
                                </p>
                            </div>

                            <div class="rounded-lg bg-emerald-50 p-3 text-emerald-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17 20h5V4H2v16h5m10 0v-4a3 3 0 00-3-3H9a3 3 0 00-3 3v4m8-10a4 4 0 11-8 0 4 4 0 018 0z"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Total Teams --}}
                    <div class="rounded-xl border border-emerald-100 bg-white p-5 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                                    {{ __('reports.total_teams') }}
                                </p>

                                <p class="mt-2 text-3xl font-bold text-gray-900">
                                    {{ $totalTeams }}
                                </p>
                            </div>

                            <div class="rounded-lg bg-emerald-50 p-3 text-emerald-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17 20h5V4H2v16h5m10 0v-4a3 3 0 00-3-3H9a3 3 0 00-3 3v4m-1-10a3 3 0 11-6 0 3 3 0 016 0zm10 0a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Team Members --}}
                    <div class="rounded-xl border border-emerald-100 bg-white p-5 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                                    {{ __('reports.team_members') }}
                                </p>

                                <p class="mt-2 text-3xl font-bold text-gray-900">
                                    {{ $totalTeamMembers }}
                                </p>
                            </div>

                            <div class="rounded-lg bg-emerald-50 p-3 text-emerald-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 12a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 0114 0"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Total Opportunities --}}
                    <div class="rounded-xl border border-emerald-100 bg-white p-5 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                                    {{ __('reports.total_opportunities') }}
                                </p>

                                <p class="mt-2 text-3xl font-bold text-gray-900">
                                    {{ $totalOpportunities }}
                                </p>
                            </div>

                            <div class="rounded-lg bg-emerald-50 p-3 text-emerald-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Volunteer Hours --}}
                    <div class="rounded-xl border border-emerald-100 bg-white p-5 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                                    {{ __('reports.volunteer_hours') }}
                                </p>

                                <p class="mt-2 text-3xl font-bold text-gray-900">
                                    {{ number_format($totalVolunteerHours, 1) }}
                                </p>
                            </div>

                            <div class="rounded-lg bg-emerald-50 p-3 text-emerald-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Certificates --}}
                    <div class="rounded-xl border border-emerald-100 bg-white p-5 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                                    {{ __('reports.certificates_issued') }}
                                </p>

                                <p class="mt-2 text-3xl font-bold text-gray-900">
                                    {{ $totalCertificates }}
                                </p>
                            </div>

                            <div class="rounded-lg bg-emerald-50 p-3 text-emerald-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 12l2 2 4-4m5-5H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V7a2 2 0 00-2-2z"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Application + Opportunity Reports --}}
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                {{-- Application Report --}}
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-600">
                                VOLUNTEAMS
                            </p>

                            <h3 class="mt-1 text-lg font-bold text-gray-900">
                                {{ __('reports.application_report') }}
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                {{ __('reports.application_report_description') }}
                            </p>
                        </div>

                        <div class="rounded-lg bg-emerald-50 p-3 text-emerald-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h8l4 4v12a2 2 0 01-2 2z"
                                />
                            </svg>
                        </div>
                    </div>

                    <div class="mt-6 space-y-4">

                        {{-- Pending --}}
                        <div>
                            <div class="mb-1 flex justify-between text-sm">
                                <span class="font-medium text-gray-700">
                                    {{ __('reports.pending') }}
                                </span>

                                <span class="font-semibold text-amber-600">
                                    {{ $pendingApplications }}
                                </span>
                            </div>

                            <div class="h-2 rounded-full bg-gray-100">
                                <div
                                    class="h-2 rounded-full bg-amber-400"
                                    style="width: {{ $totalApplications > 0 ? ($pendingApplications / $totalApplications) * 100 : 0 }}%">
                                </div>
                            </div>
                        </div>

                        {{-- Approved --}}
                        <div>
                            <div class="mb-1 flex justify-between text-sm">
                                <span class="font-medium text-gray-700">
                                    {{ __('reports.approved') }}
                                </span>

                                <span class="font-semibold text-emerald-600">
                                    {{ $approvedApplications }}
                                </span>
                            </div>

                            <div class="h-2 rounded-full bg-gray-100">
                                <div
                                    class="h-2 rounded-full bg-emerald-500"
                                    style="width: {{ $totalApplications > 0 ? ($approvedApplications / $totalApplications) * 100 : 0 }}%">
                                </div>
                            </div>
                        </div>

                        {{-- Rejected --}}
                        <div>
                            <div class="mb-1 flex justify-between text-sm">
                                <span class="font-medium text-gray-700">
                                    {{ __('reports.rejected') }}
                                </span>

                                <span class="font-semibold text-red-600">
                                    {{ $rejectedApplications }}
                                </span>
                            </div>

                            <div class="h-2 rounded-full bg-gray-100">
                                <div
                                    class="h-2 rounded-full bg-red-500"
                                    style="width: {{ $totalApplications > 0 ? ($rejectedApplications / $totalApplications) * 100 : 0 }}%">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Opportunity Report --}}
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-600">
                                VOLUNTEAMS
                            </p>

                            <h3 class="mt-1 text-lg font-bold text-gray-900">
                                {{ __('reports.opportunity_report') }}
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                {{ __('reports.opportunity_report_description') }}
                            </p>
                        </div>

                        <div class="rounded-lg bg-emerald-50 p-3 text-emerald-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"
                                />
                            </svg>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-4">

                        {{-- Active --}}
                        <div class="rounded-lg border border-emerald-100 bg-emerald-50/70 p-5">
                            <p class="text-xs font-medium uppercase tracking-wide text-emerald-700">
                                {{ __('reports.active') }}
                            </p>

                            <p class="mt-2 text-3xl font-bold text-emerald-800">
                                {{ $activeOpportunities }}
                            </p>
                        </div>

                        {{-- Inactive --}}
                        <div class="rounded-lg border border-gray-200 bg-gray-50 p-5">
                            <p class="text-xs font-medium uppercase tracking-wide text-gray-600">
                                {{ __('reports.inactive') }}
                            </p>

                            <p class="mt-2 text-3xl font-bold text-gray-800">
                                {{ $inactiveOpportunities }}
                            </p>
                        </div>

                    </div>

                    {{-- Activity Rate --}}
                    <div class="mt-5">
                        <div class="mb-1 flex justify-between text-sm">
                            <span class="text-gray-600">
                                {{ __('reports.activity_rate') }}
                            </span>

                            <span class="font-semibold text-gray-800">
                                {{ $totalOpportunities > 0 ? round(($activeOpportunities / $totalOpportunities) * 100) : 0 }}%
                            </span>
                        </div>

                        <div class="h-2 rounded-full bg-gray-100">
                            <div
                                class="h-2 rounded-full bg-emerald-500"
                                style="width: {{ $totalOpportunities > 0 ? ($activeOpportunities / $totalOpportunities) * 100 : 0 }}%">
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            {{-- Team Report --}}
            <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-600">
                            VOLUNTEAMS
                        </p>

                        <h3 class="mt-1 text-lg font-bold text-gray-900">
                            {{ __('reports.team_report') }}
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            {{ __('reports.team_report_description') }}
                        </p>
                    </div>

                    <div class="rounded-lg bg-emerald-50 p-3 text-emerald-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 20h5V4H2v16h5m10 0v-4a3 3 0 00-3-3H9a3 3 0 00-3 3v4m-1-10a3 3 0 11-6 0 3 3 0 016 0zm10 0a3 3 0 11-6 0 3 3 0 016 0z"
                            />
                        </svg>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2">

                    {{-- Active Teams --}}
                    <div class="rounded-lg border border-emerald-100 bg-emerald-50/70 p-5">
                        <p class="text-xs font-medium uppercase tracking-wide text-emerald-700">
                            {{ __('reports.active_teams') }}
                        </p>

                        <p class="mt-2 text-3xl font-bold text-emerald-800">
                            {{ $activeTeams }}
                        </p>
                    </div>

                    {{-- Inactive Teams --}}
                    <div class="rounded-lg border border-gray-200 bg-gray-50 p-5">
                        <p class="text-xs font-medium uppercase tracking-wide text-gray-600">
                            {{ __('reports.inactive_teams') }}
                        </p>

                        <p class="mt-2 text-3xl font-bold text-gray-800">
                            {{ $inactiveTeams }}
                        </p>
                    </div>

                </div>

            </div>

            {{-- Report Summary --}}
            <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-600">
                            VOLUNTEAMS
                        </p>

                        <h3 class="mt-1 text-lg font-bold text-gray-900">
                            {{ __('reports.report_summary') }}
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            {{ __('reports.report_summary_description') }}
                        </p>
                    </div>

                    <span class="inline-flex w-fit items-center rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                        <span class="mr-2 h-2 w-2 rounded-full bg-emerald-500"></span>
                        {{ __('reports.live_data') }}
                    </span>

                </div>

                <div class="mt-5 rounded-lg border border-gray-100 bg-gray-50 p-4 text-sm leading-6 text-gray-600">
                    {{ __('reports.dynamic_data_note') }}
                </div>

            </div>

        </div>
    </div>

@endsection