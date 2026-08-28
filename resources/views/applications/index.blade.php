@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    @php
        $user = auth()->user();

        $isAdmin = $user->hasRole('Admin');
        $isManager = $user->hasRole('Team Manager');
        $isMember = $user->hasRole('Member');
    @endphp


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
                {{ __('applications.index.title') }}
            </h1>


            <p class="mt-2 text-sm sm:text-base text-gray-600">

                @if($isAdmin)

                    {{ __('applications.index.admin_description') }}

                @elseif($isManager)

                    {{ __('applications.index.manager_description') }}

                @else

                    {{ __('applications.index.member_description') }}

                @endif

            </p>

        </div>


        {{-- Create Application --}}
        @if($isMember)

            <a
                href="{{ route('applications.create') }}"
                class="inline-flex items-center justify-center gap-2
                       px-5 py-3 rounded-xl
                       bg-indigo-600 text-white
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

                {{ __('applications.create_application') }}

            </a>

        @endif

    </div>


    {{-- Success Message --}}
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


    {{-- Applications Card --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">


        {{-- Card Header --}}
        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-indigo-50/70 to-white">

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
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                        />

                    </svg>

                </div>


                <div>

                    <h2 class="text-base font-bold text-gray-900">
                        {{ __('applications.title') }}
                    </h2>


                    <p class="text-sm text-gray-500 mt-0.5">

                        @if($isAdmin)

                            {{ __('applications.index.admin_description') }}

                        @elseif($isManager)

                            {{ __('applications.index.manager_description') }}

                        @else

                            {{ __('applications.index.member_description') }}

                        @endif

                    </p>

                </div>

            </div>

        </div>


        {{-- Table --}}
        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-gray-50/80 border-b border-gray-100">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">
                            {{ __('applications.volunteer') }}
                        </th>


                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">
                            {{ __('applications.opportunity') }}
                        </th>


                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">
                            {{ __('applications.status') }}
                        </th>


                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">
                            {{ __('applications.applied_date') }}
                        </th>


                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-400 uppercase tracking-wider">
                            {{ __('applications.actions') }}
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse($applications as $application)

                        <tr class="group hover:bg-gray-50/70 transition-colors duration-150">


                            {{-- Volunteer --}}
                            <td class="px-6 py-5">

                                <div class="text-sm font-semibold text-gray-900">
                                    {{ $application->user?->name ?? __('applications.not_available') }}
                                </div>


                                @if($application->user?->email)

                                    <div class="text-xs text-gray-500 mt-1">
                                        {{ $application->user->email }}
                                    </div>

                                @endif

                            </td>


                            {{-- Opportunity --}}
                            <td class="px-6 py-5">

                                <div class="text-sm font-semibold text-indigo-600">
                                    {{ $application->opportunity?->title ?? __('applications.not_available') }}
                                </div>


                                @if($application->opportunity?->team)

                                    <div class="text-xs text-gray-500 mt-1">
                                        {{ $application->opportunity->team->name }}
                                    </div>

                                @endif

                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-5">

                                @php

                                    $statusStyles = [

                                        'pending' =>
                                            'bg-yellow-50 text-yellow-700 border-yellow-200',

                                        'approved' =>
                                            'bg-green-50 text-green-700 border-green-200',

                                        'rejected' =>
                                            'bg-red-50 text-red-700 border-red-200',

                                        'attended' =>
                                            'bg-blue-50 text-blue-700 border-blue-200',

                                        'cancelled' =>
                                            'bg-gray-50 text-gray-700 border-gray-200',

                                    ];


                                    $statusClass =
                                        $statusStyles[$application->status]
                                        ?? 'bg-gray-50 text-gray-700 border-gray-200';

                                @endphp


                                <span
                                    class="inline-flex items-center gap-2
                                           px-3 py-1.5 rounded-full
                                           border text-xs font-semibold
                                           {{ $statusClass }}"
                                >

                                    <span class="w-1.5 h-1.5 rounded-full bg-current"></span>

                                    {{ __('applications.statuses.' . $application->status) }}

                                </span>

                            </td>


                            {{-- Applied Date --}}
                            <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-600">

                                {{ $application->applied_at?->format('d M Y, h:i A')
                                    ?? __('applications.not_available') }}

                            </td>


                            {{-- Actions --}}
                            <td class="px-6 py-5">

                                <div class="flex items-center justify-end gap-2">


                                    {{-- View --}}
                                    <a
                                        href="{{ route('applications.show', $application) }}"
                                        class="inline-flex items-center justify-center
                                               px-3 py-2 rounded-lg
                                               border border-gray-200
                                               bg-white
                                               text-xs font-semibold text-gray-700
                                               hover:bg-gray-50
                                               hover:border-gray-300
                                               transition"
                                    >
                                        {{ __('applications.view') }}
                                    </a>


                                    {{-- Admin --}}
                                    @if($isAdmin)

                                        <a
                                            href="{{ route('applications.edit', $application) }}"
                                            class="inline-flex items-center justify-center
                                                   px-3 py-2 rounded-lg
                                                   bg-indigo-600
                                                   text-xs font-semibold text-white
                                                   hover:bg-indigo-700
                                                   transition"
                                        >
                                            {{ __('applications.index.edit') }}
                                        </a>


                                        <form
                                            action="{{ route('applications.destroy', $application) }}"
                                            method="POST"
                                            class="inline"
                                            onsubmit="return confirm('{{ __('applications.index.delete_confirmation') }}')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="inline-flex items-center justify-center
                                                       px-3 py-2 rounded-lg
                                                       border border-red-200
                                                       bg-red-50
                                                       text-xs font-semibold text-red-600
                                                       hover:bg-red-100
                                                       transition"
                                            >
                                                {{ __('applications.delete') }}
                                            </button>

                                        </form>

                                    @endif


                                    {{-- Team Manager --}}
                                    @if($isManager)

                                        <a
                                            href="{{ route('applications.edit', $application) }}"
                                            class="inline-flex items-center justify-center
                                                   px-3 py-2 rounded-lg
                                                   bg-indigo-50
                                                   border border-indigo-200
                                                   text-xs font-semibold text-indigo-700
                                                   hover:bg-indigo-100
                                                   transition"
                                        >
                                            {{ __('applications.review') }}
                                        </a>

                                    @endif


                                    {{-- Member --}}
                                    @if($isMember)

                                        @if($application->status === 'pending')

                                            <form
                                                action="{{ route('applications.destroy', $application) }}"
                                                method="POST"
                                                class="inline"
                                                onsubmit="return confirm('{{ __('applications.index.withdraw_confirmation') }}')"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center justify-center
                                                           px-3 py-2 rounded-lg
                                                           border border-red-200
                                                           bg-red-50
                                                           text-xs font-semibold text-red-600
                                                           hover:bg-red-100
                                                           transition"
                                                >
                                                    {{ __('applications.withdraw') }}
                                                </button>

                                            </form>

                                        @endif

                                    @endif

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="5" class="px-6 py-16 text-center">

                                <div class="flex flex-col items-center justify-center">

                                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-100 text-gray-400">

                                        <svg
                                            class="w-7 h-7"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293 5.414V19a2 2 0 01-2 2z"
                                            />

                                        </svg>

                                    </div>


                                    @if($isMember)

                                        <p class="mt-4 text-sm font-semibold text-gray-700">
                                            {{ __('applications.index.you_have_no_applications') }}
                                        </p>

                                        <p class="mt-1 text-xs text-gray-500">
                                            {{ __('applications.index.browse_and_apply') }}
                                        </p>


                                    @elseif($isManager)

                                        <p class="mt-4 text-sm font-semibold text-gray-700">
                                            {{ __('applications.index.no_team_applications') }}
                                        </p>


                                    @else

                                        <p class="mt-4 text-sm font-semibold text-gray-700">
                                            {{ __('applications.index.no_applications') }}
                                        </p>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($applications->hasPages())

            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $applications->links() }}
            </div>

        @endif

    </div>

</div>

@endsection