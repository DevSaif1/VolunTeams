@extends('layouts.app')

@section('content')

@php
    $user = auth()->user();

    $isAdmin = $user->hasRole('Admin');
    $isManager = $user->hasRole('Team Manager');
    $isMember = $user->hasRole('Member');

    $statusColors = [
        'published' => [
            'badge' => 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-200',
            'dot' => 'bg-emerald-500',
        ],
        'draft' => [
            'badge' => 'bg-amber-50 text-amber-700 ring-1 ring-inset ring-amber-200',
            'dot' => 'bg-amber-500',
        ],
        'closed' => [
            'badge' => 'bg-red-50 text-red-700 ring-1 ring-inset ring-red-200',
            'dot' => 'bg-red-500',
        ],
        'completed' => [
            'badge' => 'bg-blue-50 text-blue-700 ring-1 ring-inset ring-blue-200',
            'dot' => 'bg-blue-500',
        ],
        'cancelled' => [
            'badge' => 'bg-gray-100 text-gray-700 ring-1 ring-inset ring-gray-200',
            'dot' => 'bg-gray-500',
        ],
    ];
@endphp


<div class="min-h-[calc(100vh-4rem)] overflow-x-hidden bg-gray-50/70">

    <div class="mx-auto w-full max-w-7xl px-4 py-7 sm:px-6 sm:py-9 lg:px-8">


        {{-- ========================================================= --}}
        {{-- PAGE HEADER --}}
        {{-- ========================================================= --}}

        <div class="mb-7">

            <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

                <div class="min-w-0">

                    {{-- Small Section Label --}}
                    <div class="mb-2 flex items-center gap-2">

                        <span class="h-1.5 w-1.5 rounded-full bg-indigo-600"></span>

                        <span class="text-xs font-bold uppercase tracking-[0.16em] text-indigo-600">
                            VolunTeams
                        </span>

                    </div>


                    <h1 class="text-3xl font-bold tracking-tight text-gray-950 sm:text-4xl">
                        {{ __('opportunities.title') }}
                    </h1>


                    <p class="mt-2 max-w-2xl text-sm leading-6 text-gray-600 sm:text-[15px]">

                        @if($isAdmin)
                            {{ __('opportunities.descriptions.manage') }}
                        @elseif($isManager)
                            {{ __('opportunities.descriptions.manager') }}
                        @else
                            {{ __('opportunities.descriptions.browse') }}
                        @endif

                    </p>

                </div>


                {{-- Create --}}
                @if($isAdmin || $isManager)

                    <a
                        href="{{ route('opportunities.create') }}"
                        class="group inline-flex w-full shrink-0 items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm shadow-indigo-200 transition duration-200 hover:bg-indigo-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                    >

                        <span class="flex h-5 w-5 items-center justify-center rounded-md bg-white/10 transition group-hover:bg-white/20">

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
                                    d="M12 4v16m8-8H4"
                                />
                            </svg>

                        </span>

                        {{ __('opportunities.actions.create') }}

                    </a>

                @endif

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- SUCCESS MESSAGE --}}
        {{-- ========================================================= --}}

        @if(session('success'))

            <div class="mb-5 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3.5 text-sm text-emerald-800 shadow-sm">

                <div class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-emerald-100">

                    <svg
                        class="h-3.5 w-3.5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m5 12 4 4L19 6"
                        />
                    </svg>

                </div>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        @endif


        {{-- ========================================================= --}}
        {{-- OPPORTUNITIES --}}
        {{-- ========================================================= --}}

        <div class="space-y-4">

            @forelse($opportunities as $opportunity)

                @php
                    $status = strtolower((string) $opportunity->status);
                    $type = strtolower((string) $opportunity->type);

                    $statusStyle = $statusColors[$status] ?? [
                        'badge' => 'bg-gray-100 text-gray-700 ring-1 ring-inset ring-gray-200',
                        'dot' => 'bg-gray-500',
                    ];
                @endphp


                {{-- ================================================= --}}
                {{-- OPPORTUNITY CARD --}}
                {{-- ================================================= --}}

                <article
                    class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition-all duration-200 hover:-translate-y-[1px] hover:border-gray-300 hover:shadow-lg"
                >

                    {{-- Project Accent --}}
                    <div class="absolute inset-y-0 start-0 w-1 bg-indigo-600"></div>


                    <div class="p-5 sm:p-6">


                        {{-- ================================================= --}}
                        {{-- TOP SECTION --}}
                        {{-- ================================================= --}}

                        <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">


                            {{-- Identity --}}
                            <div class="flex min-w-0 items-start gap-4">


                                {{-- Image --}}
                                <div class="relative shrink-0">

                                    @if($opportunity->image_path)

                                        <img
                                            src="{{ asset('storage/' . $opportunity->image_path) }}"
                                            alt="{{ $opportunity->title }}"
                                            class="h-[72px] w-[72px] rounded-2xl border border-gray-200 object-cover shadow-sm sm:h-20 sm:w-20"
                                        >

                                    @else

                                        <div
                                            class="flex h-[72px] w-[72px] items-center justify-center rounded-2xl bg-indigo-50 text-lg font-bold text-indigo-600 ring-1 ring-inset ring-indigo-100 sm:h-20 sm:w-20"
                                        >
                                            {{ strtoupper(substr($opportunity->title, 0, 2)) }}
                                        </div>

                                    @endif


                                    {{-- Active Indicator --}}
                                    @if($opportunity->is_active ?? true)

                                        <span class="absolute -bottom-1 -end-1 flex h-5 w-5 items-center justify-center rounded-full border-2 border-white bg-emerald-500">
                                            <span class="h-1.5 w-1.5 rounded-full bg-white"></span>
                                        </span>

                                    @endif

                                </div>


                                {{-- Title / Team --}}
                                <div class="min-w-0 pt-0.5">

                                    <h2 class="break-words text-lg font-bold leading-7 text-gray-950 sm:text-xl">
                                        {{ $opportunity->title }}
                                    </h2>

                                    <p class="mt-0.5 truncate text-sm text-gray-500">
                                        {{ $opportunity->team?->name ?? __('opportunities.misc.not_available') }}
                                    </p>


                                    {{-- Tags --}}
                                    <div class="mt-3 flex flex-wrap items-center gap-2">

                                        {{-- Type --}}
                                        <span class="inline-flex items-center rounded-lg bg-gray-100 px-2.5 py-1 text-xs font-semibold text-gray-700 ring-1 ring-inset ring-gray-200">
                                            {{ __('opportunities.types.' . $type) }}
                                        </span>


                                        {{-- Active --}}
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-lg px-2.5 py-1 text-xs font-semibold
                                            {{ ($opportunity->is_active ?? true)
                                                ? 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-200'
                                                : 'bg-red-50 text-red-700 ring-1 ring-inset ring-red-200'
                                            }}"
                                        >

                                            <span
                                                class="h-1.5 w-1.5 rounded-full
                                                {{ ($opportunity->is_active ?? true)
                                                    ? 'bg-emerald-500'
                                                    : 'bg-red-500'
                                                }}"
                                            ></span>

                                            {{ ($opportunity->is_active ?? true)
                                                ? __('opportunities.misc.active')
                                                : __('opportunities.misc.inactive')
                                            }}

                                        </span>

                                    </div>

                                </div>

                            </div>


                            {{-- Status --}}
                            <div class="flex shrink-0 lg:pt-1">

                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-bold {{ $statusStyle['badge'] }}"
                                >

                                    <span class="h-1.5 w-1.5 rounded-full {{ $statusStyle['dot'] }}"></span>

                                    {{ __('opportunities.statuses.' . $status) }}

                                </span>

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- INFORMATION STRIP --}}
                        {{-- ================================================= --}}

                        <div class="mt-5 grid grid-cols-2 divide-x divide-gray-200 rounded-xl border border-gray-100 bg-gray-50/80 sm:grid-cols-4 rtl:divide-x-reverse">


                            {{-- Volunteers --}}
                            <div class="min-w-0 px-4 py-3.5 sm:px-5">

                                <p class="truncate text-[10px] font-bold uppercase tracking-[0.12em] text-gray-400">
                                    {{ __('opportunities.fields.required_volunteers') }}
                                </p>

                                <p class="mt-1 text-sm font-bold text-gray-900">
                                    {{ $opportunity->required_volunteers ?? __('opportunities.misc.not_available') }}
                                </p>

                            </div>


                            {{-- Hours --}}
                            <div class="min-w-0 px-4 py-3.5 sm:px-5">

                                <p class="truncate text-[10px] font-bold uppercase tracking-[0.12em] text-gray-400">
                                    {{ __('opportunities.fields.hours') }}
                                </p>

                                <p class="mt-1 truncate text-sm font-bold text-gray-900">

                                    @if(!is_null($opportunity->hours))

                                        {{ $opportunity->hours }}
                                        {{ __('opportunities.misc.hours_suffix') }}

                                    @else

                                        {{ __('opportunities.misc.not_available') }}

                                    @endif

                                </p>

                            </div>


                            {{-- Start --}}
                            <div class="min-w-0 px-4 py-3.5 sm:px-5">

                                <p class="truncate text-[10px] font-bold uppercase tracking-[0.12em] text-gray-400">
                                    {{ __('opportunities.fields.start_date') }}
                                </p>

                                <p class="mt-1 truncate text-sm font-bold text-gray-900">

                                    @if($opportunity->start_date)

                                        {{ \Carbon\Carbon::parse($opportunity->start_date)
                                            ->locale(app()->getLocale())
                                            ->translatedFormat('d M Y') }}

                                    @else

                                        {{ __('opportunities.misc.not_available') }}

                                    @endif

                                </p>

                            </div>


                            {{-- End --}}
                            <div class="min-w-0 px-4 py-3.5 sm:px-5">

                                <p class="truncate text-[10px] font-bold uppercase tracking-[0.12em] text-gray-400">
                                    {{ __('opportunities.fields.end_date') }}
                                </p>

                                <p class="mt-1 truncate text-sm font-bold text-gray-900">

                                    @if($opportunity->end_date)

                                        {{ \Carbon\Carbon::parse($opportunity->end_date)
                                            ->locale(app()->getLocale())
                                            ->translatedFormat('d M Y') }}

                                    @else

                                        {{ __('opportunities.misc.not_available') }}

                                    @endif

                                </p>

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- ACTION BAR --}}
                        {{-- ================================================= --}}

                        <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">


                            {{-- Small context --}}
                            <div class="hidden min-w-0 sm:block">

                                <span class="text-xs text-gray-400">
                                    {{ __('opportunities.misc.actions') }}
                                </span>

                            </div>


                            {{-- Actions --}}
                            <div class="flex w-full items-center gap-2 sm:w-auto">

                                {{-- View --}}
                                <a
                                    href="{{ route('opportunities.show', $opportunity) }}"
                                    class="inline-flex flex-1 items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 transition hover:border-gray-400 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:flex-none"
                                >
                                    {{ __('opportunities.actions.view') }}
                                </a>


                                @if($isAdmin || $isManager)

                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('opportunities.edit', $opportunity) }}"
                                        class="inline-flex flex-1 items-center justify-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:flex-none"
                                    >
                                        {{ __('opportunities.actions.edit') }}
                                    </a>


                                    {{-- Delete --}}
                                    <form
                                        action="{{ route('opportunities.destroy', $opportunity) }}"
                                        method="POST"
                                        class="flex-1 sm:flex-none"
                                        onsubmit="return confirm('{{ __('opportunities.messages.delete_confirmation') }}')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="inline-flex w-full items-center justify-center rounded-lg border border-red-200 bg-red-50 px-4 py-2 text-sm font-semibold text-red-700 transition hover:border-red-300 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                        >
                                            {{ __('opportunities.actions.delete') }}
                                        </button>

                                    </form>

                                @endif

                            </div>

                        </div>

                    </div>

                </article>

            @empty


                {{-- ================================================= --}}
                {{-- EMPTY STATE --}}
                {{-- ================================================= --}}

                <div class="rounded-2xl border border-dashed border-gray-300 bg-white px-5 py-16 text-center shadow-sm">

                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">

                        <svg
                            class="h-8 w-8"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M20 13V6a2 2 0 00-2-2h-3.5l-1-1h-3l-1 1H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4m5 4h6"
                            />
                        </svg>

                    </div>

                    <h2 class="mt-5 text-lg font-bold text-gray-900">
                        {{ __('opportunities.empty.no_opportunities') }}
                    </h2>


                    @if($isAdmin || $isManager)

                        <p class="mx-auto mt-1 max-w-md text-sm text-gray-500">
                            {{ __('opportunities.empty.create_first') }}
                        </p>

                        <a
                            href="{{ route('opportunities.create') }}"
                            class="mt-5 inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            {{ __('opportunities.actions.create') }}
                        </a>

                    @else

                        <p class="mx-auto mt-1 max-w-md text-sm text-gray-500">
                            {{ __('opportunities.empty.no_active_opportunities') }}
                        </p>

                    @endif

                </div>

            @endforelse

        </div>


        {{-- ========================================================= --}}
        {{-- PAGINATION --}}
        {{-- ========================================================= --}}

        @if($opportunities->hasPages())

            <div class="mt-5 rounded-xl border border-gray-200 bg-white px-4 py-3 shadow-sm">

                {{ $opportunities->links() }}

            </div>

        @endif

    </div>

</div>

@endsection