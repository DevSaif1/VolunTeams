@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50">

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5 mb-8">

            <div>

                <div class="flex items-center gap-2 mb-3">
                    <span class="w-2 h-2 rounded-full bg-indigo-600"></span>

                    <span class="text-xs font-bold tracking-[0.18em] uppercase text-indigo-600">
                        VolunTeams
                    </span>
                </div>

                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-slate-950">
                    {{ __('users.edit.title') }}
                </h1>

                <p class="mt-2 text-sm sm:text-base text-slate-500">
                    {{ __('users.edit.description') }}
                </p>

            </div>


            {{-- Back Button --}}
            <a href="{{ route('users.index') }}"
               class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-700">

                <svg class="h-4 w-4"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M15 19l-7-7 7-7"/>
                </svg>

                {{ __('users.actions.back') }}

            </a>

        </div>


        {{-- Validation Errors --}}
        @if($errors->any())

            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4">

                <div class="flex items-start gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-red-100">

                        <svg class="h-5 w-5 text-red-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 9v4m0 4h.01M10.29 3.86l-7.82 14a2 2 0 001.74 2.64h15.58a2 2 0 001.74 0 1.74 2.64h15.58a2 2 0 001.74-2.64l-7.82-14a2 2 0 00-3.42 0z"/>

                        </svg>

                    </div>


                    <div>

                        <p class="text-sm font-semibold text-red-900">
                            {{ __('users.edit.role_information') }}
                        </p>

                        <ul class="mt-2 space-y-1 text-sm text-red-700">

                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- Main Card --}}
        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-[0_8px_30px_rgba(15,23,42,0.05)]">


            {{-- User Header --}}
            <div class="border-b border-slate-100 bg-gradient-to-r from-indigo-50/70 via-white to-white px-6 py-6 sm:px-8">

                <div class="flex flex-col sm:flex-row sm:items-center gap-5">


                    {{-- Avatar --}}
                    <div class="relative shrink-0">

                        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-lg font-bold text-indigo-700 ring-1 ring-indigo-100">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>


                        @if($user->id === auth()->id())

                            <span class="absolute -right-1 -bottom-1 h-5 w-5 rounded-full border-4 border-white bg-emerald-500"></span>

                        @endif

                    </div>


                    {{-- User Information --}}
                    <div class="min-w-0 flex-1">

                        <div class="flex flex-wrap items-center gap-2">

                            <h2 class="text-xl font-bold text-slate-950">
                                {{ $user->name }}
                            </h2>


                            @if($user->id === auth()->id())

                                <span class="inline-flex items-center rounded-full bg-indigo-50 px-2.5 py-1 text-[10px] font-bold text-indigo-600">
                                    {{ __('users.edit.you') }}
                                </span>

                            @endif

                        </div>


                        <p class="mt-1 text-sm text-slate-500 break-all">
                            {{ $user->email }}
                        </p>

                    </div>


                    {{-- Current Role --}}
                    @php

                        $currentRole = $user->getRoleNames()->first();

                        $currentRoleConfig = match ($currentRole) {

                            'Admin' => [
                                'label' => __('users.roles.admin'),
                                'class' => 'bg-violet-50 text-violet-700 border-violet-200',
                                'dot' => 'bg-violet-500',
                            ],

                            'Team Manager' => [
                                'label' => __('users.roles.team_manager'),
                                'class' => 'bg-blue-50 text-blue-700 border-blue-200',
                                'dot' => 'bg-blue-500',
                            ],

                            'Member' => [
                                'label' => __('users.roles.member'),
                                'class' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                'dot' => 'bg-emerald-500',
                            ],

                            default => [
                                'label' => __('users.roles.no_role'),
                                'class' => 'bg-slate-50 text-slate-600 border-slate-200',
                                'dot' => 'bg-slate-400',
                            ],

                        };

                    @endphp


                    <div class="shrink-0">

                        <span class="inline-flex items-center gap-2 rounded-full border px-3 py-1.5 text-xs font-semibold {{ $currentRoleConfig['class'] }}">

                            <span class="h-1.5 w-1.5 rounded-full {{ $currentRoleConfig['dot'] }}"></span>

                            {{ $currentRoleConfig['label'] }}

                        </span>

                    </div>

                </div>

            </div>


            {{-- Form Content --}}
            <div class="px-6 py-7 sm:px-8">


                {{-- Section Heading --}}
                <div class="mb-6">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">

                            <svg class="h-5 w-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>

                            </svg>

                        </div>


                        <div>

                            <h3 class="text-base font-bold text-slate-900">
                                {{ __('users.edit.role_access') }}
                            </h3>

                            <p class="mt-0.5 text-xs text-slate-500">
                                {{ __('users.edit.role_access_description') }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Update Form --}}
                <form action="{{ route('users.update', $user) }}"
                      method="POST"
                      class="space-y-7">

                    @csrf

                    @method('PATCH')


                    {{-- Role --}}
                    <div>

                        <label for="role"
                               class="block text-sm font-semibold text-slate-800">

                            {{ __('users.edit.user_role') }}

                            <span class="text-red-500">*</span>

                        </label>


                        <p class="mt-1 text-xs text-slate-500">
                            {{ __('users.edit.role_description') }}
                        </p>


                        <div class="relative mt-3">

                            <select name="role"
                                    id="role"
                                    required
                                    class="block w-full appearance-none rounded-xl border border-slate-200 bg-white px-4 py-3 pr-10 text-sm font-medium text-slate-700 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10">

                                <option value=""
                                        disabled
                                        {{ old('role', $currentRole) ? '' : 'selected' }}>

                                    {{ __('users.edit.select_role') }}

                                </option>


                                @foreach($roles as $role)

                                    <option value="{{ $role }}"
                                        {{ old('role', $currentRole) === $role ? 'selected' : '' }}>

                                        @switch($role)

                                            @case('Admin')
                                                {{ __('users.roles.admin') }}
                                                @break

                                            @case('Team Manager')
                                                {{ __('users.roles.team_manager') }}
                                                @break

                                            @case('Member')
                                                {{ __('users.roles.member') }}
                                                @break

                                            @default
                                                {{ $role }}

                                        @endswitch

                                    </option>

                                @endforeach

                            </select>


                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400">

                                <svg class="h-4 w-4"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M19 9l-7 7-7-7"/>

                                </svg>

                            </div>

                        </div>


                        @error('role')

                            <p class="mt-2 text-sm font-medium text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Role Information --}}
                    <div class="rounded-2xl border border-indigo-100 bg-indigo-50/60 p-5">

                        <div class="flex items-start gap-3">


                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">

                                <svg class="h-5 w-5"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>

                                </svg>

                            </div>


                            <div class="min-w-0">

                                <h4 class="text-sm font-bold text-indigo-950">
                                    {{ __('users.edit.role_information') }}
                                </h4>


                                <div class="mt-3 space-y-3 text-xs text-indigo-800">


                                    {{-- Member --}}
                                    <div class="flex gap-2">

                                        <span class="mt-1 h-1.5 w-1.5 shrink-0 rounded-full bg-emerald-500"></span>

                                        <p>
                                            <strong>
                                                {{ __('users.edit.member') }}:
                                            </strong>

                                            {{ __('users.edit.member_description') }}
                                        </p>

                                    </div>


                                    {{-- Team Manager --}}
                                    <div class="flex gap-2">

                                        <span class="mt-1 h-1.5 w-1.5 shrink-0 rounded-full bg-blue-500"></span>

                                        <p>
                                            <strong>
                                                {{ __('users.edit.team_manager') }}:
                                            </strong>

                                            {{ __('users.edit.team_manager_description') }}
                                        </p>

                                    </div>


                                    {{-- Admin --}}
                                    <div class="flex gap-2">

                                        <span class="mt-1 h-1.5 w-1.5 shrink-0 rounded-full bg-violet-500"></span>

                                        <p>
                                            <strong>
                                                {{ __('users.edit.admin') }}:
                                            </strong>

                                            {{ __('users.edit.admin_description') }}
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Actions --}}
                    <div class="flex flex-col-reverse sm:flex-row sm:items-center sm:justify-between gap-3 border-t border-slate-100 pt-6">


                        {{-- Cancel --}}
                        <a href="{{ route('users.index') }}"
                           class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:border-slate-300 hover:bg-slate-50">

                            {{ __('users.actions.cancel') }}

                        </a>


                        {{-- Save --}}
                        <button type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-500/20">

                            {{ __('users.actions.save_role') }}


                            <svg class="h-4 w-4"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 12h14m-6-6l6 6-6 6"/>

                            </svg>

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
@endsection