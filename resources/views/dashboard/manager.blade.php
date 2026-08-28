@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-gradient-to-b from-emerald-50/40 via-slate-50 to-slate-50 py-10 sm:py-12">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- ========================================================= --}}
            {{-- Welcome Section --}}
            {{-- ========================================================= --}}
            <section class="relative mb-8 overflow-hidden rounded-2xl border border-emerald-200 bg-white shadow-sm">

                <div class="absolute inset-y-0 start-0 w-2 bg-emerald-600"></div>

                <div class="flex flex-col gap-6 p-6 ps-8 sm:p-8 sm:ps-10 lg:flex-row lg:items-center lg:justify-between">

                    <div class="min-w-0">

                        <span class="inline-flex items-center rounded-full border border-emerald-100 bg-emerald-50 px-4 py-2 text-xs font-semibold text-emerald-700">
                            {{ __('dashboard.team_manager_access') }}
                        </span>

                        <h1 class="mt-4 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                            {{ __('dashboard.manager_welcome', ['name' => auth()->user()->name]) }}
                        </h1>

                        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600 sm:text-base">
                            {{ __('dashboard.manager_welcome_description') }}
                        </p>

                    </div>


                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 ring-1 ring-emerald-100">

                        <svg
                            class="h-7 w-7"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M9 12l2 2 4-4"
                            />
                        </svg>

                    </div>

                </div>

            </section>


            {{-- ========================================================= --}}
            {{-- Dashboard Heading --}}
            {{-- ========================================================= --}}
            <div class="mb-5">

                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-emerald-600">
                    VolunTeams
                </p>

                <h2 class="mt-1 text-xl font-bold tracking-tight text-slate-900">
                    {{ __('dashboard.manager_dashboard') }}
                </h2>

            </div>


            {{-- ========================================================= --}}
            {{-- Statistics --}}
            {{-- ========================================================= --}}
            <section class="mb-8">

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

                    {{-- My Teams --}}
                    <div class="group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-emerald-200 hover:shadow-md">

                        <div class="flex items-start justify-between gap-4">

                            <div class="min-w-0">

                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    {{ __('dashboard.my_teams') }}
                                </p>

                                <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">
                                    {{ number_format($myTeamsCount) }}
                                </p>

                            </div>

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

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
                                        d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                                    />
                                </svg>

                            </div>

                        </div>

                        <div class="mt-5 flex items-center gap-2">

                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                            <span class="text-xs font-medium text-slate-400">
                                {{ __('dashboard.teams') }}
                            </span>

                        </div>

                    </div>


                    {{-- Team Members --}}
                    <div class="group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-emerald-200 hover:shadow-md">

                        <div class="flex items-start justify-between gap-4">

                            <div class="min-w-0">

                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    {{ __('dashboard.team_members') }}
                                </p>

                                <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">
                                    {{ number_format($myTeamMembersCount) }}
                                </p>

                            </div>

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

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
                                        d="M12 12a4 4 0 100-8 4 4 0 000 8zM5 21a7 7 0 0114 0M19 8a3 3 0 10-6 0"
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


                    {{-- My Opportunities --}}
                    <div class="group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-emerald-200 hover:shadow-md">

                        <div class="flex items-start justify-between gap-4">

                            <div class="min-w-0">

                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    {{ __('dashboard.my_opportunities') }}
                                </p>

                                <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">
                                    {{ number_format($myOpportunitiesCount) }}
                                </p>

                            </div>

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

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

                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    {{ __('dashboard.pending_applications') }}
                                </p>

                                <p class="mt-3 text-3xl font-bold tracking-tight text-amber-600">
                                    {{ number_format($pendingApplicationsCount) }}
                                </p>

                            </div>

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600">

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
                                        d="M9 5h6m-8 4h10M7 3h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"
                                    />
                                </svg>

                            </div>

                        </div>

                        <div class="mt-5 flex items-center gap-2">

                            @if($pendingApplicationsCount > 0)
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                            @else
                                <span class="h-1.5 w-1.5 rounded-full bg-slate-300"></span>
                            @endif

                            <span class="text-xs font-medium text-slate-400">
                                {{ __('dashboard.applications') }}
                            </span>

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
                                    {{ number_format($activeOpportunitiesCount) }}
                                </p>

                            </div>

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

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
                                        d="M20 7l-8-4-8 4m16 0v10l-8 4-8-4V7m16 0l-8 4-8-4m8 4v10"
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


                    {{-- Volunteer Hours --}}
                    <div class="group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-emerald-200 hover:shadow-md">

                        <div class="flex items-start justify-between gap-4">

                            <div class="min-w-0">

                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    {{ __('dashboard.volunteer_hours') }}
                                </p>

                                <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">
                                    {{ number_format($volunteerHoursCount, 1) }}
                                </p>

                            </div>

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

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
                                        d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"
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
                                    {{ number_format($certificatesCount) }}
                                </p>

                            </div>

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

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

                </div>

            </section>


            {{-- ========================================================= --}}
            {{-- Quick Management Actions --}}
            {{-- ========================================================= --}}
            <section class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">

                <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-emerald-600">
                            VolunTeams
                        </p>

                        <h2 class="mt-1 text-xl font-bold tracking-tight text-slate-900">
                            {{ __('dashboard.quick_management_actions') }}
                        </h2>

                    </div>

                    <p class="text-sm text-slate-400">
                        {{ __('dashboard.manager_dashboard') }}
                    </p>

                </div>


                <div class="mt-6 grid grid-cols-2 gap-3 sm:grid-cols-4">

                    {{-- Teams --}}
                    <a
                        href="{{ route('teams.index') }}"
                        class="group relative flex min-h-28 flex-col items-center justify-center overflow-hidden rounded-xl border border-emerald-200 bg-emerald-50/40 px-3 py-5 text-center transition duration-200 hover:-translate-y-1 hover:border-emerald-300 hover:bg-emerald-50 hover:shadow-md"
                    >

                        <span class="absolute inset-x-0 top-0 h-1 bg-emerald-500"></span>

                        <span class="mb-3 flex h-10 w-10 items-center justify-center rounded-xl bg-white text-emerald-600 shadow-sm ring-1 ring-emerald-100 transition group-hover:scale-105">

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
                                    d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                                />
                            </svg>

                        </span>

                        <span class="text-sm font-semibold text-slate-700 transition group-hover:text-emerald-700">
                            {{ __('dashboard.teams') }}
                        </span>

                    </a>


                    {{-- Opportunities --}}
                    <a
                        href="{{ route('opportunities.index') }}"
                        class="group flex min-h-28 flex-col items-center justify-center rounded-xl border border-slate-200 bg-slate-50/70 px-3 py-5 text-center transition duration-200 hover:-translate-y-1 hover:border-emerald-200 hover:bg-emerald-50 hover:shadow-md"
                    >

                        <span class="mb-3 flex h-10 w-10 items-center justify-center rounded-xl bg-white text-emerald-600 shadow-sm ring-1 ring-slate-200 transition group-hover:scale-105">

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
                                    d="M20 7h-3V5a2 2 0 00-2-2H9a2 2 0 00-2 2v2H4a2 2 0 00-2 2v8a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2zM9 7h6M10 12h4"
                                />
                            </svg>

                        </span>

                        <span class="text-sm font-semibold text-slate-700 transition group-hover:text-emerald-700">
                            {{ __('dashboard.opportunities') }}
                        </span>

                    </a>


                    {{-- Applications --}}
                    <a
                        href="{{ route('applications.index') }}"
                        class="group flex min-h-28 flex-col items-center justify-center rounded-xl border border-slate-200 bg-slate-50/70 px-3 py-5 text-center transition duration-200 hover:-translate-y-1 hover:border-emerald-200 hover:bg-emerald-50 hover:shadow-md"
                    >

                        <span class="mb-3 flex h-10 w-10 items-center justify-center rounded-xl bg-white text-emerald-600 shadow-sm ring-1 ring-slate-200 transition group-hover:scale-105">

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

                        </span>

                        <span class="text-sm font-semibold text-slate-700 transition group-hover:text-emerald-700">
                            {{ __('dashboard.applications') }}
                        </span>

                    </a>


                    {{-- Team Members --}}
                    <a
                        href="{{ route('team-members.index') }}"
                        class="group flex min-h-28 flex-col items-center justify-center rounded-xl border border-slate-200 bg-slate-50/70 px-3 py-5 text-center transition duration-200 hover:-translate-y-1 hover:border-emerald-200 hover:bg-emerald-50 hover:shadow-md"
                    >

                        <span class="mb-3 flex h-10 w-10 items-center justify-center rounded-xl bg-white text-emerald-600 shadow-sm ring-1 ring-slate-200 transition group-hover:scale-105">

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
                                    d="M12 12a4 4 0 100-8 4 4 0 000 8zM5 21a7 7 0 0114 0M19 8a3 3 0 10-6 0"
                                />
                            </svg>

                        </span>

                        <span class="text-sm font-semibold text-slate-700 transition group-hover:text-emerald-700">
                            {{ __('dashboard.team_members') }}
                        </span>

                    </a>

                </div>

            </section>


            {{-- ========================================================= --}}
            {{-- Recent Applications --}}
            {{-- ========================================================= --}}
            <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">

                <div class="flex items-start justify-between gap-4">

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-emerald-600">
                            VolunTeams
                        </p>

                        <h2 class="mt-1 text-xl font-bold tracking-tight text-slate-900">
                            {{ __('dashboard.recent_applications') }}
                        </h2>

                    </div>


                    <a
                        href="{{ route('applications.index') }}"
                        class="shrink-0 text-sm font-semibold text-emerald-600 transition hover:text-emerald-700"
                    >
                        {{ __('dashboard.view_all') }}
                    </a>

                </div>


                @forelse ($recentApplications as $application)

                    <div class="mt-4 flex flex-col gap-4 rounded-xl border border-slate-200 bg-slate-50/60 p-4 transition duration-200 hover:border-emerald-200 hover:bg-emerald-50/40 sm:flex-row sm:items-center sm:justify-between">

                        <div class="min-w-0">

                            <p class="truncate text-sm font-semibold text-slate-900">
                                {{ $application->user->name ?? __('dashboard.unknown_user') }}
                            </p>

                            <p class="mt-1 truncate text-xs text-slate-500">
                                {{ $application->opportunity->title ?? __('dashboard.unknown_opportunity') }}
                            </p>

                        </div>


                        @if($application->status === 'approved')

                            <span class="inline-flex shrink-0 items-center gap-1.5 self-start rounded-full bg-primary-100 px-3 py-1.5 text-xs font-semibold text-primary-700 sm:self-auto">

                                <span class="h-1.5 w-1.5 rounded-full bg-primary-500"></span>

                                {{ __('dashboard.approved') }}

                            </span>

                        @elseif($application->status === 'rejected')

                            <span class="inline-flex shrink-0 items-center gap-1.5 self-start rounded-full bg-red-100 px-3 py-1.5 text-xs font-semibold text-red-700 sm:self-auto">

                                <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>

                                {{ __('dashboard.rejected') }}

                            </span>

                        @elseif($application->status === 'attended')

                            <span class="inline-flex shrink-0 items-center gap-1.5 self-start rounded-full bg-emerald-100 px-3 py-1.5 text-xs font-semibold text-emerald-700 sm:self-auto">

                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                {{ __('dashboard.attended') }}

                            </span>

                        @else

                            <span class="inline-flex shrink-0 items-center gap-1.5 self-start rounded-full bg-amber-100 px-3 py-1.5 text-xs font-semibold text-amber-700 sm:self-auto">

                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                                {{ __('dashboard.pending') }}

                            </span>

                        @endif

                    </div>

                @empty

                    <div class="mt-6 flex min-h-32 items-center justify-center rounded-xl border border-dashed border-slate-200 bg-slate-50 px-6 text-center">

                        <p class="text-sm text-slate-500">
                            {{ __('dashboard.no_recent_applications') }}
                        </p>

                    </div>

                @endforelse

            </section>

        </div>

    </div>

@endsection
