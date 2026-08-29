@extends('layouts.app')

@section('content')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('dashboard.admin_dashboard') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-b from-emerald-50/40 via-slate-50 to-slate-50 py-10 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- ========================================================= --}}
            {{-- Welcome / Admin Overview --}}
            {{-- ========================================================= --}}
            <section class="relative overflow-hidden rounded-2xl border border-emerald-200 bg-white shadow-sm">

                <div class="absolute inset-y-0 start-0 w-2 bg-emerald-600"></div>

                <div class="p-6 sm:p-8">
                    <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">

                        <div class="max-w-3xl">

                            <div class="mb-4 inline-flex items-center gap-2 rounded-full border border-emerald-100 bg-emerald-50 px-3 py-1.5">
                                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                                <span class="text-xs font-semibold tracking-wide text-emerald-700">
                                    {{ __('dashboard.administrator_access') }}
                                </span>
                            </div>

                            <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                                {{ __('dashboard.welcome_back', ['name' => auth()->user()->name]) }}
                            </h1>

                            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600 sm:text-base">
                                {{ __('dashboard.admin_description') }}
                            </p>

                        </div>

                        <div class="hidden shrink-0 sm:flex">
                            <div class="flex h-16 w-16 items-center justify-center rounded-2xl border border-emerald-100 bg-emerald-50 text-emerald-600">
                                <svg
                                    class="h-8 w-8"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M12 3l7 4v5c0 4.5-3 7.8-7 9-4-1.2-7-4.5-7-9V7l7-4z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M9.5 12l1.7 1.7 3.5-3.5"
                                    />
                                </svg>
                            </div>
                        </div>

                    </div>
                </div>

            </section>


            {{-- ========================================================= --}}
            {{-- Statistics --}}
            {{-- ========================================================= --}}
            <section>

                <div class="mb-5 flex items-end justify-between gap-4">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-emerald-600">
                            VolunTeams
                        </p>

                        <h2 class="mt-1 text-xl font-bold tracking-tight text-slate-900">
                            {{ __('dashboard.admin_dashboard') }}
                        </h2>
                    </div>
                </div>


                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

                    {{-- Volunteers --}}
                    <div class="group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-emerald-200 hover:shadow-md">

                        <div class="flex items-start justify-between gap-4">

                            <div class="min-w-0">
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    {{ __('dashboard.volunteers') }}
                                </p>

                                <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">
                                    {{ number_format($totalVolunteers) }}
                                </p>
                            </div>

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                                    />
                                </svg>
                            </div>

                        </div>

                        <div class="mt-5 flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                            <span class="text-xs font-medium text-slate-400">
                                {{ __('dashboard.team_members') }}
                            </span>
                        </div>

                    </div>


                    {{-- Teams --}}
                    <div class="group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-emerald-200 hover:shadow-md">

                        <div class="flex items-start justify-between gap-4">

                            <div class="min-w-0">
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    {{ __('dashboard.teams_active') }}
                                </p>

                                <div class="mt-3 flex items-baseline gap-2">
                                    <p class="text-3xl font-bold tracking-tight text-slate-900">
                                        {{ number_format($activeTeams) }}
                                    </p>

                                    <span class="text-sm font-medium text-slate-400">
                                        / {{ $totalTeams }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                                    />
                                </svg>
                            </div>

                        </div>

                        <div class="mt-5 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">
                            <div
                                class="h-full rounded-full bg-emerald-500"
                                style="width: {{ $totalTeams > 0 ? min(100, ($activeTeams / $totalTeams) * 100) : 0 }}%;"
                            ></div>
                        </div>

                    </div>


                    {{-- Active Opportunities --}}
                    <div class="group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-emerald-200 hover:shadow-md">

                        <div class="flex items-start justify-between gap-4">

                            <div class="min-w-0">
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    {{ __('dashboard.active_opportunities') }}
                                </p>

                                <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">
                                    {{ number_format($activeOpportunities) }}
                                </p>
                            </div>

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M20 7h-3V5a2 2 0 00-2-2H9a2 2 0 00-2 2v2H4a2 2 0 00-2 2v8a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2zM9 7h6M10 12h4"
                                    />
                                </svg>
                            </div>

                        </div>

                        <div class="mt-5 flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                            <span class="text-xs font-medium text-slate-400">
                                {{ __('dashboard.opportunities') }}
                            </span>
                        </div>

                    </div>


                    {{-- Pending Applications --}}
                    <div class="group rounded-2xl border border-amber-200 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md">

                        <div class="flex items-start justify-between gap-4">

                            <div class="min-w-0">

                                <div class="flex items-center gap-2">
                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        {{ __('dashboard.pending_applications') }}
                                    </p>

                                    @if($pendingApplications > 0)
                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                    @endif
                                </div>

                                <p class="mt-3 text-3xl font-bold tracking-tight text-amber-600">
                                    {{ number_format($pendingApplications) }}
                                </p>

                            </div>

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M9 5h6M9 3h6a2 2 0 012 2v1h1a2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2h1V5a2 2 0 012-2zM8 12h8M8 16h5"
                                    />
                                </svg>
                            </div>

                        </div>

                        <div class="mt-5 h-1.5 w-full overflow-hidden rounded-full bg-amber-50">
                            <div
                                class="h-full rounded-full bg-amber-400"
                                style="width: {{ $pendingApplications > 0 ? '60%' : '10%' }};"
                            ></div>
                        </div>

                    </div>


                    {{-- Volunteer Hours --}}
                    <div class="group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-emerald-200 hover:shadow-md">

                        <div class="flex items-start justify-between gap-4">

                            <div class="min-w-0">
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    {{ __('dashboard.total_volunteer_hours') }}
                                </p>

                                <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">
                                    {{ number_format($totalVolunteerHours, 1) }}
                                </p>
                            </div>

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M12 7v5l3 2M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                            </div>

                        </div>

                        <div class="mt-5 flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                            <span class="text-xs font-medium text-slate-400">
                                {{ __('dashboard.volunteer_hours') }}
                            </span>
                        </div>

                    </div>


                    {{-- Certificates --}}
                    <div class="group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-emerald-200 hover:shadow-md">

                        <div class="flex items-start justify-between gap-4">

                            <div class="min-w-0">
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    {{ __('dashboard.certificates_issued') }}
                                </p>

                                <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">
                                    {{ number_format($certificatesIssued) }}
                                </p>
                            </div>

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M12 3l2.3 2.1 3.1-.3 1.1 2.9 2.7 1.5-1.5 2.7.3 3.1-1.1 2.9-2.7-1.5-3.1.3-1.1-2.9-2.7-1.5 1.5-2.7-.3-3.1 2.9-1.1L12 3zM9.5 12l1.7 1.7 3.5-3.5"
                                    />
                                </svg>
                            </div>

                        </div>

                        <div class="mt-5 flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                            <span class="text-xs font-medium text-slate-400">
                                {{ __('dashboard.certificates') }}
                            </span>
                        </div>

                    </div>


                    {{-- Active Announcements --}}
                    <div class="group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-emerald-200 hover:shadow-md">

                        <div class="flex items-start justify-between gap-4">

                            <div class="min-w-0">
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    {{ __('dashboard.active_announcements') }}
                                </p>

                                <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">
                                    {{ number_format($activeAnnouncements) }}
                                </p>
                            </div>

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M12 4v8m0 4h.01M5.5 20h13a2 2 0 001.73-3L13.73 5a2 2 0 00-3.46 0L3.77 17a2 2 0 001.73 3z"
                                    />
                                </svg>
                            </div>

                        </div>

                        <div class="mt-5 flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                            <span class="text-xs font-medium text-slate-400">
                                {{ __('dashboard.announcements') }}
                            </span>
                        </div>

                    </div>

                </div>

            </section>


            {{-- ========================================================= --}}
            {{-- Quick Actions --}}
            {{-- ========================================================= --}}
            <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">

                <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-emerald-600">
                            VolunTeams
                        </p>

                        <h2 class="mt-1 text-xl font-bold tracking-tight text-slate-900">
                            {{ __('dashboard.quick_actions') }}
                        </h2>
                    </div>

                    <p class="text-sm text-slate-400">
                        {{ __('dashboard.admin_dashboard') }}
                    </p>

                </div>


                <div class="mt-6 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-9">

                    {{-- Users & Members --}}
                    <a
                        href="{{ route('users.index') }}"
                        class="group relative flex min-h-32 flex-col items-center justify-center overflow-hidden rounded-xl border border-emerald-200 bg-emerald-50/40 px-3 py-5 text-center transition duration-200 hover:-translate-y-1 hover:border-emerald-300 hover:bg-emerald-50 hover:shadow-md"
                    >

                        <span class="absolute inset-x-0 top-0 h-1 bg-emerald-500"></span>

                        <span class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-white text-emerald-600 shadow-sm ring-1 ring-emerald-100 transition duration-200 group-hover:scale-105">

                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                                />
                            </svg>

                        </span>

                        <span class="text-sm font-semibold leading-5 text-slate-700 transition group-hover:text-emerald-700">
                            {{ __('dashboard.users_members') }}
                        </span>

                    </a>


                    {{-- Teams --}}
                    <a
                        href="{{ route('teams.index') }}"
                        class="group flex min-h-32 flex-col items-center justify-center rounded-xl border border-slate-200 bg-slate-50/70 px-3 py-5 text-center transition duration-200 hover:-translate-y-1 hover:border-emerald-200 hover:bg-emerald-50 hover:shadow-md"
                    >

                        <span class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-white text-emerald-600 shadow-sm ring-1 ring-slate-200 transition duration-200 group-hover:scale-105">

                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                                />
                            </svg>

                        </span>

                        <span class="text-sm font-semibold leading-5 text-slate-700 transition group-hover:text-emerald-700">
                            {{ __('dashboard.teams') }}
                        </span>

                    </a>


                    {{-- Opportunities --}}
                    <a
                        href="{{ route('opportunities.index') }}"
                        class="group flex min-h-32 flex-col items-center justify-center rounded-xl border border-slate-200 bg-slate-50/70 px-3 py-5 text-center transition duration-200 hover:-translate-y-1 hover:border-emerald-200 hover:bg-emerald-50 hover:shadow-md"
                    >

                        <span class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-white text-emerald-600 shadow-sm ring-1 ring-slate-200 transition duration-200 group-hover:scale-105">

                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M20 7h-3V5a2 2 0 00-2-2H9a2 2 0 00-2 2v2H4a2 2 0 00-2 2v8a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2zM9 7h6M10 12h4"
                                />
                            </svg>

                        </span>

                        <span class="text-sm font-semibold leading-5 text-slate-700 transition group-hover:text-emerald-700">
                            {{ __('dashboard.opportunities') }}
                        </span>

                    </a>


                    {{-- Applications --}}
                    <a
                        href="{{ route('applications.index') }}"
                        class="group flex min-h-32 flex-col items-center justify-center rounded-xl border border-slate-200 bg-slate-50/70 px-3 py-5 text-center transition duration-200 hover:-translate-y-1 hover:border-emerald-200 hover:bg-emerald-50 hover:shadow-md"
                    >

                        <span class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-white text-emerald-600 shadow-sm ring-1 ring-slate-200 transition duration-200 group-hover:scale-105">

                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M9 5h6M9 3h6a2 2 0 012 2v1h1a2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2h1V5a2 2 0 012-2zM8 12h8M8 16h5"
                                />
                            </svg>

                        </span>

                        <span class="text-sm font-semibold leading-5 text-slate-700 transition group-hover:text-emerald-700">
                            {{ __('dashboard.applications') }}
                        </span>

                    </a>


                    {{-- Volunteer Hours --}}
                    <a
                        href="{{ route('volunteer-hours.index') }}"
                        class="group flex min-h-32 flex-col items-center justify-center rounded-xl border border-slate-200 bg-slate-50/70 px-3 py-5 text-center transition duration-200 hover:-translate-y-1 hover:border-emerald-200 hover:bg-emerald-50 hover:shadow-md"
                    >

                        <span class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-white text-emerald-600 shadow-sm ring-1 ring-slate-200 transition duration-200 group-hover:scale-105">

                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M12 7v5l3 2M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>

                        </span>

                        <span class="text-sm font-semibold leading-5 text-slate-700 transition group-hover:text-emerald-700">
                            {{ __('dashboard.volunteer_hours') }}
                        </span>

                    </a>


                    {{-- Certificates --}}
                    <a
                        href="{{ route('certificates.index') }}"
                        class="group flex min-h-32 flex-col items-center justify-center rounded-xl border border-slate-200 bg-slate-50/70 px-3 py-5 text-center transition duration-200 hover:-translate-y-1 hover:border-emerald-200 hover:bg-emerald-50 hover:shadow-md"
                    >

                        <span class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-white text-emerald-600 shadow-sm ring-1 ring-slate-200 transition duration-200 group-hover:scale-105">

                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M12 3l2.3 2.1 3.1-.3 1.1 2.9 2.7 1.5-1.5 2.7-.3 3.1-2.9 1.1-1.5 2.7-2.7-1.5-3.1.3-1.1-2.9-2.7-1.5 1.5-2.7-.3-3.1 2.9-1.1L12 3zM9.5 12l1.7 1.7 3.5-3.5"
                                />
                            </svg>

                        </span>

                        <span class="text-sm font-semibold leading-5 text-slate-700 transition group-hover:text-emerald-700">
                            {{ __('dashboard.certificates') }}
                        </span>

                    </a>


                    {{-- Announcements --}}
                    <a
                        href="{{ route('announcements.index') }}"
                        class="group flex min-h-32 flex-col items-center justify-center rounded-xl border border-slate-200 bg-slate-50/70 px-3 py-5 text-center transition duration-200 hover:-translate-y-1 hover:border-emerald-200 hover:bg-emerald-50 hover:shadow-md"
                    >

                        <span class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-white text-emerald-600 shadow-sm ring-1 ring-slate-200 transition duration-200 group-hover:scale-105">

                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M12 4v8m0 4h.01M5.5 20h13a2 2 0 001.73-3L13.73 5a2 2 0 00-3.46 0L3.77 17a2 2 0 001.73 3z"
                                />
                            </svg>

                        </span>

                        <span class="text-sm font-semibold leading-5 text-slate-700 transition group-hover:text-emerald-700">
                            {{ __('dashboard.announcements') }}
                        </span>

                    </a>

                    {{-- Password Reset Requests --}}
                    <a
                        href="{{ route('admin.password-reset-requests.index') }}"
                        class="group flex min-h-32 flex-col items-center justify-center rounded-xl border border-slate-200 bg-slate-50/70 px-3 py-5 text-center transition duration-200 hover:-translate-y-1 hover:border-emerald-200 hover:bg-emerald-50 hover:shadow-md"
                    >
                        <span class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-white text-emerald-600 shadow-sm ring-1 ring-slate-200 transition duration-200 group-hover:scale-105">
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M12 15v2m-3 0h6m-7-4h8a2 2 0 002-2V7a2 2 0 00-2-2H8a2 2 0 00-2 2v4a2 2 0 002 2zm-2 8h12a2 2 0 002-2v-5H4v5a2 2 0 002 2z"
                                />
                            </svg>
                        </span>

                            <span class="text-sm font-semibold leading-5 text-slate-700 transition group-hover:text-emerald-700">
                                {{ __('dashboard.password_reset_requests') }}
                            </span>
                    </a>


                    {{-- Reports & Statistics --}}
                    <a
                        href="{{ route('reports.index') }}"
                        class="group flex min-h-32 flex-col items-center justify-center rounded-xl border border-slate-200 bg-slate-50/70 px-3 py-5 text-center transition duration-200 hover:-translate-y-1 hover:border-emerald-200 hover:bg-emerald-50 hover:shadow-md"
                    >
                        <span class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-white text-emerald-600 shadow-sm ring-1 ring-slate-200 transition duration-200 group-hover:scale-105">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M4 19V5m0 14h16M8 16v-5m4 5V8m4 8V4"
                                />
                            </svg>
                        </span>

                        <span class="text-sm font-semibold leading-5 text-slate-700 transition group-hover:text-emerald-700">
                            {{ __('dashboard.reports') }}
                        </span>
                    </a>

                </div>

            </section>

            {{-- ========================================================= --}}
{{-- Recent Activity --}}
{{-- ========================================================= --}}
<div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

    {{-- ===================================================== --}}
    {{-- Recent Applications --}}
    {{-- ===================================================== --}}
    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-7">

        <div class="flex items-start justify-between gap-4">

            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-emerald-600">
                    VolunTeams
                </p>

                <h2 class="mt-1 text-lg font-bold tracking-tight text-slate-900">
                    {{ __('dashboard.recent_applications') }}
                </h2>
            </div>

            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                <svg
                    class="h-5 w-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M9 5h6M9 3h6a2 2 0 012 2v1h1a2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2h1V5a2 2 0 012-2zM8 12h8M8 16h5"
                    />
                </svg>

            </div>

        </div>


        @if($recentApplications->count() > 0)

            <div class="mt-6 space-y-3">

                @foreach($recentApplications as $app)

                    <div class="group rounded-xl border border-slate-200 bg-slate-50/60 p-4 transition duration-200 hover:border-emerald-200 hover:bg-emerald-50/40">

                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                            <div class="min-w-0">

                                <p class="break-words text-sm font-semibold text-slate-900">
                                    {{ $app->user?->name ?? __('dashboard.unknown') }}
                                </p>

                                <p class="mt-1 break-words text-xs text-slate-500">
                                    {{ $app->opportunity?->title ?? __('dashboard.not_available') }}
                                </p>

                            </div>


                            @if($app->status === 'approved')

                                <span class="shrink-0 inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-3 py-1.5 text-xs font-semibold text-emerald-700">

                                    <span class="h-1.5 w-1.5 rounded-full bg-primary-500"></span>

                                    {{ __('dashboard.approved') }}

                                </span>

                            @elseif($app->status === 'pending')

                                <span class="shrink-0 inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-3 py-1.5 text-xs font-semibold text-amber-700">

                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                                    {{ __('dashboard.pending') }}

                                </span>

                            @elseif($app->status === 'rejected')

                                <span class="shrink-0 inline-flex items-center gap-1.5 rounded-full bg-red-100 px-3 py-1.5 text-xs font-semibold text-red-700">

                                    <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>

                                    {{ __('dashboard.rejected') }}

                                </span>

                            @else

                                <span class="shrink-0 inline-flex items-center rounded-full bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-700">
                                    {{ ucfirst($app->status) }}
                                </span>

                            @endif

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="mt-6 flex min-h-32 items-center justify-center rounded-xl border border-dashed border-slate-200 bg-slate-50 px-6 text-center">

                <p class="text-sm text-slate-500">
                    {{ __('dashboard.no_applications') }}
                </p>

            </div>

        @endif

    </section>


                {{-- ===================================================== --}}
                {{-- Recent Announcements --}}
                {{-- ===================================================== --}}
                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-7">

                    <div class="flex items-start justify-between gap-4">

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-emerald-600">
                                VolunTeams
                            </p>

                            <h2 class="mt-1 text-lg font-bold tracking-tight text-slate-900">
                                {{ __('dashboard.recent_announcements') }}
                            </h2>
                        </div>

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M15 17h5l-1.5-1.5V11a6.5 6.5 0 00-13 0v4.5L4 17h5m3 4a2.5 2.5 0 01-2.45-2h4.9A2.5 2.5 0 0112 21z"
                                />
                            </svg>

                        </div>

                    </div>


                    @if($recentAnnouncements->count() > 0)

                        <div class="mt-6 space-y-3">

                            @foreach($recentAnnouncements as $announcement)

                                <div class="rounded-xl border border-slate-200 bg-slate-50/60 p-4 transition duration-200 hover:border-emerald-200 hover:bg-emerald-50/40">

                                    <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">

                                        <p class="min-w-0 break-words text-sm font-semibold text-slate-900">
                                            {{ $announcement->title }}
                                        </p>

                                        <span class="shrink-0 whitespace-nowrap text-xs text-slate-400">
                                            {{ $announcement->created_at?->locale(app()->getLocale())->diffForHumans() }}
                                        </span>

                                    </div>

                                    <p class="mt-2 line-clamp-2 text-xs leading-5 text-slate-600">
                                        {{ $announcement->content }}
                                    </p>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="mt-6 flex min-h-32 items-center justify-center rounded-xl border border-dashed border-slate-200 bg-slate-50 px-6 text-center">

                            <p class="text-sm text-slate-500">
                                {{ __('dashboard.no_announcements') }}
                            </p>

                        </div>

                    @endif

                </section>
                
                    
            </div>
        </div>
    </div>

@endsection