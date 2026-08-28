@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Header --}}
    <div class="mb-8 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-5">

        <div>
            {{-- Brand --}}
            <div class="flex items-center gap-2 mb-3">
                <span class="h-2 w-2 rounded-full bg-indigo-600"></span>

                <span class="text-sm font-bold tracking-[0.18em] text-indigo-600 uppercase">
                    VOLUNTEAMS
                </span>
            </div>

            <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-gray-950">
                {{ __('teams.show.title') }}
            </h1>

            <p class="mt-2 text-base text-gray-600">
                {{ __('teams.show.description', ['name' => $team->name]) }}
            </p>
        </div>

        <div class="flex items-center gap-3">

            {{-- Back --}}
            <a href="{{ route('teams.index') }}"
               class="inline-flex items-center gap-2 px-5 py-3
                      rounded-xl border border-gray-200 bg-white
                      text-sm font-semibold text-gray-700
                      shadow-sm hover:bg-gray-50
                      transition">

                <span class="text-lg leading-none">
                    {{ app()->getLocale() === 'ar' ? '→' : '←' }}
                </span>

                {{ __('teams.show.back_to_teams') }}
            </a>

            {{-- Edit --}}
            @if(auth()->user()->hasRole('Admin'))
            <a href="{{ route('teams.edit', $team) }}"
               class="inline-flex items-center gap-2 px-5 py-3
                      rounded-xl bg-indigo-600
                      text-sm font-semibold text-white
                      shadow-sm hover:bg-indigo-700
                      transition">

                <span class="text-base">✎</span>

                {{ __('teams.show.edit_team') }}
            </a>
                @endif
        </div>
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


    {{-- Main Card --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        {{-- Team Header --}}
        <div class="relative border-b border-gray-200 bg-gradient-to-r from-indigo-50/70 via-white to-white px-6 py-7 sm:px-8">

            {{-- Accent --}}
            <div class="absolute inset-y-0 left-0 w-1 bg-indigo-600"></div>

            <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">

                {{-- Identity --}}
                <div class="flex items-center gap-5">

                    {{-- Logo --}}
                    @if($team->logo_path)

                        <img
                            src="{{ asset('storage/' . $team->logo_path) }}"
                            alt="{{ $team->name }}"
                            class="h-20 w-20 rounded-2xl object-cover border border-gray-200 shadow-sm"
                        >

                    @else

                        <div class="flex h-20 w-20 shrink-0 items-center justify-center rounded-2xl
                                    bg-indigo-50 border border-indigo-100
                                    text-xl font-bold text-indigo-600">
                            {{ strtoupper(substr($team->name, 0, 2)) }}
                        </div>

                    @endif


                    {{-- Name --}}
                    <div>

                        <h2 class="text-2xl font-bold text-gray-950">
                            {{ $team->name }}
                        </h2>

                        <div class="mt-3">

                            @if($team->is_active ?? true)

                                <span class="inline-flex items-center gap-2 rounded-full
                                             border border-green-200 bg-green-50
                                             px-3 py-1 text-xs font-semibold text-green-700">

                                    <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>

                                    {{ __('teams.show.active') }}

                                </span>

                            @else

                                <span class="inline-flex items-center gap-2 rounded-full
                                             border border-red-200 bg-red-50
                                             px-3 py-1 text-xs font-semibold text-red-700">

                                    <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>

                                    {{ __('teams.show.inactive') }}

                                </span>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- Dates --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 sm:min-w-[360px]">

                    <div class="sm:text-right">
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                            {{ __('teams.show.created_at') }}
                        </p>

                        <p class="mt-1 text-sm font-semibold text-gray-700">
                            {{ $team->created_at
                                ? $team->created_at->format('Y-m-d H:i')
                                : __('teams.show.not_available') }}
                        </p>
                    </div>

                    <div class="sm:text-right">
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                            {{ __('teams.show.updated_at') }}
                        </p>

                        <p class="mt-1 text-sm font-semibold text-gray-700">
                            {{ $team->updated_at
                                ? $team->updated_at->format('Y-m-d H:i')
                                : __('teams.show.not_available') }}
                        </p>
                    </div>

                </div>

            </div>
        </div>


        {{-- Details --}}
        <div class="p-6 sm:p-8">

            <div class="mb-5">
                <h3 class="text-lg font-bold text-gray-900">
                    {{ __('teams.show.title') }}
                </h3>
            </div>


            {{-- Information Grid --}}
            <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                {{-- Manager --}}
                <div class="rounded-xl border border-gray-200 bg-white p-5">

                    <dt class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        {{ __('teams.show.team_manager') }}
                    </dt>

                    <dd class="mt-2">

                        @if($team->manager)

                            <p class="text-base font-semibold text-gray-900">
                                {{ $team->manager->name }}
                            </p>

                            @if($team->manager->email)
                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $team->manager->email }}
                                </p>
                            @endif

                        @else

                            <p class="text-base font-semibold text-gray-500">
                                {{ __('teams.show.not_available') }}
                            </p>

                        @endif

                    </dd>

                </div>


                {{-- Email --}}
                <div class="rounded-xl border border-gray-200 bg-white p-5">

                    <dt class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        {{ __('teams.show.team_email') }}
                    </dt>

                    <dd class="mt-2 text-base font-semibold text-gray-900">
                        {{ $team->email ?? __('teams.show.not_available') }}
                    </dd>

                </div>


                {{-- Phone --}}
                <div class="rounded-xl border border-gray-200 bg-white p-5">

                    <dt class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        {{ __('teams.show.phone_number') }}
                    </dt>

                    <dd class="mt-2 text-base font-semibold text-gray-900">
                        {{ $team->phone ?? __('teams.show.not_available') }}
                    </dd>

                </div>


                {{-- Address --}}
                <div class="rounded-xl border border-gray-200 bg-white p-5">

                    <dt class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        {{ __('teams.show.address') }}
                    </dt>

                    <dd class="mt-2 text-base font-semibold text-gray-900">
                        {{ $team->address ?? __('teams.show.not_available') }}
                    </dd>

                </div>

            </dl>


            {{-- Description --}}
            <div class="mt-4 rounded-xl border border-gray-200 bg-white p-5">

                <div class="flex items-center gap-3 mb-4">

                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                        ≡
                    </div>

                    <h3 class="text-base font-bold text-gray-900">
                        {{ __('teams.show.description_label') }}
                    </h3>

                </div>

                <div class="rounded-xl bg-gray-50 border border-gray-100 px-5 py-4">

                    @if($team->description)

                        <p class="text-sm leading-7 text-gray-700 whitespace-pre-line">
                            {{ $team->description }}
                        </p>

                    @else

                        <p class="text-sm text-gray-500">
                            {{ __('teams.show.no_description') }}
                        </p>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>
@endsection