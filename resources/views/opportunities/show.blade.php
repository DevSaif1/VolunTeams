@extends('layouts.app')

@section('content')

<div class="min-h-[calc(100vh-4rem)] overflow-x-hidden bg-gray-50/70">

    <div class="mx-auto w-full max-w-6xl px-4 py-7 sm:px-6 sm:py-9 lg:px-8">

        {{-- ========================================================= --}}
        {{-- PAGE HEADER --}}
        {{-- ========================================================= --}}

        <div class="mb-7">

            <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

                <div class="min-w-0">

                    <div class="mb-2 flex items-center gap-2">

                        <span class="h-1.5 w-1.5 rounded-full bg-indigo-600"></span>

                        <span class="text-xs font-bold uppercase tracking-[0.16em] text-indigo-600">
                            VolunTeams
                        </span>

                    </div>

                    <h1 class="text-3xl font-bold tracking-tight text-gray-950 sm:text-4xl">
                        {{ __('opportunities.show_title') }}
                    </h1>

                    <p class="mt-2 max-w-3xl text-sm leading-6 text-gray-600 sm:text-[15px]">
                        {{ __('opportunities.descriptions.show', ['title' => $opportunity->title]) }}
                    </p>

                </div>


                <div class="flex w-full flex-col gap-3 sm:w-auto sm:flex-row">

                    {{-- Back --}}
                    <a
                        href="{{ route('opportunities.index') }}"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 shadow-sm transition hover:border-gray-400 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                    >

                        <svg
                            class="h-4 w-4 rtl:rotate-180"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 19l-7-7 7-7"
                            />
                        </svg>

                        {{ __('opportunities.actions.back') }}

                    </a>


                    {{-- Edit --}}
                    @if(
                        auth()->user()->hasRole('Admin') ||
                        (
                            auth()->user()->hasRole('Team Manager') &&
                            $opportunity->team &&
                            $opportunity->team->manager_id === auth()->id()
                        )
                    )

                        <a
                            href="{{ route('opportunities.edit', $opportunity) }}"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white shadow-sm shadow-indigo-200 transition hover:bg-indigo-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                        >

                            <svg
                                class="h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M11 5h8M11 9h8M11 13h5M4 5h.01M4 9h.01M4 13h.01M4 17h8"
                                />
                            </svg>

                            {{ __('opportunities.actions.edit') }}

                        </a>

                    @endif

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- SUCCESS MESSAGE --}}
        {{-- ========================================================= --}}

        @if(session('success'))

            <div class="mb-5 flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-4 shadow-sm">

                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">

                    <svg
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 12l5 5L20 7"
                        />
                    </svg>

                </div>

                <p class="pt-1 text-sm font-medium text-emerald-800">
                    {{ session('success') }}
                </p>

            </div>

        @endif


        {{-- ========================================================= --}}
        {{-- MAIN OPPORTUNITY CARD --}}
        {{-- ========================================================= --}}

        <article class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">


            {{-- ===================================================== --}}
            {{-- OPPORTUNITY HERO --}}
            {{-- ===================================================== --}}

            <div class="relative border-b border-gray-100 bg-gradient-to-r from-indigo-50/60 via-white to-white p-5 sm:p-7">

                {{-- Accent --}}
                <div class="absolute inset-y-0 start-0 w-1 bg-indigo-600"></div>


                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">


                    {{-- Identity --}}
                    <div class="flex min-w-0 items-center gap-4">

                        <div class="relative shrink-0">

                            @if($opportunity->image_path)

                                <img
                                    src="{{ asset('storage/' . $opportunity->image_path) }}"
                                    alt="{{ $opportunity->title }}"
                                    class="h-20 w-20 rounded-2xl object-cover shadow-sm ring-1 ring-gray-200 sm:h-24 sm:w-24"
                                >

                            @else

                                <div class="flex h-20 w-20 items-center justify-center rounded-2xl bg-indigo-100 text-xl font-bold text-indigo-700 shadow-sm ring-1 ring-indigo-200 sm:h-24 sm:w-24">
                                    {{ strtoupper(substr($opportunity->title, 0, 2)) }}
                                </div>

                            @endif


                            {{-- Active indicator --}}
                            <span
                                class="absolute -bottom-1 -end-1 flex h-6 w-6 items-center justify-center rounded-full border-4 border-white {{ ($opportunity->is_active ?? true) ? 'bg-emerald-500' : 'bg-red-500' }}"
                                aria-label="{{ ($opportunity->is_active ?? true) ? __('opportunities.misc.active') : __('opportunities.misc.inactive') }}"
                            ></span>

                        </div>


                        <div class="min-w-0">

                            <h2 class="truncate text-xl font-bold text-gray-950 sm:text-2xl">
                                {{ $opportunity->title }}
                            </h2>


                            <div class="mt-3 flex flex-wrap items-center gap-2">

                                @php

                                    $statusStyles = [
                                        'published' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
                                        'draft' => 'border-amber-200 bg-amber-50 text-amber-700',
                                        'closed' => 'border-red-200 bg-red-50 text-red-700',
                                        'completed' => 'border-blue-200 bg-blue-50 text-blue-700',
                                        'cancelled' => 'border-gray-200 bg-gray-100 text-gray-700',
                                    ];

                                    $statusClass =
                                        $statusStyles[strtolower($opportunity->status)]
                                        ?? 'border-gray-200 bg-gray-100 text-gray-700';

                                @endphp


                                <span class="inline-flex items-center gap-1.5 rounded-full border px-3 py-1 text-xs font-bold {{ $statusClass }}">

                                    <span class="h-1.5 w-1.5 rounded-full bg-current"></span>

                                    {{ __('opportunities.statuses.' . strtolower($opportunity->status)) }}

                                </span>


                                <span class="inline-flex items-center gap-1.5 rounded-full border border-gray-200 bg-white px-3 py-1 text-xs font-semibold text-gray-600">

                                    <span class="h-1.5 w-1.5 rounded-full {{ ($opportunity->is_active ?? true) ? 'bg-emerald-500' : 'bg-red-500' }}"></span>

                                    {{ ($opportunity->is_active ?? true)
                                        ? __('opportunities.misc.active')
                                        : __('opportunities.misc.inactive')
                                    }}

                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- Created / Updated --}}
                    <div class="shrink-0 lg:text-end">

                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                            {{ __('opportunities.misc.created') }}
                        </p>

                        <p class="mt-1 text-sm font-semibold text-gray-700">
                            {{ $opportunity->created_at
                                ? \Carbon\Carbon::parse($opportunity->created_at)
                                    ->locale(app()->getLocale())
                                    ->translatedFormat('d F Y, h:i A')
                                : __('opportunities.misc.not_available')
                            }}
                        </p>


                        @if($opportunity->updated_at)

                            <p class="mt-3 text-xs font-semibold uppercase tracking-wider text-gray-400">
                                {{ __('opportunities.misc.updated') }}
                            </p>

                            <p class="mt-1 text-sm font-medium text-gray-600">
                                {{ \Carbon\Carbon::parse($opportunity->updated_at)
                                    ->locale(app()->getLocale())
                                    ->translatedFormat('d F Y, h:i A')
                                }}
                            </p>

                        @endif

                    </div>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- DETAILS --}}
            {{-- ===================================================== --}}

            <div class="p-5 sm:p-7">


                {{-- ================================================= --}}
                {{-- QUICK INFORMATION --}}
                {{-- ================================================= --}}

                <div class="overflow-hidden rounded-2xl border border-gray-200 bg-gray-50/60">

                    <div class="grid grid-cols-1 divide-y divide-gray-200 sm:grid-cols-2 sm:divide-y-0 sm:divide-x rtl:sm:divide-x-reverse lg:grid-cols-4 lg:divide-y-0">

                        {{-- Team --}}
                        <div class="p-5">

                            <p class="text-[11px] font-bold uppercase tracking-[0.12em] text-gray-400">
                                {{ __('opportunities.fields.team') }}
                            </p>

                            <p class="mt-2 truncate text-sm font-bold text-gray-900">
                                {{ $opportunity->team?->name ?? __('opportunities.misc.not_available') }}
                            </p>

                        </div>


                        {{-- Type --}}
                        <div class="p-5">

                            <p class="text-[11px] font-bold uppercase tracking-[0.12em] text-gray-400">
                                {{ __('opportunities.fields.type') }}
                            </p>

                            <span class="mt-2 inline-flex rounded-full border border-gray-200 bg-white px-3 py-1 text-xs font-bold text-gray-700">
                                {{ __('opportunities.types.' . strtolower($opportunity->type)) }}
                            </span>

                        </div>


                        {{-- Required Volunteers --}}
                        <div class="p-5">

                            <p class="text-[11px] font-bold uppercase tracking-[0.12em] text-gray-400">
                                {{ __('opportunities.fields.required_volunteers') }}
                            </p>

                            <p class="mt-2 text-sm font-bold text-gray-900">
                                {{ $opportunity->required_volunteers ?? __('opportunities.misc.not_available') }}
                            </p>

                        </div>


                        {{-- Hours --}}
                        <div class="p-5">

                            <p class="text-[11px] font-bold uppercase tracking-[0.12em] text-gray-400">
                                {{ __('opportunities.fields.hours') }}
                            </p>

                            <p class="mt-2 text-sm font-bold text-gray-900">
                                {{ $opportunity->hours
                                    ? $opportunity->hours . ' ' . __('opportunities.misc.hours_suffix')
                                    : __('opportunities.misc.not_available')
                                }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- ADDITIONAL DETAILS --}}
                {{-- ================================================= --}}

                <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-2">


                    {{-- Location --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-5">

                        <p class="text-[11px] font-bold uppercase tracking-[0.12em] text-gray-400">
                            {{ __('opportunities.fields.location') }}
                        </p>

                        <p class="mt-2 text-sm font-semibold text-gray-900">
                            {{ $opportunity->location ?? __('opportunities.misc.not_available') }}
                        </p>

                    </div>


                    {{-- Active --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-5">

                        <p class="text-[11px] font-bold uppercase tracking-[0.12em] text-gray-400">
                            {{ __('opportunities.misc.active_status') }}
                        </p>

                        <span class="mt-2 inline-flex items-center gap-1.5 rounded-full border px-3 py-1 text-xs font-bold
                            {{ ($opportunity->is_active ?? true)
                                ? 'border-emerald-200 bg-emerald-50 text-emerald-700'
                                : 'border-red-200 bg-red-50 text-red-700'
                            }}"
                        >

                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>

                            {{ ($opportunity->is_active ?? true)
                                ? __('opportunities.misc.active')
                                : __('opportunities.misc.inactive')
                            }}

                        </span>

                    </div>


                    {{-- Start Date --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-5">

                        <p class="text-[11px] font-bold uppercase tracking-[0.12em] text-gray-400">
                            {{ __('opportunities.fields.start_date') }}
                        </p>

                        <p class="mt-2 text-sm font-semibold text-gray-900">
                            {{ $opportunity->start_date
                                ? \Carbon\Carbon::parse($opportunity->start_date)
                                    ->locale(app()->getLocale())
                                    ->translatedFormat('d F Y, h:i A')
                                : __('opportunities.misc.not_available')
                            }}
                        </p>

                    </div>


                    {{-- End Date --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-5">

                        <p class="text-[11px] font-bold uppercase tracking-[0.12em] text-gray-400">
                            {{ __('opportunities.fields.end_date') }}
                        </p>

                        <p class="mt-2 text-sm font-semibold text-gray-900">
                            {{ $opportunity->end_date
                                ? \Carbon\Carbon::parse($opportunity->end_date)
                                    ->locale(app()->getLocale())
                                    ->translatedFormat('d F Y, h:i A')
                                : __('opportunities.misc.not_available')
                            }}
                        </p>

                    </div>


                    {{-- Application Deadline --}}
                    <div class="rounded-2xl border border-indigo-100 bg-indigo-50/40 p-5 md:col-span-2">

                        <p class="text-[11px] font-bold uppercase tracking-[0.12em] text-indigo-500">
                            {{ __('opportunities.fields.application_deadline') }}
                        </p>

                        <p class="mt-2 text-sm font-bold text-gray-900">
                            {{ $opportunity->application_deadline
                                ? \Carbon\Carbon::parse($opportunity->application_deadline)
                                    ->locale(app()->getLocale())
                                    ->translatedFormat('d F Y, h:i A')
                                : __('opportunities.misc.not_available')
                            }}
                        </p>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- DESCRIPTION --}}
                {{-- ================================================= --}}

                <div class="mt-6 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">

                            <svg
                                class="h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M7 8h10M7 12h10M7 16h6M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"
                                />
                            </svg>

                        </div>


                        <h3 class="text-sm font-bold text-gray-900">
                            {{ __('opportunities.fields.description') }}
                        </h3>

                    </div>


                    <div class="mt-4 rounded-xl bg-gray-50 p-5">

                        <p class="whitespace-pre-line text-sm leading-7 text-gray-700">
                            {{ $opportunity->description ?? __('opportunities.empty.no_description') }}
                        </p>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- MEMBER APPLICATION --}}
                {{-- ================================================= --}}

                @if(auth()->user()->hasRole('Member'))

                    @php

                        $canApply =
                            ($opportunity->status === 'published') &&
                            ($opportunity->is_active ?? false) &&
                            (
                                !$opportunity->application_deadline ||
                                \Carbon\Carbon::parse($opportunity->application_deadline)->isFuture()
                            );

                    @endphp


                    @if($canApply)

                        <div class="mt-6 overflow-hidden rounded-2xl border border-indigo-200 bg-indigo-50/60">

                            <div class="p-5 sm:p-6">

                                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                                    <div class="flex items-start gap-4">

                                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-sm">

                                            <svg
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.8"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM4 21a8 8 0 0116 0"
                                                />
                                            </svg>

                                        </div>


                                        <div>

                                            <h3 class="text-base font-bold text-gray-900">
                                                {{ __('opportunities.application.interested') }}
                                            </h3>

                                            <p class="mt-1 text-sm leading-6 text-gray-600">
                                                {{ __('opportunities.application.prompt') }}
                                            </p>

                                        </div>

                                    </div>


                                    <a
                                        href="{{ route('applications.create', ['opportunity_id' => $opportunity->id]) }}"
                                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-sm shadow-indigo-200 transition hover:bg-indigo-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                                    >

                                        {{ __('opportunities.actions.apply') }}

                                        <svg
                                            class="h-4 w-4 rtl:rotate-180"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            aria-hidden="true"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 12h14m-7-7l7 7-7 7"
                                            />
                                        </svg>

                                    </a>

                                </div>

                            </div>

                        </div>

                    @else

                        <div class="mt-6 rounded-2xl border border-gray-200 bg-gray-50 p-5">

                            <div class="flex items-center gap-3">

                                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gray-100 text-gray-500">

                                    <svg
                                        class="h-4 w-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                        aria-hidden="true"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M12 8v4m0 4h.01M10.29 3.86l-8.82 15a2 2 0 001.72 3h17.62a2 2 0 001.72-3l-8.82-15a2 2 0 00-3.44 0z"
                                        />
                                    </svg>

                                </div>

                                <p class="text-sm font-medium text-gray-600">
                                    {{ __('opportunities.application.closed') }}
                                </p>

                            </div>

                        </div>

                    @endif

                @endif

            </div>

        </article>

    </div>

</div>

@endsection