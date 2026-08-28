@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    @php
        $user = auth()->user();

        $isAdmin = $user->hasRole('Admin');
        $isManager = $user->hasRole('Team Manager');
        $isMember = $user->hasRole('Member');

        $isOwnApplication = $application->user_id === $user->id;

        $isManagerOwnTeam =
            $application->opportunity?->team?->manager_id === $user->id;

        $status = strtolower($application->status);

        $statusStyles = [
            'pending' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
            'approved' => 'bg-green-50 text-green-700 border-green-200',
            'rejected' => 'bg-red-50 text-red-700 border-red-200',
            'attended' => 'bg-blue-50 text-blue-700 border-blue-200',
            'cancelled' => 'bg-gray-50 text-gray-700 border-gray-200',
        ];

        $statusClass =
            $statusStyles[$status]
            ?? 'bg-gray-50 text-gray-700 border-gray-200';
    @endphp


    {{-- Success Message --}}
    @if(session('success'))

        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4">

            <div class="flex items-center gap-3">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-green-100 text-green-700">
                    ✓
                </div>

                <div>
                    <p class="text-sm font-semibold text-green-800">
                        {{ __('applications.success') }}
                    </p>

                    <p class="mt-1 text-sm text-green-700">
                        {{ session('success') }}
                    </p>
                </div>

            </div>

        </div>

    @endif


    {{-- Header --}}
    <div class="mb-8 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">

        <div>

            <div class="flex items-center gap-2 mb-3">
                <span class="w-2 h-2 rounded-full bg-indigo-600"></span>

                <span class="text-xs font-bold tracking-[0.18em] text-indigo-600 uppercase">
                    VOLUNTEAMS
                </span>
            </div>

            <h1 class="text-3xl sm:text-4xl font-bold text-gray-950 tracking-tight">
                {{ __('applications.show.title') }}
            </h1>

            <p class="mt-2 text-sm sm:text-base text-gray-600">
                {{ __('applications.show.description') }}
            </p>

        </div>


        <div class="flex items-center gap-3">

            {{-- Back --}}
            <a
                href="{{ route('applications.index') }}"
                class="inline-flex items-center justify-center gap-2
                       px-5 py-3 rounded-xl
                       border border-gray-200 bg-white
                       text-sm font-semibold text-gray-700
                       shadow-sm
                       hover:bg-gray-50
                       hover:border-gray-300
                       transition"
            >

                <span>
                    {{ app()->getLocale() === 'ar' ? '→' : '←' }}
                </span>

                {{ __('applications.show.back') }}

            </a>


            {{-- Edit --}}
            @if($isAdmin || ($isManager && $isManagerOwnTeam))

                <a
                    href="{{ route('applications.edit', $application->id) }}"
                    class="inline-flex items-center justify-center gap-2
                           px-5 py-3 rounded-xl
                           bg-indigo-600
                           text-sm font-semibold text-white
                           shadow-sm
                           hover:bg-indigo-700
                           transition"
                >

                    <span>✎</span>

                    {{ __('applications.show.edit_application') }}

                </a>

            @endif

        </div>

    </div>


    {{-- Main Card --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">


        {{-- Application Header --}}
        <div class="border-b border-gray-200
                    bg-gradient-to-r from-indigo-50/70 via-white to-white
                    px-6 py-7 sm:px-8">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                {{-- Volunteer --}}
                <div class="flex items-center gap-5">

                    <div class="flex h-16 w-16 shrink-0 items-center justify-center
                                rounded-2xl bg-indigo-100
                                border border-indigo-200
                                text-lg font-bold text-indigo-700">

                        {{ strtoupper(substr($application->user->name ?? 'S', 0, 2)) }}

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-indigo-600">
                            {{ __('applications.show.volunteer') }}
                        </p>

                        <h2 class="mt-1 text-2xl font-bold text-gray-950">
                            {{ $application->user->name ?? __('applications.not_available') }}
                        </h2>

                        @if($application->user?->email)

                            <p class="mt-1 text-sm text-gray-500">
                                {{ $application->user->email }}
                            </p>

                        @endif

                    </div>

                </div>


                {{-- Status --}}
                <div>

                    <span class="inline-flex items-center gap-2
                                 rounded-full border
                                 px-4 py-2
                                 text-sm font-semibold
                                 {{ $statusClass }}">

                        <span class="h-2 w-2 rounded-full bg-current"></span>

                        {{ __('applications.statuses.' . $status) }}

                    </span>

                </div>

            </div>

        </div>


        {{-- Details --}}
        <div class="p-6 sm:p-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">


                {{-- Volunteer --}}
                <div class="rounded-xl border border-gray-200 bg-white p-5">

                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        {{ __('applications.show.volunteer') }}
                    </p>

                    <p class="mt-2 text-base font-semibold text-gray-900">
                        {{ $application->user->name ?? __('applications.not_available') }}
                    </p>

                </div>


                {{-- Opportunity --}}
                <div class="rounded-xl border border-gray-200 bg-white p-5">

                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        {{ __('applications.show.opportunity') }}
                    </p>

                    <p class="mt-2 text-base font-semibold text-indigo-600">
                        {{ $application->opportunity->title ?? __('applications.not_available') }}
                    </p>

                    @if($application->opportunity?->team)

                        <p class="mt-1 text-sm text-gray-500">
                            {{ __('applications.show.team') }}:
                            {{ $application->opportunity->team->name }}
                        </p>

                    @endif

                </div>


                {{-- Status --}}
                <div class="rounded-xl border border-gray-200 bg-white p-5">

                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        {{ __('applications.show.status') }}
                    </p>

                    <div class="mt-3">

                        <span class="inline-flex items-center gap-2
                                     rounded-full border
                                     px-3 py-1.5
                                     text-xs font-semibold
                                     {{ $statusClass }}">

                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>

                            {{ __('applications.statuses.' . $status) }}

                        </span>

                    </div>

                </div>


                {{-- Applied At --}}
                <div class="rounded-xl border border-gray-200 bg-white p-5">

                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        {{ __('applications.show.applied_at') }}
                    </p>

                    <p class="mt-2 text-sm font-semibold text-gray-800">

                        {{ $application->applied_at
                            ? $application->applied_at->format('d M Y, h:i A')
                            : (
                                $application->created_at
                                    ? $application->created_at->format('d M Y, h:i A')
                                    : __('applications.not_available')
                            )
                        }}

                    </p>

                </div>


                {{-- Created --}}
                <div class="rounded-xl border border-gray-200 bg-white p-5">

                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        {{ __('applications.show.created') }}
                    </p>

                    <p class="mt-2 text-sm font-semibold text-gray-800">

                        {{ $application->created_at
                            ? $application->created_at->format('d M Y, h:i A')
                            : __('applications.not_available')
                        }}

                    </p>

                </div>


                {{-- Updated --}}
                <div class="rounded-xl border border-gray-200 bg-white p-5">

                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        {{ __('applications.show.updated') }}
                    </p>

                    <p class="mt-2 text-sm font-semibold text-gray-800">

                        {{ $application->updated_at
                            ? $application->updated_at->format('d M Y, h:i A')
                            : __('applications.not_available')
                        }}

                    </p>

                </div>


                {{-- Reason --}}
                <div class="md:col-span-2 rounded-xl border border-gray-200 bg-white p-5">

                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        {{ __('applications.show.reason') }}
                    </p>

                    <div class="mt-3 rounded-xl border border-gray-100 bg-gray-50 px-5 py-4">

                        @if($application->reason)

                            <p class="text-sm leading-7 text-gray-700 whitespace-pre-wrap break-words">
                                {{ $application->reason }}
                            </p>

                        @else

                            <p class="text-sm text-gray-500">
                                {{ __('applications.show.no_reason') }}
                            </p>

                        @endif

                    </div>

                </div>


                {{-- Manager Notes --}}
                <div class="md:col-span-2 rounded-xl border border-gray-200 bg-white p-5">

                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        {{ __('applications.show.manager_notes') }}
                    </p>

                    <div class="mt-3 rounded-xl border border-gray-100 bg-gray-50 px-5 py-4">

                        @if(!empty($application->manager_notes))

                            <p class="text-sm leading-7 text-gray-700 whitespace-pre-wrap break-words">
                                {{ $application->manager_notes }}
                            </p>

                        @else

                            <p class="text-sm text-gray-500 italic">
                                {{ __('applications.show.no_manager_notes') }}
                            </p>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection