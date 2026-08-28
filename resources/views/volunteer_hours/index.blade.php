@extends('layouts.app')

@section('content')

@php
    $user = auth()->user();

    $isAdmin = $user->hasRole('Admin');
    $isManager = $user->hasRole('Team Manager');
    $isMember = $user->hasRole('Member');
@endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="mb-8 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">

        <div>

            <div class="flex items-center gap-2 mb-3">

                <span class="w-2 h-2 rounded-full bg-indigo-600"></span>

                <span class="text-xs font-bold tracking-[0.18em] text-indigo-600 uppercase">
                    VOLUNTEAMS
                </span>

            </div>

            <h1 class="text-3xl sm:text-4xl font-bold text-gray-950 tracking-tight">
                {{ __('volunteer_hours.index.title') }}
            </h1>

            <p class="mt-2 text-sm sm:text-base text-gray-600">

                @if($isMember)

                    {{ __('volunteer_hours.index.member_description') }}

                @else

                    {{ __('volunteer_hours.index.manage_description') }}

                @endif

            </p>

        </div>


        {{-- Add Volunteer Hours --}}
        @if($isAdmin || $isManager)

            <a
                href="{{ route('volunteer-hours.create') }}"
                class="inline-flex items-center justify-center gap-2
                       px-5 py-3
                       rounded-xl
                       bg-indigo-600
                       text-white
                       text-sm font-semibold
                       shadow-sm
                       hover:bg-indigo-700
                       hover:-translate-y-0.5
                       focus:outline-none
                       focus:ring-2
                       focus:ring-indigo-500
                       focus:ring-offset-2
                       transition-all duration-200"
            >

                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 4v16m8-8H4"
                    />
                </svg>

                {{ __('volunteer_hours.index.add_hours') }}

            </a>

        @endif

    </div>


    {{-- =========================================================
        SUCCESS MESSAGE
    ========================================================== --}}

    @if(session('success'))

        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4">

            <div class="flex items-center gap-3">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-green-100 text-green-700">
                    ✓
                </div>

                <p class="text-sm font-semibold text-green-800">
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif


    {{-- =========================================================
        MAIN CARD
    ========================================================== --}}

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">


        {{-- Card Header --}}
        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-indigo-50/70 via-white to-white">

            <div class="flex items-center gap-4">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">

                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                        />

                    </svg>

                </div>


                <div>

                    <h2 class="text-base font-bold text-gray-900">
                        {{ __('volunteer_hours.title') }}
                    </h2>

                    <p class="mt-0.5 text-sm text-gray-500">

                        @if($isMember)

                            {{ __('volunteer_hours.index.member_description') }}

                        @else

                            {{ __('volunteer_hours.index.manage_description') }}

                        @endif

                    </p>

                </div>

            </div>

        </div>


        {{-- =====================================================
            TABLE
        ====================================================== --}}

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-gray-50/80 border-b border-gray-100">

                    <tr>

                        {{-- Volunteer --}}
                        <th
                            scope="col"
                            class="px-6 py-4 text-left text-xs
                                   font-bold text-gray-400
                                   uppercase tracking-wider"
                        >
                            {{ __('volunteer_hours.volunteer') }}
                        </th>


                        {{-- Opportunity --}}
                        <th
                            scope="col"
                            class="px-6 py-4 text-left text-xs
                                   font-bold text-gray-400
                                   uppercase tracking-wider"
                        >
                            {{ __('volunteer_hours.opportunity') }}
                        </th>


                        {{-- Hours --}}
                        <th
                            scope="col"
                            class="px-6 py-4 text-left text-xs
                                   font-bold text-gray-400
                                   uppercase tracking-wider"
                        >
                            {{ __('volunteer_hours.hours') }}
                        </th>


                        {{-- Date --}}
                        <th
                            scope="col"
                            class="px-6 py-4 text-left text-xs
                                   font-bold text-gray-400
                                   uppercase tracking-wider"
                        >
                            {{ __('volunteer_hours.date_logged') }}
                        </th>


                        {{-- Approved By --}}
                        <th
                            scope="col"
                            class="px-6 py-4 text-left text-xs
                                   font-bold text-gray-400
                                   uppercase tracking-wider"
                        >
                            {{ __('volunteer_hours.approved_by') }}
                        </th>


                        {{-- Actions --}}
                        <th
                            scope="col"
                            class="px-6 py-4 text-right text-xs
                                   font-bold text-gray-400
                                   uppercase tracking-wider"
                        >
                            {{ __('volunteer_hours.actions') }}
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse($volunteerHours as $volunteerHour)

                        <tr class="group hover:bg-gray-50/70 transition-colors duration-150">


                            {{-- =================================================
                                VOLUNTEER
                            ================================================== --}}

                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center
                                                rounded-xl bg-indigo-50
                                                border border-indigo-100
                                                text-sm font-bold text-indigo-700">

                                        {{ strtoupper(substr($volunteerHour->user?->name ?? 'V', 0, 2)) }}

                                    </div>


                                    <div>

                                        <div class="text-sm font-semibold text-gray-900">

                                            {{ $volunteerHour->user?->name
                                                ?? __('volunteer_hours.unknown_volunteer') }}

                                        </div>


                                        @if($volunteerHour->user?->email)

                                            <div class="mt-1 text-xs text-gray-500">

                                                {{ $volunteerHour->user->email }}

                                            </div>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- =================================================
                                OPPORTUNITY
                            ================================================== --}}

                            <td class="px-6 py-5">

                                <div class="text-sm font-semibold text-indigo-600">

                                    {{ $volunteerHour->opportunity?->title
                                        ?? __('volunteer_hours.unknown_opportunity') }}

                                </div>


                                @if($volunteerHour->opportunity?->team)

                                    <div class="mt-1 text-xs text-gray-500">

                                        {{ __('volunteer_hours.team') }}:
                                        {{ $volunteerHour->opportunity->team->name }}

                                    </div>

                                @endif

                            </td>


                            {{-- =================================================
                                HOURS
                            ================================================== --}}

                            <td class="px-6 py-5 whitespace-nowrap">

                                <span
                                    class="inline-flex items-center gap-2
                                           rounded-full
                                           border border-indigo-100
                                           bg-indigo-50
                                           px-3 py-1.5
                                           text-xs font-bold
                                           text-indigo-700"
                                >

                                    <svg
                                        class="w-3.5 h-3.5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 8v4l3 3"
                                        />

                                    </svg>

                                    {{ number_format($volunteerHour->hours, 2) }}

                                    {{ __('volunteer_hours.hrs_unit') }}

                                </span>

                            </td>


                            {{-- =================================================
                                DATE
                            ================================================== --}}

                            <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-600">

                                {{ $volunteerHour->date_logged
                                    ? \Carbon\Carbon::parse($volunteerHour->date_logged)->format('M d, Y')
                                    : __('volunteer_hours.not_available') }}

                            </td>


                            {{-- =================================================
                                APPROVED BY
                            ================================================== --}}

                            <td class="px-6 py-5">

                                <div class="text-sm font-medium text-gray-900">

                                    {{ $volunteerHour->approver?->name
                                        ?? __('volunteer_hours.not_available') }}

                                </div>


                                @if($volunteerHour->approver?->email)

                                    <div class="mt-1 text-xs text-gray-500">

                                        {{ $volunteerHour->approver->email }}

                                    </div>

                                @endif

                            </td>


                            {{-- =================================================
                                ACTIONS
                            ================================================== --}}

                            <td class="px-6 py-5 whitespace-nowrap">

                                <div class="flex items-center justify-end gap-2">


                                    {{-- View --}}
                                    <a
                                        href="{{ route('volunteer-hours.show', $volunteerHour) }}"
                                        class="inline-flex items-center justify-center
                                               px-3 py-2
                                               rounded-lg
                                               border border-gray-200
                                               bg-white
                                               text-xs font-semibold
                                               text-gray-700
                                               hover:bg-gray-50
                                               hover:border-gray-300
                                               transition"
                                    >

                                        {{ __('volunteer_hours.view') }}

                                    </a>


                                    {{-- Edit --}}
                                    @if($isAdmin || $isManager)

                                        <a
                                            href="{{ route('volunteer-hours.edit', $volunteerHour) }}"
                                            class="inline-flex items-center justify-center
                                                   px-3 py-2
                                                   rounded-lg
                                                   bg-indigo-600
                                                   text-xs font-semibold
                                                   text-white
                                                   hover:bg-indigo-700
                                                   transition"
                                        >

                                           {{ __('volunteer_hours.edit_action') }}

                                        </a>

                                    @endif


                                    {{-- Delete --}}
                                    @if($isAdmin)

                                        <form
                                            action="{{ route('volunteer-hours.destroy', $volunteerHour) }}"
                                            method="POST"
                                            class="inline"
                                            onsubmit="return confirm('{{ __('volunteer_hours.delete_confirmation') }}')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="inline-flex items-center justify-center
                                                       px-3 py-2
                                                       rounded-lg
                                                       border border-red-200
                                                       bg-red-50
                                                       text-xs font-semibold
                                                       text-red-600
                                                       hover:bg-red-100
                                                       transition"
                                            >

                                                {{ __('volunteer_hours.delete') }}

                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>


                    @empty

                        {{-- =================================================
                            EMPTY STATE
                        ================================================== --}}

                        <tr>

                            <td
                                colspan="6"
                                class="px-6 py-16 text-center"
                            >

                                <div class="flex flex-col items-center justify-center">

                                    <div
                                        class="flex h-14 w-14 items-center justify-center
                                               rounded-2xl
                                               bg-gray-100
                                               text-gray-400"
                                    >

                                        <svg
                                            class="w-7 h-7"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                            />

                                        </svg>

                                    </div>


                                    @if($isMember)

                                        <p class="mt-4 text-sm font-semibold text-gray-700">

                                            {{ __('volunteer_hours.index.no_member_hours') }}

                                        </p>


                                        <p class="mt-1 text-xs text-gray-500">

                                            {{ __('volunteer_hours.index.member_empty_description') }}

                                        </p>

                                    @else

                                        <p class="mt-4 text-sm font-semibold text-gray-700">

                                            {{ __('volunteer_hours.index.no_hours') }}

                                        </p>


                                        <a
                                            href="{{ route('volunteer-hours.create') }}"
                                            class="mt-2 text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition"
                                        >

                                            {{ __('volunteer_hours.index.log_hours_now') }}

                                        </a>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- =========================================================
            PAGINATION
        ========================================================== --}}

        @if($volunteerHours->hasPages())

            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">

                {{ $volunteerHours->links() }}

            </div>

        @endif

    </div>

</div>

@endsection